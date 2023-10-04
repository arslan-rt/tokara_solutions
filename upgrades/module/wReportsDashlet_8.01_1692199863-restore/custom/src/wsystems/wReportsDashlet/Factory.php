<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet;

use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Cache\Table;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner\Matrix;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner\RowsAndColumns;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner\Summation;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner\SummationWithDetails;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Traits;

class Factory
{
    use Traits\ModuleConfigTrait;

    /**
     *
     * @param mixed $report
     * @param bool $linked
     * @param bool $paginated
     * @param array $sort
     * @param array $link
     *
     * @return RowsAndColumns|Summation|SummationWithDetails|Matrix|null
     */
    public static function getReportRunner($report, $linked = false, $paginated = false, $sort = array(), $link = array())
    {
        $runner      = null;
        $report_type = strpos($report->content, "\"layout_options\":") > 0 ? "matrix" : $report->report_type;

        switch ($report_type) {
            case "tabular":
                $runner = new Runner\RowsAndColumns($report, $linked, $paginated, $sort, $link);
                break;

            case "summary":
                $runner = new Runner\Summation($report, $linked, $paginated, $sort, $link);
                break;

            case "detailed_summary":
                $runner = new Runner\SummationWithDetails($report, $linked, $paginated, $sort, $link);
                break;

            case "matrix":
                $runner = new Runner\Matrix($report, $linked, $paginated, $sort, $link);
                break;
        }

        return $runner;
    }

    /**
     *
     * @param mixed $runner
     * @param mixed $refresh
     *
     * @return Table
     */
    public static function getReportCache($runner, $refresh)
    {
        if ((new self)->useTableCache() === true) {
            $cache = new Cache\Table($runner, $refresh);
        } else {
            $cache = new Cache\Sugar($runner, $refresh);
        }

        return $cache;
    }

    public function useTableCache(): bool
    {
        $config = $this->modConfigGet();

        if (is_array($config) === false) {
            return false;
        }

        if (is_array($config["wreportsdashlet-config"]) === false) {
            return false;
        }

        if ($config["wreportsdashlet-config"]["use_package_cache"] !== "1") {
            return false;
        }

        return true;
    }
}
