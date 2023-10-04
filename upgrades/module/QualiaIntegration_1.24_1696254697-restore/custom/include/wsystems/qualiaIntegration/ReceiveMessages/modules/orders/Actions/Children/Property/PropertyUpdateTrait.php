<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property;

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property as QualiaProperty;

trait PropertyUpdateTrait
{
    use QualiaProperty\PropertyHelperTrait;

    protected function updateExisting(String $orderId)
    {
        $propertiesMeta = $this->propertiesMeta;
        $properties     = $propertiesMeta["value"];

        foreach ($properties as $property) {
            $uniqueHash = $property["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->_patchProperty($orderId, $property, false);
        }
    }

    /**
     * unlinkExisting function
     *
     * Used to unlink parties between order and property
     *
     * @param String $orderId
     * @return void
     */
    protected function unlinkExisting(String $orderId)
    {
        $propertiesMeta = $this->propertiesMeta;
        $properties     = $propertiesMeta["value"];

        foreach ($properties as $property) {
            $uniqueHash = $property["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->unlinkProperty($uniqueHash, $orderId);
        }

    }
}
