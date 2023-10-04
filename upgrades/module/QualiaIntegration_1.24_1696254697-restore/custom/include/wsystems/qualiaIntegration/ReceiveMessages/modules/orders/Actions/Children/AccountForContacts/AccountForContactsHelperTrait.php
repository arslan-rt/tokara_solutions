<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\AccountForContacts;

use BeanFactory;
use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils\QualiaTraitsUtils;

trait AccountForContactsHelperTrait
{
    /**
     * _patchAccount function
     *
     * @param String $orderID
     * @param String $accountType
     * @param array $account
     * @return array
     */
    protected function _patchAccount(String $orderID, String $accountType, array $account, bool $newOrder)
    {
        $recordData = QualiaUtils\Queries::getRecordIdAndDiffHashByQualiaId(
            QualiaUtils\QualiaGlobalVariables::ACCOUNT_TABLE_NAME,
            QualiaUtils\QualiaGlobalVariables::QUALIA_ID,
            $account["id"]
        );

        $newPartyBean          = false;
        $recordId              = $recordData["id"];
        $recordDiffHash        = $recordData["qualia_diff_hash"];
        $account["recordType"] = $accountType;

        $accountFieldsName    = ["name"];
        $accountFieldsMapping = $this->getAccountFieldsMapping();
        $name                 = $this->_getAccountName($account, $accountFieldsName);
        $partyMeta            = $this->_getPartyMeta($account, $accountType);

        if ($recordId === false) {
            $recordId = $this->_createAccountBean($account, $accountFieldsMapping);
        } else if ($recordDiffHash !== $account["diffHash"]) {
            $this->_updateAccountBean($recordId, $account, $accountFieldsMapping);
        }

        $accountPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID,
            ucfirst($accountType),
            $account["id"]
        );

        if ($accountPartyId === false) {
            $accountPartyId = QualiaUtils\QualiaBeanUtils::createParty(
                ucfirst($accountType),
                QualiaUtils\QualiaGlobalVariables::ACCOUNT_MODULE_NAME,
                $recordId,
                $name,
                $partyMeta
            );
            $newPartyBean = true;
        } else if ($recordDiffHash !== $account["diffHash"]) {
            $this->_updateParty($accountPartyId, $name, $partyMeta);
        }

        //we dont need to check if the records are already related because this is the order create functionality
        if ($newOrder === true) {
            $orderLinked = false;
        } else {
            $orderLinked = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
                $accountPartyId,
                $orderID,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }

        if ($orderLinked === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $accountPartyId,
                $orderID,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }
        $response = ["accountId" => $recordId, "partyId" => $accountPartyId, "newPartyBean" => $newPartyBean];
        return $response;
    }

    private function getAccountFieldsMapping()
    {
        $accountFieldsMapping = [
            "phone"             => "phone_office",
            "name"              => "name",
            "id"                => QualiaUtils\QualiaGlobalVariables::QUALIA_ID,
            "uniqueHash"        => QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            "diffHash"          => QualiaUtils\QualiaGlobalVariables::QUALIA_DIFF_HASH,
            "nationalLicenseID" => "national_license_id",
        ];

        return $accountFieldsMapping;
    }

    /**
     * _getAccountName function
     *
     * @param Array $account
     * @param Array $fields
     * @return String
     */
    private function _getAccountName($account, $fields)
    {
        $name = "";

        foreach ($fields as $field) {
            if (array_key_exists($field, $account) === true &&
                QualiaUtils\StringUtils::isNotNullOrEmptyString($account[$field]) === true) {
                $name .= $account[$field] . " ";
            }
        }

        if (strlen($name) < 1) {
            $name = "No name";
        }

        $name = trim($name);
        return $name;
    }

    /**
     * _createAccountBean function
     *
     * @param array $account
     * @param array $fieldsList
     * @return String
     */
    private function _createAccountBean(array $account, array $accountFieldsMapping)
    {
        $bean                   = BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::ACCOUNT_MODULE_NAME);
        $id                     = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $bean->id               = $id;
        $bean->new_with_id      = true;
        $bean->assigned_user_id = QualiaUtils\QualiaSimpleUtils::getCurrentUserId();

        $bean = $this->_updateSelfAccountFields($bean, $account, $accountFieldsMapping);

        if (QualiaUtils\StringUtils::isNotNullOrEmptyString($bean->name) === false) {
            $bean->name = "No Name From Qualia";
        }

        $bean->save();

        return $bean->id;
    }

    private function _updateAccountBean(string $id, array $account, array $accountFieldsMapping)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::ACCOUNT_MODULE_NAME,
            $id,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean            = $this->_updateSelfAccountFields($bean, $account, $accountFieldsMapping);
        $bean->processed = true;
        $bean->save();
    }

    /**
     * _updateSelfAccountFields function
     *
     * @param SugarBean $bean
     * @param array $account
     * @param array $accountFieldsMapping
     * @return SugarBean
     */
    private function _updateSelfAccountFields(SugarBean $bean, array $account, array $accountFieldsMapping)
    {
        foreach ($accountFieldsMapping as $qualiaField => $sugarField) {
            if (array_key_exists($qualiaField, $account) === true) {
                $bean->{$sugarField} = $account[$qualiaField];
            }
        }

        $qualiaTraitsUtils = new QualiaTraitsUtils();
        $qualiaTraitsUtils->setEmail($bean, $account);
        $qualiaTraitsUtils->setStateLicenseIDs($bean, $account);
        $qualiaTraitsUtils->addPartyTypes($bean, $account);

        //handle primaryAddress & mailingAddress
        if (array_key_exists("primaryAddress", $account)) {
            $bean->billing_address_street     = (string) $account["primaryAddress"]["value"]["address1"];
            $bean->billing_address_street_2   = (string) $account["primaryAddress"]["value"]["address2"];
            $bean->billing_address_city       = (string) $account["primaryAddress"]["value"]["city"];
            $bean->billing_address_state      = (string) $account["primaryAddress"]["value"]["state"];
            $bean->billing_address_postalcode = (string) $account["primaryAddress"]["value"]["zipcode"];
            $bean->billing_address_country    = (string) $account["primaryAddress"]["value"]["county"];
        }

        if (array_key_exists("mailingAddress", $account)) {
            $bean->shipping_address_street     = (string) $account["mailingAddress"]["value"]["address1"];
            $bean->shipping_address_street_2   = (string) $account["mailingAddress"]["value"]["address2"];
            $bean->shipping_address_city       = (string) $account["mailingAddress"]["value"]["city"];
            $bean->shipping_address_state      = (string) $account["mailingAddress"]["value"]["state"];
            $bean->shipping_address_postalcode = (string) $account["mailingAddress"]["value"]["zipcode"];
            $bean->shipping_address_country    = (string) $account["mailingAddress"]["value"]["county"];
        }

        return $bean;
    }

    /**
     * _getPartyMeta function
     *
     * @param array $account
     * @param string $contactType
     * @return array
     */
    private function _getPartyMeta(array $account, string $accountType)
    {
        $uniqueHash = $account["uniqueHash"];
        $qualiaID   = $account["id"];

        $meta = [
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH => $uniqueHash,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID          => $qualiaID,
        ];

        return $meta;
    }

    protected function _updateParty(string $accountPartyId, string $name, array $partyMeta)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
            $accountPartyId,
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

    private function unlinkAccount(String $accountsUniqueHash, String $accountType, String $orderID)
    {
        $accountPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH,
            ucfirst($accountType),
            $accountsUniqueHash
        );

        if ($accountPartyId !== false) {
            QualiaUtils\QualiaBeanUtils::unlinkPartyFromRecordId(
                $accountPartyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL,
                $orderID
            );

            $qualiaTraitsUtils = new QualiaTraitsUtils();
            $qualiaTraitsUtils->updatePartyTypes($accountPartyId);
        }

        return $accountPartyId;
    }
}
