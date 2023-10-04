<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet;

use SugarBean;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Factory;

class Manager
{

    /**
     *
     * @return void
     */
    public static function disableModuleDefCache(): void
    {
        define("SUGAR_PHPUNIT_RUNNER", true);
    }

    /**
     *
     * @param string $reportId
     *
     * @return SugarBean
     */
    public static function getReport(string $reportId): ?\SugarBean
    {
        $report = \BeanFactory::getBean("Reports", $reportId, array("encode" => false, "strict_retrieve" => true));

        return $report;
    }

    /**
     *
     * @param string $reportId
     * @param mixed $forceRefresh
     * @param mixed $linked
     * @param mixed $paginated
     * @param mixed $sort
     * @param mixed $link
     *
     * @return mixed
     */
    public static function getReportData(string $reportId, $forceRefresh, $linked, $paginated, $sort, $contextData)
    {
        self::disableModuleDefCache();

        $report = self::getReport($reportId);
        $runner = Factory::getReportRunner($report, $linked, $paginated, $sort, $contextData);

        if (is_null($contextData["reportOffset"]) === false) {
            $runner->report->report_offset = $contextData["reportOffset"];
        }

        if ($runner->report->is_definition_valid() === false) {
            return [
                "status"   => "failed",
                "reportId" => $reportId,
                "message"  => "LBL_INVALID_REPORT_DEFINITION",
            ];
        }

        $cache = Factory::getReportCache($runner, $forceRefresh);

        return $cache->getCache();
    }
}
