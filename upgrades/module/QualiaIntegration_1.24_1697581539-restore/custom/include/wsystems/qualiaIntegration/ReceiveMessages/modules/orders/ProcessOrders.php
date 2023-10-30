<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders;

use Exception;
use LoggerManager;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions as QualiaActions;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;
use Throwable;

class ProcessOrders
{
    public function __construct()
    {
        $this->createOrder = new QualiaActions\CreateNewOrder();
        $this->updateOrder = new QualiaActions\UpdateExistingOrder();
    }

    /**
     * run function
     *
     * Process all the orders from Qualia
     *
     * @param array $ordersMeta
     * @return void
     */
    public function run(array $ordersMeta): bool
    {
        $status = true;
        for ($i = 0; $i < count($ordersMeta); $i++) {
            $orderMeta = $ordersMeta[$i];
            $orderData = $orderMeta["value"];

            try {
                $this->processOrder($orderData);
            } catch (Exception $e) {
                $status = false;
                $logger = LoggerManager::getLogger();
                $logger->fatal("QualiaIntegration: ProcessOrders: " . $e->getMessage());
                $this->recoveryFailedRecords($e, $orderMeta);
            } catch (Throwable $e) {
                $status = false;
                $logger = LoggerManager::getLogger();
                $logger->fatal("QualiaIntegration: ProcessOrders: " . $e->getMessage());
                $this->recoveryFailedRecords($e, $orderMeta);
            }
        }

        return $status;
    }

    /**
     * processOrder function
     *
     * @param array $orderData
     * @return void
     */
    private function processOrder(array $orderData)
    {
        $hash = $orderData["uniqueHash"];

        $sugarOrderId = QualiaUtils\Queries::getOrderByUnqiueHash($hash);

        if ($sugarOrderId === false) {
            $id = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
            $this->createOrder->create($orderData, $id);
        } else {
            $this->updateOrder->update($orderData, $sugarOrderId);
        }
    }

    /**
     *
     * @param Exception $e
     * @param Array $data
     * @return void
     */
    private function recoveryFailedRecords($e, $orderMeta)
    {
        $id                  = $orderMeta["value"]["uniqueHash"];
        $encodedOrderMeta    = QualiaUtils\QualiaArrayUtils::safe_json_encode($orderMeta);
        $encodedErrorMessage = QualiaUtils\QualiaArrayUtils::safe_json_encode($e->getMessage());
        $tableName           = 'qualia_failed_records';
        QualiaUtils\Queries::insertFailedRecord($tableName, $encodedErrorMessage, $encodedOrderMeta, $id);
    }
}
