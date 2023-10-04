<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils\QualiaGlobalVariables;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils\Queries;
use Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits\BeanHandlerTrait;

class QualiaTraitsUtils
{
    use BeanHandlerTrait;

    /**
     * Remove old Emails and set the new Email if is valid
     *
     * @param SugarBean $bean
     * @param array $account
     * @return array
     */
    public function setEmail(SugarBean $bean, array $account): void
    {
        $addrs = [];

        foreach ($this->beanEmailsGet($bean) as $email) {
            $addrs[] = $email["email_address"];
        }

        $this->beanEmailsRemove($bean, $addrs);

        $emailAddress = $account["email"];

        if (empty($emailAddress) === false && $this->beanEmailIsValid($bean, $emailAddress)) {

            $email = [
                "address" => $emailAddress,
                "primary" => true,
            ];

            $emails = [$email];
            $this->beanEmailsAdd($bean, $emails);
        }
    }

    /**
     * Set State License ID and State
     *
     * @param SugarBean $bean
     * @param array $account
     * @return array
     */
    public function setStateLicenseIDs(SugarBean &$bean, array $account): void
    {
        $stateLicenseID = $account["stateLicenseIDs"]["value"];

        if (empty($stateLicenseID) === true) {
            return;
        }

        foreach ($stateLicenseID as $stateLicense) {
            $bean->state_license_id    = $stateLicense["id"];
            $bean->state_license_state = $stateLicense["state"];
            break;
        }
    }

    /**
     * Add a new Qualia Party Type if it does not already exist
     *
     * @param SugarBean $bean
     * @param array $account
     * @return array
     */
    public function addPartyTypes(SugarBean &$bean, array $account): void
    {
        $newType      = ucfirst($account["recordType"]);
        $currentTypes = $bean->party_types;

        if (empty($currentTypes)) {
            $types             = ["{$newType}"];
            $newTypes          = encodeMultienumValue($types);
            $bean->party_types = $newTypes;

            return;
        }

        $types = unencodeMultienum($currentTypes);

        if (is_array($types) && in_array($newType, $types)) {
            return;
        }

        $types[]  = "{$newType}";
        $newTypes = encodeMultienumValue($types);

        $bean->party_types = $newTypes;
    }

    /**
     * Updated the Qualia Party Types values.
     *
     * @param string $accountPartyId
     * @return array
     */
    public function updatePartyTypes(string $accountPartyId): void
    {
        $accountRecordID = Queries::getParentId($accountPartyId);

        if (empty($accountRecordID)) {
            return;
        }

        $types    = $this->getQualiaPartyTypes($accountRecordID);
        $newTypes = encodeMultienumValue($types);

        Queries::updateFieldValue(
            QualiaGlobalVariables::ACCOUNT_TABLE_NAME,
            $accountRecordID,
            QualiaGlobalVariables::ACCOUNT_PARTY_TYPES,
            $newTypes
        );
    }

    /**
     * get the Qualia Party Types of the given record.
     *
     * @param string $bean
     * @return array
     */
    public function getQualiaPartyTypes(string $recordID): array
    {
        $partyTypes = Queries::getRecordPartyTypes($recordID);

        return $partyTypes;
    }
}
