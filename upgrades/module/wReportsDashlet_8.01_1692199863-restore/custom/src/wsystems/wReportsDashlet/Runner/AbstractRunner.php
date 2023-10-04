<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner;

use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Utils\Utils as Utils;

abstract class AbstractRunner
{
    public $report;
    public $data;
    public $linked;
    public $paginated;
    public $sort;
    public $link;

    public function __construct($report, $linked = false, $paginated = false, $sort = array(), $link = array())
    {
        $this->linked    = $linked;
        $this->paginated = $paginated;
        $this->sort      = $sort;
        $this->link      = $link;

        $this->report = $this->process($report);
    }

    protected function process($report)
    {
        $info = json_decode($report->content, true);
        $info = json_encode($this->massageReportDef($info));

        $customReportClassLoaded = \SugarAutoLoader::load("custom/modules/Reports/CustomReport.php");
        if ($customReportClassLoaded) {
            $reporter = new \CustomReport($info);
        } else {
            $reporter = new \Report($info);
        }

        $reporter->is_saved_report = true;
        $reporter->saved_report_id = $report->id;

        $reporter->enable_paging = $this->paginated;

        return $reporter;
    }

    protected function massageReportDef($report_info)
    {
        if ($this->linked) {
            Utils::addLinkFilter($report_info, $this->link);
        }

        if (!empty($this->sort)) {
            Utils::addSortOrder($report_info, $this->sort);
        }

        return $report_info;
    }

    abstract public function run();

    abstract public function apiFormat();
}
