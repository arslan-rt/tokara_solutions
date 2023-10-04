<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner;

use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Utils\Utils as Utils;

class Summation extends AbstractRunner
{
    public $headerTitles;
    public $totalHeaderRow;
    public $summaryTotalRow;
    public $totalRecordsCount;
    public $hasCustomGrandTotal;

    public function run()
    {
        $this->data         = [];
        $this->headerTitles = array();
        $this->headerRow    = array();

        for ($i = 0; $i < count($this->report->report_def["summary_columns"]); $i++) {
            $this->headerRow[$i] = $this->report->report_def["summary_columns"][$i]["label"];
        }

        $this->totalHeaderRow = $this->report->get_total_header_row();
        $this->report->run_summary_combo_query(false);

        $this->hasCustomGrandTotal = false;
        $this->summaryTotalRow     = $this->report->get_summary_total_row();
        $this->totalRecordsCount   = $this->summaryTotalRow["count"];

        if (is_array($this->summaryTotalRow)) {
            $this->hasCustomGrandTotal = true;
            $this->summaryTotalRow     = $this->summaryTotalRow["cells"];
        }

        // get the collection data and store it locally
        while ($reportResultRow = $this->report->get_summary_next_row()) {
            $this->data[] = $reportResultRow["cells"];
        }

        $this->report->run_summary_combo_query(false);

        $row = $this->report->get_summary_next_row();

        $this->headerTitles[0] = array();

        foreach ($row["cells"] as $cellIndex => $cellValue) {
            $this->headerTitles[0][$cellIndex] = Utils::getGroupByColumnName($this->report, $cellIndex, $this->headerRow, $row, false);
        }

        return $this->data;
    }

    public function apiFormat(): array
    {
        $result = [];

        $reportData           = array();
        $reportData["name"]   = $this->report->name;
        $reportData["id"]     = $this->report->saved_report_id;
        $reportData["module"] = $this->report->module;

        $result["reportData"]  = $reportData;
        $result["collection"]  = $this->data;
        $result["fields"]      = $this->report->report_def["display_columns"];
        $result["report_type"] = $this->report->report_def["report_type"];

        // Bug in JS. Need to put property.
        $result["headerTitles"] = $this->headerTitles;
        $result["numberOfRows"] = count($this->data);

        $result["totalRecordsCount"] = $this->totalRecordsCount;

        $result["grandTotal"]                 = array();
        $result["grandTotal"]["columnNames"]  = array();
        $result["grandTotal"]["columnValues"] = array();

        if ($this->hasCustomGrandTotal) {
            for ($totalHeaderIndex = 0; $totalHeaderIndex < count($this->summaryTotalRow); $totalHeaderIndex++) {
                $value = $this->summaryTotalRow[$totalHeaderIndex];

                if (preg_match("/\d/", $value)) {
                    $result["grandTotal"]["columnNames"][]  = $this->headerRow[$totalHeaderIndex];
                    $result["grandTotal"]["columnValues"][] = $value;
                }
            }
        } else {
            $result["grandTotal"]["columnNames"][]  = "Count";
            $result["grandTotal"]["columnValues"][] = count($this->data);
        }

        return $result;
    }
}
