<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property;

use BeanFactory;
use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

trait PropertyHelperTrait
{
    /**
     * patchProperty function
     *
     * @param String $orderId
     * @param Array $property
     * @return void
     */
    private function _patchProperty(String $orderId, array $property, bool $newOrder)
    {
        $recordData = QualiaUtils\Queries::getRecordIdAndDiffHashByUniqueId(
            QualiaUtils\QualiaGlobalVariables::PROPERTY_TABLE_NAME,
            QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            $property["uniqueHash"]
        );

        $recordId       = $recordData["id"];
        $recordDiffHash = $recordData["qualia_diff_hash"];

        $name      = $this->_getPropertyName($property);
        $partyMeta = $this->_getPartyMeta($property);

        if ($recordId === false) {
            $recordId = $this->_createPropertyBean($property, $name);
        } else if ($recordDiffHash !== $property["diffHash"]) {
            $this->_updatePropertyBean($recordId, $property, $name);
        }

        $propertyPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH,
            QualiaUtils\QualiaGlobalVariables::PROPERTY_CHILD,
            $property["uniqueHash"]
        );

        if ($propertyPartyId === false) {
            $propertyPartyId = QualiaUtils\QualiaBeanUtils::createParty(
                QualiaUtils\QualiaGlobalVariables::PROPERTY_CHILD,
                QualiaUtils\QualiaGlobalVariables::PROPERTY_MODULE_NAME,
                $recordId,
                $name,
                $partyMeta
            );
        } else if ($recordDiffHash !== $property["diffHash"]) {
            $this->_updateParty($propertyPartyId, $name, $partyMeta);
        }

        //we dont need to check if the records are already related because this is the order create functionality
        if ($newOrder === true) {
            $orderLinked = false;
        } else {
            $orderLinked = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
                $propertyPartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }

        if ($orderLinked === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $propertyPartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }
    }

    /**
     * _getPropertyName function
     *
     * @param array $property
     * @return String
     */
    private function _getPropertyName($property)
    {
        $name = "";

        foreach ($property as $key => $value) {
            if ($key === "uniqueHash" || $key === "diffHash") {
                break;
            }

            if (strlen($name) < 50 && QualiaUtils\StringUtils::isNotNullOrEmptyString($value)) {
                $name .= $value . " ";
            }
        }

        $name = trim($name);
        return $name;
    }

    /**
     * _getPartyMeta function
     *
     * @param Array $property
     * @return array
     */
    protected function _getPartyMeta($property)
    {
        $uniqueHash = $property["uniqueHash"];
        $meta       = [QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH => $uniqueHash];

        return $meta;
    }

    /**
     * _createPropertyBean function
     *
     * @param array $property
     * @param string $name
     * @return void
     */
    protected function _createPropertyBean(array $property, string $name)
    {
        $bean                   = BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::PROPERTY_MODULE_NAME);
        $id                     = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $bean->id               = $id;
        $bean->new_with_id      = true;
        $bean->assigned_user_id = QualiaUtils\QualiaSimpleUtils::getCurrentUserId();

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean = $this->_updateSelfPropertyFields($bean, $property, $name);
        $bean->save();

        return $id;
    }

    /**
     * _updatePropertyBean function
     *
     * @param string $id
     * @param array $property
     * @param string $name
     * @return void
     */
    private function _updatePropertyBean(string $id, array $property, string $name)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::PROPERTY_MODULE_NAME,
            $id,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean            = $this->_updateSelfPropertyFields($bean, $property, $name);
        $bean->processed = true;
        $bean->save();
    }

    /**
     * _updateSelfPropertyFields function
     *
     * @param SugarBean|null $bean
     * @param array $property
     * @param string $name
     * @return SugarBean
     */
    protected function _updateSelfPropertyFields(SugarBean $bean, array $property, string $name): SugarBean
    {
        $bean->address            = $property["address1"];
        $bean->address2           = $property["address2"];
        $bean->zip_code           = $property["zipcode"];
        $bean->city               = $property["city"];
        $bean->state              = $property["state"];
        $bean->county             = $property["county"];
        $bean->name               = $name;
        $bean->qualia_unique_hash = $property["uniqueHash"];
        $bean->qualia_diff_hash   = $property["diffHash"];

        return $bean;
    }

    protected function _updateParty(string $propertyPartyId, string $name, array $partyMeta)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
            $propertyPartyId,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean->name = $name;

        foreach ($partyMeta as $fieldName => $fieldValue) {
            $bean->{$fieldName} = $fieldValue;
        }

        $bean->processed = null;
        $bean->save();
    }

    /**
     * unlinkProperty function
     *
     * unlink property party from order
     * @param String $propertyUniqueHash
     * @param String $orderId
     * @return void
     */
    private function unlinkProperty(String $propertyUniqueHash, string $orderId)
    {
        $propertyPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH,
            QualiaUtils\QualiaGlobalVariables::PROPERTY_CHILD,
            $propertyUniqueHash
        );

        if ($propertyPartyId !== false) {
            QualiaUtils\QualiaBeanUtils::unlinkPartyFromRecordId(
                $propertyPartyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL,
                $orderId
            );
        }
    }
}
