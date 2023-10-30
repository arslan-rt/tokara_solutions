<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\AccountForContacts;

class AccountForContacts
{
    use AccountForContactsCreateTrait;
    use AccountForContactsUpdateTrait;

    public function __construct(?array $accountMeta)
    {
        $this->accountMeta = $accountMeta;
    }

    public function patchAccount($orderId, $accountType, $newOrder)
    {
        $accountData = $this->patch($orderId, $accountType, $newOrder);
        return $accountData;
    }

    public function delete($accountType, $orderId) {
        $accountsUniqueHash = $this->accountMeta["uniqueHash"];
        $accountPartyId    = $this->unlinkExisting($accountsUniqueHash, $accountType, $orderId);
        return $accountPartyId;
    }
    
}
