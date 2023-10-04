<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner;

use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\LinkFixManager;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Utils\Utils as Utils;

class SummationWithDetails extends AbstractRunner
{
    public $headerTitles;
    public $totalHeaderRow;
    public $summaryTotalRow;
    public $totalRecordsCount;
    public $hasCustomGrandTotal;
    public $groupByColumnsCount;

    public function run()
    {
        $this->data = [];

        $this->headerTitles = array();
        $this->headerRow    = array();

        $this->groupByColumnsCount = count($this->report->report_def["group_defs"]);

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

        $this->report->run_summary_combo_query();

        $summaryRow = $this->report->db->fetchByAssoc($this->report->summary_result);

        $groupBys = array();

        // get params to group by
        foreach ($summaryRow as $key => $value) {
            if (count($groupBys) == $this->groupByColumnsCount) {
                break;
            }

            $groupBys[] = $key;
        }

        $rowsParsed     = 0;
        $cachedGroupBys = array();

        // cache their values
        while ($row = $this->report->db->fetchByAssoc($this->report->result)) {
            $cachedGroupBys[] = array();

            foreach ($groupBys as $groupByKey => $groupByValue) {
                $cachedGroupBys[$rowsParsed][$groupByValue] = $row[$groupByValue];
            }

            $rowsParsed = $rowsParsed + 1;
        }

        $this->report->run_summary_combo_query();

        $rowsParsed = 0;

        // get the actual collection
        while ($reportResultRow = $this->report->get_next_row()) {
            $rowValues = array();

            // compose an array with the values
            foreach ($reportResultRow["cells"] as $cellValue) {
                $rowValues[] = $cellValue;
            }

            foreach ($groupBys as $groupByKey => $groupByValue) {
                $rowValues[$groupByValue] = $cachedGroupBys[$rowsParsed][$groupByValue];
            }

            $rowsParsed = $rowsParsed + 1;

            // insert the new values in the complete collection list
            $this->data = Utils::getGroup($this->data, $rowValues, $groupBys);

            foreach ($groupBys as $groupByKey => $groupByValue) {
                unset($rowValues[$groupByValue]);
            }

            $group[] = (object) $rowValues;
        }

        $rowsNumber = 0;
        // get the headers info
        $this->report->run_summary_combo_query(false);
        while ($row = $this->report->get_summary_next_row()) {
            $this->headerTitles[$rowsNumber] = array();

            // setting the titles
            foreach ($row["cells"] as $cellIndex => $cellValue) {
                $this->headerTitles[$rowsNumber][$cellIndex] = Utils::getGroupByColumnName($this->report, $cellIndex, $this->headerRow, $row, true);
            }

            // add the count information to the title
            if ((string) $row["cells"][0] === (string) $row["count"]) {
                $this->headerTitles[$rowsNumber][1] = $this->headerTitles[$rowsNumber][1] . ", " . $this->headerTitles[$rowsNumber][0];
                $this->headerTitles[$rowsNumber][0] = $this->headerTitles[$rowsNumber][count($this->headerTitles[$rowsNumber]) - 1];
            } else {
                $entries   = count($this->headerTitles[$rowsNumber]) - 1;
                $countText = "Count = " . $row["count"];

                $this->headerTitles[$rowsNumber][$entries] = $this->headerTitles[$rowsNumber][$entries] . ", " . $countText;
            }

            $rowsNumber = $rowsNumber + 1;
        }

        // add the titles directly to the collection
        Utils::addHeadersInfo($this->data, $this->headerTitles, 0, 0, true);

        return $this->data;
    }

    public function apiFormat(): array
    {
        $result = [];

        $reportData           = array();
        $reportData["name"]   = $this->report->name;
        $reportData["id"]     = $this->report->saved_report_id;
        $reportData["module"] = $this->report->module;

        $result["reportData"]             = $reportData;
        $result["collection"]             = $this->fixBwcHrefs($this->data);
        $result["fields"]                 = $this->report->report_def["display_columns"];
        $result["report_type"]            = $this->report->report_def["report_type"];
        $result["isSummationWithDetails"] = true;

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

    /**
     * Fixes the bwc href link of the record with a sidecar link
     *
     * @param array $data
     *
     * @return array
     */
    private function fixBwcHrefs(array $data): array
    {
        foreach ($data as $key => $rowData) {
            if (is_array($rowData) === true) {
                $data[$key] = $this->fixBwcHrefs($rowData);
            } elseif (is_string($rowData) === true) {
                $linkFixManager = new LinkFixManager();
                $data[$key]     = $linkFixManager->fixBwcLink($rowData);
            }
        }

        return $data;
    }
}
