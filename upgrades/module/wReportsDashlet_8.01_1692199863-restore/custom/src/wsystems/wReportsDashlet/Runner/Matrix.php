<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Runner;

class Matrix extends AbstractRunner
{
    public function run()
    {
        $this->data = $this->getMatrixHtml();

        return $this->data;
    }

    protected function getMatrixHtml()
    {
        require_once "modules/Reports/templates/templates_list_view.php";

        $args = array("reporter" => $this->report);

        global $mod_strings, $startLinkWrapper, $endLinkWrapper, $report_smarty;

        $summaryColumnsArray = $this->report->report_def["summary_columns"];
        $addedColumns        = 0;
        $isAvgExists         = false;
        $indexOfAvg          = 0;
        $isSumExists         = false;
        $isCountExists       = false;

        foreach ($summaryColumnsArray as $key => $valueArray) {
            if (isset($valueArray["group_function"])) {
                if ($valueArray["group_function"] == "avg") {
                    $isAvgExists = true;
                    $indexOfAvg  = $key;
                }
                if ($valueArray["group_function"] == "sum") {
                    $isSumExists = true;
                }
                if ($valueArray["group_function"] == "count") {
                    $isCountExists = true;
                }
            }
        }

        if ($isAvgExists) {
            $avgValueArray = $summaryColumnsArray[$indexOfAvg];

            if (!$isSumExists) {
                $sumArray = $avgValueArray;
                //$sumArray["name"] = "sum";
                $sumArray["label"]                             = "sum";
                $sumArray["group_function"]                    = "sum";
                $this->report->report_def["summary_columns"][] = $sumArray;
                $addedColumns                                  = $addedColumns + 1;
                $summaryColumnsArray[]                         = array("label" => "sum");
            }

            if (!$isCountExists) {
                $countArray                                    = $avgValueArray;
                $countArray["name"]                            = "count";
                $countArray["label"]                           = "count";
                $countArray["group_function"]                  = "count";
                $this->report->report_def["summary_columns"][] = $countArray;
                $addedColumns                                  = $addedColumns + 1;
                $summaryColumnsArray[]                         = array("label" => "count");
            }
        }

        $this->report->run_summary_query();
        $startLinkWrapper = "javascript:set_sort('";
        $endLinkWrapper   = "','summary');";
        $report_smarty->assign('reporter', $this->report);
        $report_smarty->assign('args', $args);

        $headerRow     = $this->report->get_summary_header_row();
        $groupDefArray = $this->report->report_def["group_defs"];

        replaceHeaderRowdataWithSummaryColumns($headerRow, $summaryColumnsArray, $this->report);
        $groupByIndexInHeaderRow = array();

        for ($i = 0; $i < count($groupDefArray); $i++) {
            $groupByColumnInfo                                          = getGroupByInfo($groupDefArray[$i], $summaryColumnsArray);
            $groupByIndexInHeaderRow[getGroupByKey($groupDefArray[$i])] = $groupByColumnInfo;
        }

        $this->report->group_defs_Info = $groupByIndexInHeaderRow;
        $this->report->addedColumns    = $addedColumns;

        $report_smarty->assign("header_row", $headerRow);
        $report_smarty->assign("list_type", "summary");

        template_header_row($headerRow, $args);

        $groupDefArray = $this->report->report_def["group_defs"];
        $matrixHtml    = "";

        if (isset($this->report->report_def["layout_options"]) === false) {
            $matrixHtml = $report_smarty->fetch("modules/Reports/templates/_template_summary_list_view.tpl");
        } else {
            if ((count($groupDefArray) == 1) || (count($groupDefArray) > 3)) {
                $matrixHtml = $report_smarty->fetch("modules/Reports/templates/_template_summary_list_view.tpl");
            } elseif (count($groupDefArray) == 2) {
                $matrixHtml = $report_smarty->fetch("modules/Reports/templates/_template_summary_list_view_2gpby.tpl");
            } else {
                if ($this->report->report_def["layout_options"] == "1x2") {
                    $matrixHtml = $report_smarty->fetch("modules/Reports/templates/_template_summary_list_view_3gpbyL2.tpl");
                } else {
                    $matrixHtml = $report_smarty->fetch("modules/Reports/templates/_template_summary_list_view_3gpbyL1.tpl");
                }
            }
        }

        return $matrixHtml;
    }

    /**
     *
     * @return array
     */
    public function apiFormat(): array
    {
        $result = [];

        $result["matrixHtml"] = $this->data;

        return $result;
    }
}
