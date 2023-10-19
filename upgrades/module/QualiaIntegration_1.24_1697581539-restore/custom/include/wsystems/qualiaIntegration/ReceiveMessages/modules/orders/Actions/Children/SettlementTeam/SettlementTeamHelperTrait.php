<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\SettlementTeam;

use BeanFactory;
use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;
use Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits\ModuleConfigTrait;

trait SettlementTeamHelperTrait
{
    use ModuleConfigTrait;

    /**
     * _patchSettlementTeam function
     *
     * @param String $orderId
     * @param Array $settlementTeam
     * @return void
     */
    private function _patchSettlementTeam(String $orderID, array $settlementTeam, bool $newOrder)
    {
        $recordData = QualiaUtils\Queries::getRecordIdAndDiffHashByQualiaId(
            QualiaUtils\QualiaGlobalVariables::CONTACT_TABLE_NAME,
            QualiaUtils\QualiaGlobalVariables::QUALIA_ID,
            $settlementTeam["userID"]
        );

        $recordId       = $recordData["id"];
        $recordDiffHash = $recordData["qualia_diff_hash"];

        $settlementTeamFieldsName = [
            "firstName",
            "lastName",
            "email",
        ];

        $settlementTeamFieldsMapping = $this->_getSettlementTeamFieldsMapping();
        $name                        = $this->_getSettlementTeamName($settlementTeam, $settlementTeamFieldsName);
        $partyMeta                   = $this->_getPartyMeta($settlementTeam);

        if ($recordId === false) {
            $recordId = $this->_createSettlementTeamBean($settlementTeam, $settlementTeamFieldsMapping);
        } else if ($recordDiffHash !== $settlementTeam["diffHash"]) {
            $this->_updateSettlementTeamBean($recordId, $settlementTeam, $settlementTeamFieldsMapping);
        }

        $settlementTeamPartyId = QualiaUtils\Queries::getSettlementTeamParty(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SETTLEMENT_TEAM,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID,
            $settlementTeam["userID"],
            QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_ROLE,
            $settlementTeam["role"]
        );

        if ($settlementTeamPartyId === false) {
            $settlementTeamPartyId = QualiaUtils\QualiaBeanUtils::createParty(
                QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SETTLEMENT_TEAM,
                QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME,
                $recordId,
                $name,
                $partyMeta
            );
        } else if ($recordDiffHash !== $settlementTeam["diffHash"]) {
            $this->_updateParty($settlementTeamPartyId, $name, $partyMeta);
        }

        //we dont need to check if the records are already related because this is the order create functionality
        if ($newOrder === true) {
            $orderLinked = false;
        } else {
            $orderLinked = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
                $settlementTeamPartyId,
                $orderID,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }

        if ($orderLinked === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $settlementTeamPartyId,
                $orderID,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }
    }

    private function _getSettlementTeamFieldsMapping()
    {
        $settlementTeamFieldsMapping = [
            "firstName"  => "first_name",
            "lastName"   => "last_name",
            "fax"        => "phone_fax",
            "email"      => "email1",
            "phone"      => "phone_mobile",
            "userID"     => QualiaUtils\QualiaGlobalVariables::QUALIA_ID,
            "uniqueHash" => QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            "diffHash"   => QualiaUtils\QualiaGlobalVariables::QUALIA_DIFF_HASH,
        ];

        return $settlementTeamFieldsMapping;
    }

    /**
     * _getSettlementTeamName function
     *
     * @param array $settlementTeam
     * @return String
     */
    private function _getSettlementTeamName($settlementTeam, $fields)
    {
        $name = "";

        foreach ($fields as $field) {
            if (array_key_exists($field, $settlementTeam) === true &&
                QualiaUtils\StringUtils::isNotNullOrEmptyString($settlementTeam[$field]) === true) {

                if ($field === "email" && empty($name) === false) {
                    $name = trim($name);
                    return $name;
                }

                $name .= $settlementTeam[$field] . " ";
            }
        }

        if (strlen($name) < 1) {
            $name = "No name";
        }

        $name = trim($name);
        return $name;
    }

    /**
     * _getPartyMeta function
     *
     * @param Array $settlementTeam
     * @return array
     */
    protected function _getPartyMeta($settlementTeam)
    {
        $uniqueHash = $settlementTeam["uniqueHash"];
        $qualiaID   = $settlementTeam["userID"];
        $userRole   = $settlementTeam["role"];

        $meta = [
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH => $uniqueHash,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID          => $qualiaID,
            QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_ROLE        => $userRole,
        ];

        return $meta;
    }

    /**
     * _createSettlementTeamBean function
     *
     * @param array $settlementTeam
     * @param string $name
     * @return void
     */
    protected function _createSettlementTeamBean(array $settlementTeam, array $settlementTeamFieldsMapping)
    {
        $bean                   = BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME);
        $id                     = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $bean->id               = $id;
        $bean->new_with_id      = true;
        $bean->assigned_user_id = QualiaUtils\QualiaSimpleUtils::getCurrentUserId();

        $bean = $this->_updateSelfSettlementTeamFields($bean, $settlementTeam, $settlementTeamFieldsMapping);

        $bean->save();

        return $id;
    }

    /**
     * _updateSettlementTeamBean function
     *
     * @param string $id
     * @param array $settlementTeam
     * @param string $name
     * @return void
     */
    protected function _updateSettlementTeamBean(string $id, array $settlementTeam, array $settlementTeamFieldsMapping)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME,
            $id,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean            = $this->_updateSelfSettlementTeamFields($bean, $settlementTeam, $settlementTeamFieldsMapping);
        $bean->processed = true;
        $bean->save();
    }

    /**
     * _updateSelfSettlementTeamFields function
     *
     * @param SugarBean|null $bean
     * @param array $settlementTeam
     * @param string $name
     * @return SugarBean
     */
    protected function _updateSelfSettlementTeamFields(SugarBean $bean, array $settlementTeam, array $settlementTeamFieldsMapping): SugarBean
    {
        foreach ($settlementTeamFieldsMapping as $qualiaField => $sugarField) {
            if (array_key_exists($qualiaField, $settlementTeam) === true) {
                $bean->{$sugarField} = $settlementTeam[$qualiaField];
            }
        }

        return $bean;
    }

    protected function _updateParty(string $settlementTeamPartyId, string $name, array $partyMeta)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
            $settlementTeamPartyId,
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
     * unlinkSettlementTeam function
     *
     * unlink settlementTeam party from order
     *
     * @param Array $settlementTeam
     * @param String $orderID
     * @return void
     */
    private function unlinkSettlementTeam(array $settlementTeam, string $orderID)
    {
        $settlementTeamPartyId = QualiaUtils\Queries::getSettlementTeamParty(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SETTLEMENT_TEAM,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID,
            $settlementTeam["userID"],
            QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_ROLE,
            $settlementTeam["role"]
        );

        if ($settlementTeamPartyId !== false) {
            QualiaUtils\QualiaBeanUtils::unlinkPartyFromRecordId(
                $settlementTeamPartyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL,
                $orderID
            );
        }
    }

    /**
     * get accepted roles for Settlement Team members
     *
     * @return array
     */
    private function getSettlementTeamRoles(): array
    {
        $settlementTeamRolesConfig = $this->modConfigGet();
        $settlementTeamRoles       = $settlementTeamRolesConfig["qualia-admin-panel"];
        $response                  = [];

        foreach ($settlementTeamRoles as $fieldRole) {
            $roles = explode(",", $fieldRole);

            foreach ($roles as $role) {
                $response[] = trim($role);
            }
        }

        return $response;
    }
}
