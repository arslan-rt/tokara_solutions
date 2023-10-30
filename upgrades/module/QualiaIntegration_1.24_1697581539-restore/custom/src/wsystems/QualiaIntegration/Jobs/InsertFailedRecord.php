<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Jobs;

use BeanFactory;
use DBManagerFactory;
use Exception;
use RunnableSchedulerJob;
use SchedulersJob;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\ProcessOrders;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;
use Throwable;

class InsertFailedRecord implements RunnableSchedulerJob
{
    /**
     * @var SchedulersJob
     */
    protected $job;

    public function __construct()
    {
        $this->startTimer();
    }

    /**
     * @param SchedulersJob $job
     *
     * @return void
     */
    public function setJob(SchedulersJob $job): void
    {
        $this->job = $job;

        $this->db   = DBManagerFactory::getInstance();
        $this->conn = $this->db->getConnection();
    }

    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function run($data): bool
    {
        try {
            $this->startProcessing();

            return true;
        } catch (Throwable $e) {
            $this->job->name .= " [ERROR: " . $e->getMessage() . "]";
            $this->job->message = $e->getMessage() . "\n" . $e->getTraceAsString();
        }

        return true;
    }

    protected function startProcessing()
    {
        $minLimit = 0;
        $maxLimit = 20;

        do {
            $totalRec = $this->getTotalRecordsCount();

            if ($totalRec < 1) {
                break;
            }

            $sql = <<<EOQ
            SELECT
                *
            FROM
                qualia_failed_records
            LIMIT
                ?,?
EOQ;

            $exec = $this->conn->executeQuery($sql, [$minLimit, $maxLimit]);

            do {
                $row = $exec->fetchAssociative();

                if ($row === false) {
                    break;
                }

                $this->processData($row);

                $elapsedMinutes = $this->elapsedMinutes();
                if ($elapsedMinutes > 19) {
                    return true;
                }

            } while ($row !== false);
        } while (true);
    }

    /**
     * getTotalRecordsCount function
     *
     *  Get total numbers of records
     *
     * @return Integer
     */
    protected function getTotalRecordsCount()
    {
        $sql = <<<EOQ
        SELECT
            count(id) recNr
        FROM
            qualia_failed_records
EOQ;

        $exec = $this->conn->executeQuery($sql);

        if ($exec instanceof \Doctrine\DBAL\Portability\Statement === false
            && $exec instanceof \Doctrine\DBAL\ForwardCompatibility\Result === false) {
            return 0;
        }

        $fetchedResp = $exec->fetchAllAssociative();

        if (count($fetchedResp) > 0) {
            return $fetchedResp[0]['recNr'];
        }

        return 0;
    }

    protected function processData($data)
    {
        $id           = $data["id"];
        $errorMessage = $data["error_message"];
        $dateCreated  = $data["date_created"];
        $dateModified = $data["date_modified"];
        $orderData    = json_decode($data["order_data"], true);
        $qualiaData[] = $orderData;

        $hash         = $orderData["value"]["uniqueHash"];
        $sugarOrderId = QualiaUtils\Queries::getOrderByUnqiueHash($hash);

        if ($sugarOrderId === false) {
            $this->processOrder($qualiaData, $data, $id);
        } else {
            $order = BeanFactory::retrieveBean(
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                $sugarOrderId,
                array('disable_row_level_security' => true)
            );

            if ($dateModified > $order->date_modified) {
                $this->processOrder($qualiaData, $data, $id);
            }
        }

        $this->removeProcessed($id);
    }

    protected function processOrder($qualiaData, $data, $id)
    {
        try {
            $processOrders = new ProcessOrders();
            $processOrders->run($qualiaData);

        } catch (Exception $e) {
            $tableName           = 'qualia_broken_records';
            $encodedErrorMessage = QualiaUtils\QualiaArrayUtils::safe_json_encode($e->getMessage());
            QualiaUtils\Queries::insertFailedRecord($tableName, $encodedErrorMessage, $data["order_data"], $id);
        } catch (Throwable $e) {
            $tableName           = 'qualia_broken_records';
            $encodedErrorMessage = QualiaUtils\QualiaArrayUtils::safe_json_encode($e->getMessage());
            QualiaUtils\Queries::insertFailedRecord($tableName, $encodedErrorMessage, $data["order_data"], $id);
        }
    }

    protected function removeProcessed($id)
    {
        $query = <<<EOQ
        DELETE FROM
            qualia_failed_records
        WHERE
            id = ?
EOQ;

        $this->conn->executeQuery($query, [$id]);
    }

    /**
     * startTimer function
     *
     * Start the timer
     *
     * @return void
     */
    protected function startTimer()
    {
        $this->startTime = microtime(true);
    }

    /**
     * elapsedMinutes function
     *
     * Get how much mintues have passed since start
     *
     * @return void
     */
    protected function elapsedMinutes()
    {
        $elapsed = microtime(true) - $this->startTime;

        $hours   = (int) ($elapsed / 60 / 60);
        $minutes = (int) ($elapsed / 60) - $hours * 60;

        return $minutes;
    }

}
