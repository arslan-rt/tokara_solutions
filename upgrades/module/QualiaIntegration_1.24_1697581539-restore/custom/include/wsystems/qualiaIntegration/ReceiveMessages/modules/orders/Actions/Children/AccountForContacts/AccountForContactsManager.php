<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\AccountForContacts;

class AccountForContactsManager
{
    /**
     * patch function
     *
     * @param String $orderId
     * @param array $accountMeta
     * @param String $accountType
     * @return array
     */
    public function patch(string $orderId, array $accountMeta, string $accountType, bool $newOrder)
    {
        $accountsProcessor = new AccountForContacts($accountMeta);
        $accountData       = $accountsProcessor->patchAccount($orderId, $accountType, $newOrder);
        return $accountData;
    }

    public function unlinkExisting(array $accountMeta, string $accountType, string $orderId)
    {
        $accountsProcessor = new AccountForContacts($accountMeta);
        $accountPartyId    = $accountsProcessor->delete($accountType, $orderId);
        return $accountPartyId;
    }
}
