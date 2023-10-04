<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions;

use BeanFactory;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class CreateNewOrder extends orders\OrderCore
{
    protected $orderId = null;

    public function create(array $orderMeta, $orderId)
    {
        $this->orderId = $orderId;

        $order = $this->createNewBean();

        $order = $this->updateSelfFields($order, $orderMeta);

        $order->save();

        $this->checkCoruptedData($order, $orderMeta);

        $this->createChildren($orderId, $orderMeta);
    }

    private function createNewBean()
    {
        $bean = BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME);

        $bean->id          = $this->orderId;
        $bean->new_with_id = true;

        return $bean;
    }
}
