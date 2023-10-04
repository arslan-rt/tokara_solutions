<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Contacts;

use BeanFactory;
use LoggerManager;
use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\AccountForContacts\AccountForContactsManager;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

trait ContactsHelperTrait
{
    /**
     * _patchContact function
     *
     * @param String $orderId
     * @param String $contactType
     * @param array $contact
     * @return void
     */
    protected function _patchContact(String $orderId, String $contactType, array $contact, bool $newOrder)
    {
        if (in_array($contactType, QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_TYPE_BORROWER_SELLER)) {
            $this->_patchContactsBorrower($orderId, $contactType, $contact, $newOrder);
        } else if ($contactType === QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SOURCE_OF_BUSINESS) {
            $this->_patchSourceOfBusiness($orderId, $contactType, $contact, $newOrder);
        } else {
            $this->_patchContactCompany($orderId, $contactType, $contact, $newOrder);
        }
    }

    /**
     * _patchContactsBorrower function
     *
     * @param String $orderId
     * @param String $contactType   contact type like borrowers/sellers
     * @param array $contact
     * @return void
     */
    private function _patchContactsBorrower(String $orderId, String $contactType, array $contact, bool $newOrder)
    {
        $recordData = QualiaUtils\Queries::getRecordIdAndDiffHashByUniqueId(
            QualiaUtils\QualiaGlobalVariables::CONTACT_TABLE_NAME,
            QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            $contact["uniqueHash"]
        );

        $recordId       = $recordData["id"];
        $recordDiffHash = $recordData["qualia_diff_hash"];

        $borrowerFieldsName = [
            "firstName",
            "lastName",
            "email",
        ];

        $contactFieldsMapping  = $this->getContactFieldsMapping($contactType);
        $contact["recordType"] = $contactType;

        $name      = $this->_getContactName($contact, $borrowerFieldsName);
        $partyMeta = $this->_getPartyMeta($contact, $contactType);

        if ($recordId === false) {
            $recordId = $this->_createContactBean($contact, $contactFieldsMapping);
        } else if ($recordDiffHash !== $contact["diffHash"]) {
            $this->_updateContactBean($recordId, $contact, $contactFieldsMapping);
        }

        $contactPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH,
            ucfirst($contactType),
            $contact["uniqueHash"]
        );

        if ($contactPartyId === false) {
            $contactPartyId = QualiaUtils\QualiaBeanUtils::createParty(
                ucfirst($contactType),
                QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME,
                $recordId,
                $name,
                $partyMeta
            );
        } else if ($recordDiffHash !== $contact["diffHash"]) {
            $this->_updateParty($contactPartyId, $name, $partyMeta);
        }

        //we dont need to check if the records are already related because this is the order create functionality
        if ($newOrder === true) {
            $orderLinked = false;
        } else {
            $orderLinked = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
                $contactPartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }

        if ($orderLinked === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $contactPartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }
    }

    /**
     * _patchSourceOfBusiness function
     *
     * @param String $orderId
     * @param String $contactType   contact type like borrowers/sellers
     * @param array $contact
     * @return void
     */
    private function _patchSourceOfBusiness(String $orderId, String $contactType, array $contact, bool $newOrder)
    {
        if (empty($contact["borrowerOrSeller"]) === false) {
            $this->_patchSourceOfBusinessBorrowerOrSeler($orderId, $contactType, $contact, $newOrder);
        } else {
            $this->_patchSourceOfBusinessCompany($orderId, $contactType, $contact, $newOrder);
        }
    }

    private function _patchSourceOfBusinessBorrowerOrSeler(String $orderId, String $contactType, array $contact, bool $newOrder)
    {
        $contactCompany = $this->getContactBorrowerOrSeler($contact);

        if (empty($contactCompany) === true) {
            return;
        }

        $this->_patchContactsBorrower($orderId, $contactType, $contactCompany, $newOrder);
    }

    private function getContactBorrowerOrSeler($contact)
    {
        if (empty($contact["manualEntry"]) === false) {
            return [
                "firstName"  => $contact["manualEntry"],
                "lastName"   => "",
                "uniqueHash" => $contact["uniqueHash"],
                "diffHash"   => $contact["diffHash"],
            ];
        }

        $contactBorrowerOrSeller = $contact["borrowerOrSeller"]["value"];
        if (empty($contactBorrowerOrSeller)) {
            return [];
        }

        foreach ($contactBorrowerOrSeller as $borrowerOrSeller) {
            return $borrowerOrSeller;
        }
    }

    private function _patchSourceOfBusinessCompany(String $orderId, String $contactType, array $contact, bool $newOrder)
    {
        $contactCompany = $this->getContactCompany($contact);

        if (empty($contactCompany) === true) {
            return;
        }

        $this->_patchContactCompany($orderId, $contactType, $contactCompany, $newOrder);
    }

    private function getContactCompany($contact)
    {
        if (empty($contact["manualEntry"]) === false) {
            return [
                "name"       => $contact["manualEntry"],
                "uniqueHash" => $contact["uniqueHash"],
                "diffHash"   => $contact["diffHash"],
                "id"         => $contact["uniqueHash"],
            ];
        }

        $contactCompanies = $contact["company"]["value"];
        if (empty($contactCompanies)) {
            return [];
        }

        foreach ($contactCompanies as $company) {
            return $company;
        }
    }

    /**
     * _patchContactCompany function
     *
     * @param String $orderId
     * @param String $contactType contact type like lenders underwriters ...etc (see QualiaGlobalVariables)
     * @param array $contact
     * @return void
     */
    private function _patchContactCompany(String $orderId, String $contactType, array $contact, bool $newOrder)
    {
        $accountForContactsManager = new AccountForContactsManager();
        $accountData               = $accountForContactsManager->patch($orderId, $contact, $contactType, $newOrder);

        if (empty($accountData) === 0
            || QualiaUtils\StringUtils::isNotNullOrEmptyString($accountData["accountId"]) === false
            || QualiaUtils\StringUtils::isNotNullOrEmptyString($accountData["partyId"]) === false) {
            return;
        }

        $accountId  = $accountData["accountId"];
        $partyId    = $accountData["partyId"];
        $associates = $contact["associates"]["value"];

        if (empty($associates) === true) {
            return;
        }

        $associateType        = QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_ASSOCIATE;
        $associatesFieldsName = [
            "firstName",
            "lastName",
        ];
        $associatesFieldsMapping = $this->getContactFieldsMapping($associateType);

        // We need to see if the associates are linked or if they need to pe created
        if ($accountData["newPartyBean"] === false) {
            $this->unLinkRemovedAssoaciates($orderId, $partyId, $associates, $contactType);
        }

        foreach ($associates as $associate) {
            $associate["parentPartyType"] = $contactType;
            $associate["recordType"]      = $associateType;

            $this->handleAssociate($associate, $accountId, $partyId, $associateType,
                $associatesFieldsName, $associatesFieldsMapping, $orderId);
        }
    }

    private function getContactFieldsMapping($contactType)
    {
        switch ($contactType) {
            case QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_BORROWER:
                $contactFieldsMapping = [
                    "cellPhone"     => "phone_mobile",
                    "email"         => "email1",
                    "firstName"     => "first_name",
                    "lastName"      => "last_name",
                    "maritalStatus" => "marital_status",
                    "type"          => "title",
                    "uniqueHash"    => QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
                    "diffHash"      => QualiaUtils\QualiaGlobalVariables::QUALIA_DIFF_HASH,
                ];
                break;
            case QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SELLER:
                $contactFieldsMapping = [
                    "cellPhone"     => "phone_mobile",
                    "email"         => "email1",
                    "firstName"     => "first_name",
                    "lastName"      => "last_name",
                    "maritalStatus" => "marital_status",
                    "type"          => "title",
                    "uniqueHash"    => QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
                    "diffHash"      => QualiaUtils\QualiaGlobalVariables::QUALIA_DIFF_HASH,
                ];
                break;
            case QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_ASSOCIATE:
                $contactFieldsMapping = [
                    "firstName"         => "first_name",
                    "lastName"          => "last_name",
                    "id"                => QualiaUtils\QualiaGlobalVariables::QUALIA_ID,
                    "uniqueHash"        => QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
                    "diffHash"          => QualiaUtils\QualiaGlobalVariables::QUALIA_DIFF_HASH,
                    "parentPartyType"   => QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_PARTY_TYPE_FIELD,
                    "workPhone"         => "phone_work",
                    "cellPhone"         => "phone_mobile",
                    "jobTitle"          => "title",
                    "nationalLicenseID" => "national_license_id",
                ];
                break;
            case QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SOURCE_OF_BUSINESS:
                $contactFieldsMapping = [
                    "cellPhone"     => "phone_mobile",
                    "email"         => "email1",
                    "firstName"     => "first_name",
                    "lastName"      => "last_name",
                    "maritalStatus" => "marital_status",
                    "type"          => "title",
                    "uniqueHash"    => QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
                    "diffHash"      => QualiaUtils\QualiaGlobalVariables::QUALIA_DIFF_HASH,
                ];
                break;
            default:
                $contactFieldsMapping = [];
                $logger               = LoggerManager::getLogger();
                $logger->fatal("ContactFieldsMapping not found for {$contactType}");
                break;
        }
        return $contactFieldsMapping;
    }

    /**
     * _getContactName function
     *
     * @param Array $contact
     * @param Array $fields
     * @return String
     */
    private function _getContactName($contact, $fields)
    {
        $name = "";

        foreach ($fields as $field) {
            if (array_key_exists($field, $contact) === true &&
                QualiaUtils\StringUtils::isNotNullOrEmptyString($contact[$field]) === true) {

                if ($field === "email" && empty($name) === false) {
                    return $name;
                }

                //sometimes the seller has name instead of first and last name
                if ($field === "email" && empty($name) === true) {
                    if (empty($contact["name"]) === false) {
                        return $contact["name"];
                    }
                }

                $name .= $contact[$field] . " ";
            }
        }

        if (strlen($name) < 1) {

            if (empty($contact["name"]) === false) {
                return $contact["name"];
            }

            $name = "No name";
        }

        $name = trim($name);
        return $name;
    }

    /**
     * _createContactBean function
     *
     * @param array $contact
     * @param array $fieldsList since we have to types of contacts we will need to separate types of fields
     * @return String
     */
    private function _createContactBean(array $contact, array $contactFieldsMapping)
    {
        $bean                   = BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME);
        $id                     = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $bean->id               = $id;
        $bean->new_with_id      = true;
        $bean->assigned_user_id = QualiaUtils\QualiaSimpleUtils::getCurrentUserId();

        $bean = $this->_updateSelfContactFields($bean, $contact, $contactFieldsMapping);

        $bean->save();

        return $bean->id;
    }

    private function _updateContactBean(string $id, array $contact, array $contactFieldsMapping)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME,
            $id,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean            = $this->_updateSelfContactFields($bean, $contact, $contactFieldsMapping);
        $bean->processed = true;
        $bean->save();
    }

    /**
     * _getPartyMeta function
     *
     * @param array $contact
     * @return array
     */
    private function _getPartyMeta(array $contact, string $contactType)
    {
        $uniqueHash = $contact["uniqueHash"];
        $meta       = [QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH => $uniqueHash];

        if ($contactType === "associates") {
            $qualiaID                                                               = $contact["id"];
            $meta[QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID]               = $qualiaID;
            $meta[QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_PARTY_TYPE_FIELD] = ucfirst($contact["parentPartyType"]);
        }

        return $meta;
    }

    /**
     * _updateSelfContactFields function
     *
     * @param SugarBean $bean
     * @param array $contact
     * @param array $contactFieldsMapping
     * @return SugarBean
     */
    private function _updateSelfContactFields(SugarBean $bean, array $contact, array $contactFieldsMapping)
    {
        foreach ($contactFieldsMapping as $qualiaField => $sugarField) {
            if (array_key_exists($qualiaField, $contact) === true) {
                $qualiaValue = $contact[$qualiaField];

                if ($sugarField === "salutation") {
                    if ($qualiaValue === "MALE") {
                        $qualiaValue = "Mr.";
                    } else {
                        $qualiaValue = "Ms.";
                    }
                }

                $bean->{$sugarField} = $contact[$qualiaField];
            }
        }

        if (QualiaUtils\StringUtils::isNotNullOrEmptyString($bean->first_name) === false
            && QualiaUtils\StringUtils::isNotNullOrEmptyString($bean->last_name) === false) {

            if (array_key_exists("name", $contact) === true && empty($contact["name"]) === false) {
                $bean->last_name = $contact["name"];
            } else {
                $bean->last_name = "No Name From Qualia";
            }
        }

        if ($contact["recordType"] === QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_ASSOCIATE) {
            $qualiaTraitsUtils = new QualiaUtils\QualiaTraitsUtils();

            $qualiaTraitsUtils->setEmail($bean, $contact);
            $qualiaTraitsUtils->setStateLicenseIDs($bean, $contact);
        } else {
            if (array_key_exists("currentAddress", $contact)) {
                $bean->primary_address_street     = (string) $contact["currentAddress"]["value"]["address1"];
                $bean->primary_address_street_2   = (string) $contact["currentAddress"]["value"]["address2"];
                $bean->primary_address_city       = (string) $contact["currentAddress"]["value"]["city"];
                $bean->primary_address_state      = (string) $contact["currentAddress"]["value"]["state"];
                $bean->primary_address_postalcode = (string) $contact["currentAddress"]["value"]["zipcode"];
                $bean->primary_address_country    = (string) $contact["currentAddress"]["value"]["county"];
            }

            if (array_key_exists("forwardingAddress", $contact)) {
                $bean->alt_address_street     = (string) $contact["forwardingAddress"]["value"]["address1"];
                $bean->alt_address_street_2   = (string) $contact["forwardingAddress"]["value"]["address2"];
                $bean->alt_address_city       = (string) $contact["forwardingAddress"]["value"]["city"];
                $bean->alt_address_state      = (string) $contact["forwardingAddress"]["value"]["state"];
                $bean->alt_address_postalcode = (string) $contact["forwardingAddress"]["value"]["zipcode"];
                $bean->alt_address_country    = (string) $contact["forwardingAddress"]["value"]["county"];
            }
        }

        return $bean;
    }

    private function unLinkRemovedAssoaciates($orderId, $partyId, $associates, $parentPartyType)
    {
        $orderBean = BeanFactory::retrieveBean(QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME, $orderId, array('disable_row_level_security' => true));
        if ($orderBean->load_relationship(QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL) === false) {
            $logger = LoggerManager::getLogger();
            $logger->fatal("Qualia[unLinkRemovevdAssociates] relationship not found");

            return;
        };

        $partiesRelatedToOrder = $orderBean->{QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL}->get();

        $associatesUniqueIds = [];
        foreach ($associates as $associate) {
            $associatesUniqueIds[] = $associate["id"];
        }

        $partyBean = BeanFactory::retrieveBean(QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME, $partyId, array('disable_row_level_security' => true));
        $partyBean->load_relationship(QualiaUtils\QualiaGlobalVariables::PARTY_PARTY_REL);
        $relatedBeans = $partyBean->{QualiaUtils\QualiaGlobalVariables::PARTY_PARTY_REL}->getBeans();

        foreach ($relatedBeans as $bean) {
            $beanQualiaID = $bean->{QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID};

            if (in_array($bean->id, $partiesRelatedToOrder) === true
                && $bean->parent_party_type === ucfirst($parentPartyType) && in_array($beanQualiaID, $associatesUniqueIds) === false) {
                $partyBean->{QualiaUtils\QualiaGlobalVariables::PARTY_PARTY_REL}->delete($partyBean->id, $bean->id);
                $orderBean->{QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL}->delete($orderBean->id, $bean->id);
            }
        }
    }

    /**
     * @param array $associate
     * @param string $accountId
     * @param string $partyId
     * @param string $associateType
     * @param array $associatesFieldsName
     * @param array $associatesFieldsMapping
     * @return void
     */
    private function handleAssociate($associate, $accountId, $partyId, $associateType,
        $associatesFieldsName, $associatesFieldsMapping, $orderId) {

        $recordData = QualiaUtils\Queries::getRecordIdAndDiffHashByQualiaId(
            QualiaUtils\QualiaGlobalVariables::CONTACT_TABLE_NAME,
            QualiaUtils\QualiaGlobalVariables::QUALIA_ID,
            $associate["id"]
        );

        $recordId       = $recordData["id"];
        $recordDiffHash = $recordData["qualia_diff_hash"];

        $name      = $this->_getContactName($associate, $associatesFieldsName);
        $partyMeta = $this->_getPartyMeta($associate, $associateType);

        if ($recordId === false) {
            $recordId = $this->_createContactBean($associate, $associatesFieldsMapping);
        } else if ($recordDiffHash !== $associate["diffHash"]) {
            $this->_updateContactBean($recordId, $associate, $associatesFieldsMapping);
        }

        $associatePartyId = QualiaUtils\Queries::getAssociateParty(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            ucfirst($associateType),
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID,
            $associate["id"],
            QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_PARTY_TYPE_FIELD,
            ucfirst($associate["parentPartyType"])
        );

        if ($associatePartyId === false) {
            $associatePartyId = QualiaUtils\QualiaBeanUtils::createParty(
                QualiaUtils\QualiaGlobalVariables::ASSOCIATE_CHILD,
                QualiaUtils\QualiaGlobalVariables::CONTACT_MODULE_NAME,
                $recordId,
                $name,
                $partyMeta
            );
        } else if ($recordDiffHash !== $associate["diffHash"]) {
            $this->_updateParty($associatePartyId, $name, $partyMeta);
        }

        $partiesRelated = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
            $associatePartyId,
            $partyId,
            QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
            QualiaUtils\QualiaGlobalVariables::PARTY_PARTY_REL
        );

        if ($partiesRelated === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $associatePartyId,
                $partyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_PARTY_REL
            );
        }

        $partyRelatedToOrder = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
            $associatePartyId,
            $orderId,
            QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
            QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
        );

        if ($partyRelatedToOrder === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $associatePartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }

        $recordsRelated = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
            $recordId,
            $accountId,
            QualiaUtils\QualiaGlobalVariables::ACCOUNT_MODULE_NAME,
            QualiaUtils\QualiaGlobalVariables::ACCOUNTS_CONTACTS_REL
        );

        if ($recordsRelated === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $recordId,
                $accountId,
                QualiaUtils\QualiaGlobalVariables::ACCOUNT_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::ACCOUNTS_CONTACTS_REL
            );
        }
    }

    protected function _updateParty(string $contactPartyId, string $name, array $partyMeta)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
            $contactPartyId,
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

    private function unlinkContact($contact, $contactType, $orderId)
    {
        if (in_array($contactType, QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_TYPE_BORROWER_SELLER)) {
            $this->_unlinkContactsBorrower($contact, $contactType, $orderId);
        } else if ($contactType === QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_SOURCE_OF_BUSINESS) {
            $this->_unlinkSourceOfBusiness($contact, $contactType, $orderId);
        } else {
            $this->_unlinkContactCompany($contact, $contactType, $orderId);
        }
    }

    private function _unlinkContactsBorrower($contact, $contactType, $orderId)
    {
        $contactPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            ucfirst($contactType),
            $contact["uniqueHash"]
        );

        if ($contactPartyId !== false) {
            QualiaUtils\QualiaBeanUtils::unlinkPartyFromRecordId(
                $contactPartyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL,
                $orderId
            );
        }
    }

    private function _unlinkSourceOfBusiness($contact, $contactType, $orderId)
    {
        $contactCompany = $this->getContactCompany($contact);

        if (empty($contactCompany) === true) {
            return;
        }
        $this->_unlinkContactCompany($contactCompany, $contactType, $orderId);
    }

    private function _unlinkContactCompany($contact, $contactType, $orderId)
    {
        $accountForContactsManager = new AccountForContactsManager();
        $accountPartyId            = $accountForContactsManager->unlinkExisting($contact, $contactType, $orderId);

        $associates    = $contact["associates"]["value"];
        $associateType = QualiaUtils\QualiaGlobalVariables::CONTACT_CHILD_ASSOCIATE;

        if (empty($associates) === true) {
            return;
        }

        foreach ($associates as $associate) {
            $associate["parentPartyType"] = $contactType;

            $this->unlinkAssociate($associate, $associateType, $accountPartyId);
        }
    }

    private function unlinkAssociate($associate, $associateType, $accountPartyId)
    {
        $associatePartyId = QualiaUtils\Queries::getAssociateParty(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            ucfirst($associateType),
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_ID,
            $associate["id"],
            QualiaUtils\QualiaGlobalVariables::PARTY_PARENT_PARTY_TYPE_FIELD,
            ucfirst($associate["parentPartyType"])
        );

        if ($associatePartyId !== false) {
            QualiaUtils\QualiaBeanUtils::unlinkPartyFromRecordId(
                $associatePartyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_PARTY_REL,
                $accountPartyId
            );
        }
    }

}
