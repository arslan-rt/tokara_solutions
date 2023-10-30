<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Contacts;

use LoggerManager;

trait ContactsCreateTrait
{
    use ContactsHelperTrait;

    protected function patchContact($orderId, $newOrder)
    {
        $contactsMeta = $this->contactsMeta;
        $allContacts  = $contactsMeta["value"];

        foreach ($allContacts as $contactType => $contactsMeta) {

            if (array_key_exists("uniqueHash", $contactsMeta) === true) {
                $uniqueHash = $contactsMeta["uniqueHash"];

                if ($uniqueHash === null) {
                    continue;
                }

                $contacts = $contactsMeta["value"];
            } else {
                $contacts = $contactsMeta;
            }

            $this->createContactType($contacts, $contactType, $orderId, $newOrder);
        }
    }

    /**
     * Undocumented function
     *
     * @param Array $contacts
     * @param String $contactType   there are many contacts type, they can be found here QualiaGlobalVariables
     *                              CONTACT_CHILD_XXXXX
     * @param String $orderId
     * @return void
     */
    private function createContactType($contacts, $contactType, $orderId, $newOrder)
    {
        foreach ($contacts as $contact) {

            if (is_array($contact) === false) {
                $logger = LoggerManager::getLogger();
                $logger->fatal("QualiaIntegration: ProcessOrders: issue with orderId = {$orderId}, contact is not array, is {$contact}");
                return;
            }

            $uniqueHash = $contact["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->_patchContact($orderId, $contactType, $contact, $newOrder);
        }
    }
}
