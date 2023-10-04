<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property;

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property as QualiaProperty;

trait PropertyCreateTrait
{
    use QualiaProperty\PropertyHelperTrait;

    protected function patchProperty($orderId, $newOrder)
    {
        $propertiesMeta = $this->propertiesMeta;
        $properties     = $propertiesMeta["value"];

        foreach ($properties as $property) {
            $uniqueHash = $property["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->_patchProperty($orderId, $property, $newOrder);
        }
    }
}
