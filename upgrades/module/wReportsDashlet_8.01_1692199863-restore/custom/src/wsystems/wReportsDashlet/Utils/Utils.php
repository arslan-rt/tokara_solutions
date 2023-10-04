<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Utils;

use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Traits;

class Utils
{
    use Traits\ModuleConfigTrait;

    /**
     *
     * @param mixed $reporter
     * @param mixed $index
     * @param mixed $headerRow
     * @param mixed $row
     * @param bool $isSummationWithDetails
     *
     * @return mixed
     */
    public static function getGroupByColumnName(&$reporter, $index, $headerRow, $row, $isSummationWithDetails = true)
    {
        $groupDefArray      = $reporter->report_def["group_defs"];
        $key                = $index;
        $groupByColumnLabel = $headerRow[$index];

        $headerValue  = $row["cells"][$key];
        $columnValues = "";

        if ($index == (count($groupDefArray) - 1) && $isSummationWithDetails) {
            $columnValues = self::getColumnsInfoFromHeaderExceptGroupBy($reporter, $headerRow, $row);
        }

        if (empty($headerValue)) {
            $headerValue = "None";
        }

        if ($isSummationWithDetails) {
            $returnData = $groupByColumnLabel . " = " . $headerValue;
        } else {
            $returnData = $groupByColumnLabel;
        }

        if (empty($columnValues) === false) {
            if (strpos($columnValues, $returnData) !== false) {
                $returnData = $columnValues;
            } else {
                $returnData = $returnData . ", " . $columnValues;
            }
        }

        return $returnData;
    }

    /**
     *
     * @param mixed $reporter
     * @param mixed $headerRow
     * @param mixed $row
     *
     * @return string
     */
    public static function getColumnsInfoFromHeaderExceptGroupBy(&$reporter, $headerRow, $row)
    {
        $groupByIndexInHeaderRow = array();
        $groupDefArray           = $reporter->report_def["group_defs"];
        $columnValues            = "";

        for ($i = 0; $i < count($groupDefArray); $i++) {
            $key                       = $reporter->group_defs_Info[self::getGroupByKey($groupDefArray[$i])]["index"];
            $groupByIndexInHeaderRow[] = $key;
        }

        $count = 0;

        for ($i = 0; $i < count($headerRow); $i++) {
            if (in_array($i, $groupByIndexInHeaderRow) === false) {
                if ($count != 0) {
                    $columnValues = $columnValues . ", ";
                }

                $columnValues = $columnValues . $headerRow[$i] . " = " . $row["cells"][$i];
                $count++;
            }
        }

        return $columnValues;
    }

    /**
     *
     * @param mixed $groupByArray
     *
     * @return string
     */
    public static function getGroupByKey($groupByArray)
    {
        // name+table_key may not be unique for some groupby columns, eg, "Quarter: Modified Date"
        // and "Month: Modified Date" both have the same "name" and "table_key"
        return $groupByArray["name"] . "#" . $groupByArray["table_key"] . "#" . $groupByArray["label"];
    }

    public static function addSortOrder(&$report_info, $sort)
    {
        $fieldToSortOn = $sort["name"];
        $sortTableKey  = $sort["table_key"];
        $sortDirection = $sort["sort_dir"]; //"a" / "d"

        $sortDefinition = array(
            "name"      => $fieldToSortOn,
            "table_key" => $sortTableKey,
            "sort_dir"  => $sortDirection,
        );

        $report_info["order_by"] = array(
            $sortDefinition,
        );
    }

    /**
     *
     * @param mixed $report_info
     * @param mixed $link
     *
     * @return void
     */
    public static function addLinkFilter(&$report_info, $link)
    {
        $tableListAddIn                 = self::getTableListAddin($link);
        $report_info["full_table_list"] = array_merge($report_info["full_table_list"], $tableListAddIn);

        $filtersDefAddIn            = self::getFiltersDefAddin($report_info, $link);
        $report_info["filters_def"] = array_merge($report_info["filters_def"], $filtersDefAddIn);
    }

    /**
     *
     * @param array $link
     *
     * @return array
     */
    public static function getTableListAddin(array $link): array
    {
        global $dictionary;

        require_once "data/Link2.php";

        $module    = $link["module"];
        $linkField = $link["linkField"];

        if ($module === "Home") {
            return array();
        }

        $beanName = \BeanFactory::getObjectName($module);
        $bean     = \BeanFactory::getBean($module);

        if ($bean->field_defs[$linkField]) {
            $targetLinkedField = $bean->field_defs[$linkField];
            $targetModule      = $targetLinkedField["module"];

            if (!$targetModule && $targetLinkedField["type"] === "link" && $targetLinkedField["name"]) {
                $targetModule = ucfirst($targetLinkedField["name"]);
            }
        }

        $targetBeanName = \BeanFactory::getObjectName($targetModule);
        $relName        = $dictionary[$beanName]["fields"][$linkField]["relationship"];

        \VardefManager::loadVarDef($targetModule, $targetBeanName);

        //lets reverse lookup the target link field
        $targetLinkField = null;
        if ($dictionary[$targetBeanName]["fields"]) {
            foreach ($dictionary[$targetBeanName]["fields"] as $fieldName => $field) {
                if (isset($field["type"]) && $field["type"] == "link"
                    && isset($field["relationship"]) && $field["relationship"] == $relName) {
                    $targetLinkField = $field;
                }
            }
        }

        if (is_null($targetLinkField) === true) {
            return array();
        } //no filtering

        $targetLinkFieldName = $targetLinkField["name"];

        $tmpBean = \BeanFactory::getBean($targetModule);

        $tmpBean->load_relationship($targetLinkFieldName);

        $ret                                            = [];
        $tmpLink                                        = $tmpBean->$targetLinkFieldName;
        $keyName                                        = $targetModule . ":" . $targetLinkFieldName;
        $ret[$keyName]                                  = array();
        $ret[$keyName]["name"]                          = $targetModule . " > " . $beanName;
        $ret[$keyName]["parent"]                        = "self";
        $ret[$keyName]["link_def"]                      = array();
        $ret[$keyName]["link_def"]["name"]              = $targetLinkFieldName;
        $ret[$keyName]["link_def"]["relationship_name"] = $relName;
        $ret[$keyName]["link_def"]["bean_is_lhs"]       = (bool) ($tmpLink->_get_bean_position());
        $ret[$keyName]["link_def"]["link_type"]         = $tmpLink->getType();
        $ret[$keyName]["link_def"]["label"]             = $beanName;
        $ret[$keyName]["link_def"]["module"]            = $module;
        $ret[$keyName]["link_def"]["table_key"]         = $keyName;
        $ret[$keyName]["dependents"]                    = array("Filter.1_table_filter_row_1");
        $ret[$keyName]["module"]                        = $module;
        $ret[$keyName]["label"]                         = $beanName;

        return $ret;
    }

    /**
     *
     * @param mixed $report_info
     * @param mixed $link
     *
     * @return array
     */
    public static function getFiltersDefAddin(&$report_info, $link): array
    {
        $ret = array();
        global $dictionary;

        $beanName = \BeanFactory::getObjectName($link["module"]);
        $bean     = \BeanFactory::getBean($link["module"]);

        if ($bean->field_defs[$link["linkField"]]) {
            $targetLinkedField = $bean->field_defs[$link["linkField"]];
            $targetModule      = $targetLinkedField["module"];

            if (!$targetModule && $targetLinkedField["type"] === "link" && $targetLinkedField["name"]) {
                $targetModule = ucfirst($targetLinkedField["name"]);
            }
        }

        $targetBeanName = \BeanFactory::getObjectName($targetModule);

        \VardefManager::loadVarDef($targetModule, $targetBeanName);

        $relName = $dictionary[$beanName]["fields"][$link["linkField"]]["relationship"];
        //lets reverse lookup the target link field
        $targetLinkField = null;

        if ($dictionary[$targetBeanName]["fields"]) {
            foreach ($dictionary[$targetBeanName]["fields"] as $fieldName => $field) {
                if (
                    isset($field["type"])
                    && $field["type"] === "link"
                    && isset($field["relationship"])
                    && $field["relationship"] === $relName
                ) {
                    $targetLinkField = $field;
                }
            }
        }
        $preset_filters = $report_info["filters_def"]["Filter_1"];

        if (is_null($targetLinkField) === true) {
            return array();
        } //no filtering

        $targetLinkFieldName = $targetLinkField["name"];

        unset($preset_filters["operator"]);
        unset($report_info["filters_def"]["Filter_1"]);

        //custom filter key!
        $ret["Filter_1"]                      = array();
        $ret["Filter_1"]["operator"]          = "AND";
        $ret["Filter_1"][0]                   = array();
        $ret["Filter_1"][0]["name"]           = "id";
        $ret["Filter_1"][0]["table_key"]      = $targetModule . ":" . $targetLinkFieldName;
        $ret["Filter_1"][0]["qualifier_name"] = "is";
        $ret["Filter_1"][0]["input_name0"]    = $link["contextId"];
        $ret["Filter_1"][0]["input_name1"]    = $link["contextName"];

        foreach ($preset_filters as $preset_filter) {
            $ret["Filter_1"][] = $preset_filter;
        }

        return $ret;
    }

    /**
     *
     * @param mixed $rows
     * @param mixed $row
     * @param mixed $groupBys
     *
     * @return mixed
     */
    public static function getGroup($rows, $row, $groupBys)
    {
        $groupBys  = $groupBys;
        $scheleton = array();
        $keys      = array();

        foreach ($groupBys as $keyValue) {
            $keys[] = $row[$keyValue];
            unset($row[$keyValue]);
        }

        $scheleton = self::addDepthToArray($scheleton, $keys, $row);
        $rows      = self::arrayMergeRecursiveCustom($rows, $scheleton);

        return $rows;
    }

    /**
     *
     * @param mixed $scheleton
     * @param mixed $keys
     * @param mixed $endValue
     *
     * @return mixed
     */
    public static function addDepthToArray($scheleton, $keys, $endValue)
    {
        if (count($keys) > 1) {
            $newKey = $keys[0];

            array_shift($keys);

            $scheleton[$newKey] = array();
            $scheleton[$newKey] = self::addDepthToArray($scheleton[$newKey], $keys, $endValue);
        } else {
            $scheleton[(string) $keys[0] . "uniqueId"][]          = $endValue;
            $scheleton[(string) $keys[0] . "uniqueId"]["wIsData"] = true;
        }

        return $scheleton;
    }

    /**
     *
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    public static function arrayMergeRecursiveCustom(array $array1, array $array2)
    {
        $merged = $array1;

        foreach ($array2 as $key => $value) {
            $containsArray = false;

            if (is_array($value)) {
                foreach ($value as $paramKey => $paramValue) {
                    if (is_array($paramValue)) {
                        $containsArray = true;
                    }
                }
            }

            if (
                is_array($value)
                && isset($merged[$key])
                && is_array($merged[$key])
                && ($containsArray === true)
            ) {
                $merged[$key] = self::arrayMergeRecursiveCustom($merged[$key], $value);
            } else {
                if (is_int($key)) {
                    $key = count($merged) - 1;
                }

                $merged[$key] = $value;
            }
        }

        return $merged;
    }

    /**
     *
     * @param mixed $rowList
     * @param mixed $headerTitles
     * @param mixed $headerIndex
     * @param mixed $subHeaderIndex
     * @param bool $isFirstHeader
     *
     * @return void
     */
    public static function addHeadersInfo(&$rowList, $headerTitles, $headerIndex, $subHeaderIndex, $isFirstHeader = false)
    {
        if (is_array($rowList) === false) {
            return;
        }

        foreach ($rowList as $collectionKey => $collectionData) {
            if (
                $headerTitles[$headerIndex][$subHeaderIndex]
                && $isFirstHeader === false
                && !$rowList["header"]
            ) {
                $rowList["header"] = $headerTitles[$headerIndex][$subHeaderIndex];
            }

            if (($collectionKey !== "header") && $rowList[$collectionKey]) {
                if ($rowList[$collectionKey]["wIsData"]) {
                    $newSubHeaderIndex = $subHeaderIndex + 1;

                    if ($isFirstHeader) {
                        $newSubHeaderIndex = 0;
                    }

                    $rowList[$collectionKey]["header"] = $headerTitles[$headerIndex][$newSubHeaderIndex];
                    $headerIndex                       = $headerIndex + 1;
                } else {
                    $newSubHeaderIndex = $subHeaderIndex + 1;

                    if ($isFirstHeader) {
                        $newSubHeaderIndex = 0;
                    }

                    self::addHeadersInfo($rowList[$collectionKey], $headerTitles, $headerIndex, $newSubHeaderIndex, false);
                }
            }
        }
    }

    /**
     *
     * @return void
     */
    public static function clearReportsCache(): void
    {
        $db   = \DBManagerFactory::getInstance();
        $conn = $db->getConnection();

        $sql = <<<SQL
DELETE FROM
    wreportsdashlet_cache;
SQL;

        $conn->executeQuery($sql);
    }

    /**
     *
     * @return void
     */
    public static function removeOutdatedReportsCache(): void
    {
        global $sugar_config;

        $db   = \DBManagerFactory::getInstance();
        $conn = $db->getConnection();

        $sql = <<<SQL
DELETE FROM
    wreportsdashlet_cache
WHERE
    DATE(cache_expire) != DATE(CURDATE())
SQL;

        if (
            (array_key_exists("db_manager", $sugar_config["dbconfig"]) && $sugar_config["dbconfig"]["db_manager"] == "SqlsrvManager")
            || (array_key_exists("db_type", $sugar_config["dbconfig"]) && $sugar_config["dbconfig"]["db_type"] == "mssql")
        ) {
            $sql = <<<SQL
DELETE FROM
    wreportsdashlet_cache
WHERE
    CAST(cache_expire AS DATE) != CAST(GETDATE() AS DATE)
SQL;
        }

        $conn->executeQuery($sql);
    }
}
