<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Contacts;

trait ContactsUpdateTrait
{
    use ContactsHelperTrait;

    protected function updateExisting(String $orderId)
    {
        $contactsMeta = $this->contactsMeta;
        $allContacts  = $contactsMeta["value"];

        foreach ($allContacts as $contactType => $contacts) {
            $this->updateContactType($contacts, $contactType, $orderId);
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
    private function updateContactType($contacts, $contactType, $orderId)
    {
        foreach ($contacts as $contact) {
            $uniqueHash = $contact["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->_patchContact($orderId, $contactType, $contact, false);
        }
    }

    /**
     * unlinkExisting function
     *
     * Used to unlink parties between order and loans
     *
     * @param String $orderId
     * @return void
     */
    protected function unlinkExisting(String $orderId)
    {
        $contactsMeta = $this->contactsMeta;
        $allContacts  = $contactsMeta["value"];

        foreach ($allContacts as $contactType => $contacts) {
            $this->unlinkContactType($contacts, $contactType, $orderId);
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
    private function unlinkContactType($contacts, $contactType, $orderId)
    {
        foreach ($contacts as $contact) {
            $uniqueHash = $contact["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->unlinkContact($contact, $contactType, $orderId);
        }
    }

}
