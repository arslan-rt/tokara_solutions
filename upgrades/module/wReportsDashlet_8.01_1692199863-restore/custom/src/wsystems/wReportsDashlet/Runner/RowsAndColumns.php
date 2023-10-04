<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner;

use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\LinkFixManager;

class RowsAndColumns extends AbstractRunner
{
    /**
     *
     */
    public function run()
    {
        $this->data = [];

        $this->report->enable_paging = $this->paginated;
        $this->report->run_query();

        while ($row = $this->report->get_next_row("result")) {
            $this->data[] = $row;
        }

        return $this->data;
    }

    /**
     *
     * @return array
     */
    public function apiFormat(): array
    {
        $result = [];

        $reportData           = array();
        $reportData["name"]   = $this->report->name;
        $reportData["id"]     = $this->report->saved_report_id;
        $reportData["module"] = $this->report->module;

        $reportData["totalCount"] = $this->report->total_count;

        $result["reportData"]  = $reportData;
        $result["collection"]  = $this->fixBwcHrefs($reportData["module"], $this->data);
        $result["fields"]      = $this->report->report_def["display_columns"];
        $result["report_type"] = $this->report->report_def["report_type"];

        // Bug in JS. Need to put property.
        $result["headerTitles"] = [];

        return $result;
    }

    /**
     * Fixes the bwc href link of the record with a sidecar link
     *
     * @param mixed $module
     * @param mixed $data
     * @return mixed
     */
    private function fixBwcHrefs($module, $data)
    {
        if (empty($module) === false && empty($data) === false) {
            $linkFixManager = new LinkFixManager(); // Manager used to fix bwc links

            // Iterates through each record found
            for ($recordIndex = 0; $recordIndex < count($data); $recordIndex++) {

                // Iterates through each cell of the record and the cell that contains the bwc link pattern
                for ($cellIndex = 0; $cellIndex < count($data[$recordIndex]["cells"]); $cellIndex++) {
                    $cell                                    = $data[$recordIndex]["cells"][$cellIndex]; // represent the current column
                    $data[$recordIndex]["cells"][$cellIndex] = $linkFixManager->fixBwcLink($cell);
                }
            }
        }

        return $data;
    }
}
