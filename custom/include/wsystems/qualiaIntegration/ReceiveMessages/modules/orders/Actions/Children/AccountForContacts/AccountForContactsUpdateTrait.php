<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\AccountForContacts;

trait AccountForContactsUpdateTrait
{
    use AccountForContactsHelperTrait;

    protected function unlinkExisting(String $accountsUniqueHash, String $accountType, String $orderId)
    {
        $accountPartyId = $this->unlinkAccount($accountsUniqueHash, $accountType, $orderId);
        return $accountPartyId;
    }
}
