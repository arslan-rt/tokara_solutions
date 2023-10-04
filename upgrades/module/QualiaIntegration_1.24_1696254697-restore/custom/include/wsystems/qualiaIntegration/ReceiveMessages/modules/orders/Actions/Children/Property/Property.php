<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Property;

class Property
{
    use PropertyCreateTrait;
    use PropertyUpdateTrait;

    public function __construct(?array $propertiesMeta)
    {
        $this->propertiesMeta = $propertiesMeta;
    }

    public function create($orderId, $newOrder)
    {
        $this->patchProperty($orderId, $newOrder);
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
