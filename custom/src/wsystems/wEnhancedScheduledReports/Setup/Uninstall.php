<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wEnhancedScheduledReports\Setup;

use DBManagerFactory;

class Uninstall
{
    const JOB_STATUS_INACTIVE = "Inactive";

    public function preUninstall()
    {
        global $beanFiles, $beanList;

        // SUGAR BUG FIX - the cache is not cleared correctly so we need to clear it like this
        $beanList["ReportSchedules"] = "ReportSchedule";
        unset($beanFiles["CustomReportSchedule"]);

        $this->deactivateJob();
    }

    /**
     * Set job to inactive is package is uninstalled
     *
     * @return void
     */
    public function deactivateJob(): void
    {
        $jobClass = "function::addWSysRunReportGenerationScheduledTasks";

        $sql = <<<SQL
UPDATE
    schedulers s
SET
    s.status = ?
WHERE
    s.job = ?
AND
    s.deleted = ?
SQL;

        $conn = DBManagerFactory::getConnection();
        $conn->executeStatement($sql, array(self::JOB_STATUS_INACTIVE, $jobClass, 0));
    }
}
