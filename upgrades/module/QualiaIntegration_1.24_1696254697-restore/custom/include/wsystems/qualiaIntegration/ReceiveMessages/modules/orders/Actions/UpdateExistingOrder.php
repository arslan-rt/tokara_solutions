<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions;

use BeanFactory;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class UpdateExistingOrder extends orders\OrderCore
{
    protected $orderId = null;

    /**
     * update function
     *
     * @param array $orderMeta
     * @param string $orderId - sugar order id
     * @return void
     */
    public function update(array $orderMeta, String $orderId)
    {
        $this->orderId = $orderId;

        $order = $this->getBean($orderId);

        $order = $this->updateSelfFields($order, $orderMeta);

        $order->save();

        $this->checkCoruptedData($order, $orderMeta);

        $this->updateChildren($order, $orderId, $orderMeta);
    }

    private function getBean(String $orderId)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
            $orderId,
            array('disable_row_level_security' => true)
        );

        return $bean;
    }

}
