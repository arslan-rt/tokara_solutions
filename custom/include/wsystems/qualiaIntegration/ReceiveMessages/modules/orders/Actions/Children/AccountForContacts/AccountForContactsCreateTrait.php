<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\AccountForContacts;

trait AccountForContactsCreateTrait
{
    use AccountForContactsHelperTrait;

    protected function patch($orderId, $accountType, $newOrder)
    {
        $accountsUniqueHash = $this->accountMeta["uniqueHash"];

        /**
         * this is the unique hash of all the accounts
         * if its null then we have no accounts
         */
        if ($accountsUniqueHash === null) {
            return true;
        }

        $accountData = $this->getAccount($this->accountMeta, $accountType, $orderId, $newOrder);
        return $accountData;
    }

    private function getAccount($account, $accountType, $orderId, $newOrder)
    {
        $uniqueHash = $account["uniqueHash"];

        if ($uniqueHash === null) {
            return false;
        }

        $accountData = $this->_patchAccount($orderId, $accountType, $account, $newOrder);
        return $accountData;
    }
}
