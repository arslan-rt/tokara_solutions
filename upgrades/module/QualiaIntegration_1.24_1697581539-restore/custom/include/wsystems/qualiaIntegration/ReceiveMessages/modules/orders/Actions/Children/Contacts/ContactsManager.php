<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Contacts;

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class ContactsManager
{
    public function create(string $orderId, array $orderMeta)
    {
        $hasContacts = array_key_exists("contacts", $orderMeta);

        if ($hasContacts === false) {
            return false;
        }

        $contactsMeta = $orderMeta["contacts"];

        $newOrder = true;
        $contactsProcessor = new Contacts($contactsMeta);
        $contactsProcessor->create($orderId, $newOrder);
    }

    public function update(string $orderId, array $orderMeta)
    {
        list(
            "ignore"  => $ignore,
            "added"   => $added,
            "removed" => $removed,
            "updated" => $updated) = QualiaUtils\QualiaSimpleUtils::extractUpdateMeta("contacts", $orderMeta);

        if ($ignore === true) {
            return true;
        }

        if (count($added) > 0) {
            $contactMeta = [
                "value" => $added,
            ];

            //order update functionality
            $newOrder = false;
            $contactProcessor = new Contacts($contactMeta);
            $contactProcessor->create($orderId, $newOrder);
        }

        if (count($updated) > 0) {
            $contactMeta = [
                "value" => $updated,
            ];

            $contactProcessor = new Contacts($contactMeta);
            $contactProcessor->update($orderId);
        }

        if (count($removed) > 0) {
            $contactMeta = [
                "value" => $removed,
            ];

            $contactProcessor = new Contacts($contactMeta);
            $contactProcessor->delete($orderId);
        }
    }
}
