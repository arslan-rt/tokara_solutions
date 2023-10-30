<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Contacts;

class Contacts
{
    use ContactsCreateTrait;
    use ContactsUpdateTrait;

    public function __construct(?array $contactsMeta)
    {
        $this->contactsMeta = $contactsMeta;
    }

    public function create($orderId, $newOrder)
    {
        $this->patchContact($orderId, $newOrder);
    }

    public function update($orderId)
    {
        $this->updateExisting($orderId);
    }

    public function delete($orderId)
    {
        $this->unlinkExisting($orderId);
    }
}
