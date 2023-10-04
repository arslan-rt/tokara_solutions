<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property;

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class PropertyManager
{
    public function create(string $orderId, array $orderMeta)
    {
        $hasProperty = array_key_exists("properties", $orderMeta);

        if ($hasProperty === false) {
            return true;
        }
        $propertyMeta = $orderMeta["properties"];

        $newOrder          = true;
        $propertyProcessor = new Property($propertyMeta);
        $propertyProcessor->create($orderId, $newOrder);
    }

    public function update(string $orderId, array $orderMeta)
    {
        list(
            "ignore"  => $ignore,
            "added"   => $added,
            "removed" => $removed,
            "updated" => $updated) = QualiaUtils\QualiaSimpleUtils::extractUpdateMeta("properties", $orderMeta);

        if ($ignore === true) {
            return true;
        }

        if (count($added) > 0) {
            $propertyMeta = [
                "value" => $added,
            ];

            $newOrder          = false;
            $propertyProcessor = new Property($propertyMeta);
            $propertyProcessor->create($orderId, $newOrder);
        }

        if (count($updated) > 0) {
            $propertyMeta = [
                "value" => $updated,
            ];

            $propertyProcessor = new Property($propertyMeta);
            $propertyProcessor->update($orderId);
        }

        if (count($removed) > 0) {
            $propertyMeta = [
                "value" => $removed,
            ];

            $propertyProcessor = new Property($propertyMeta);
            $propertyProcessor->delete($orderId);
        }
    }
}
