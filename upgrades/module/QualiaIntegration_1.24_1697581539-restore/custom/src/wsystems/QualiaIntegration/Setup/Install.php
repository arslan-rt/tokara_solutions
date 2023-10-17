<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Setup;

use Administration;
use BeanFactory;
use Exception;
use RepairAndClear;
use SugarAutoLoader;

class Install
{
    public function postInstall()
    {
        try {

            SugarAutoLoader::autoload('ContactsParentLinkedOrders');
            SugarAutoLoader::autoload('PropertiesParentLinkedOrders');
            SugarAutoLoader::autoload('LoansParentLinkedOrders');
            SugarAutoLoader::autoload('OrdersParentLinkedContacts');
            SugarAutoLoader::buildCache();

            global $moduleList;
            $repair = new RepairAndClear();
            $_REQUEST['execute'] = true;
            $repair->repairAndClearAll(['clearAdditionalCaches'], $moduleList, true, false, '');

            $db = \DBManagerFactory::getInstance();

            $this->createTablesForQualiaFailedRecords($db);
            //$this->createDashboards($db);
            //$this->handleReports($db);
            $this->handleJobs();
            //$this->handleModulesDisplay();
        } catch (Exception $e) {
            $logger = \LoggerManager::getLogger();
            $logger->fatal("Failed to create qualia_failed_records error: " . $e->getMessage());
        }
    }

    private function createTablesForQualiaFailedRecords($db)
    {
        $failedRecordsTable = "qualia_failed_records";
        $brokenRecordsTable = "qualia_broken_records";

        $fields = [
            "id"            => "VARCHAR(64) NOT NULL",
            "order_data"    => "LONGTEXT NULL",
            "error_message" => "LONGTEXT NULL",
            "date_created"  => "DATETIME NULL",
            "date_modified" => "DATETIME NULL",
        ];

        if ($db->tableExists(($failedRecordsTable)) === false) {
            $this->createTable($failedRecordsTable, $fields, $db);
        }

        if ($db->tableExists(($brokenRecordsTable)) === false) {
            $this->createTable($brokenRecordsTable, $fields, $db);
        }
    }

    private function createTable(String $name, array $fieldsMeta, \DBManager $db)
    {
        $fields = "";

        foreach ($fieldsMeta as $fieldName => $fieldDef) {
            $fields .= $fieldName . " " . $fieldDef . "," . PHP_EOL;
        }

        $query = <<<EOQ
            CREATE TABLE
                {$name}
            (
            {$fields}
            PRIMARY KEY (id)
            )
EOQ;

        $conn = $db->getConnection();

        $conn->executeQuery($query);
    }

    private function createDashboards(\DBManager $db)
    {
        $managerDashboardOpened = [
            'id'               => '9aa63720-50f2-11eb-bd7c-0242ac140008',
            'name'             => 'Manager Dashboards – Open Orders',
            'dashboard_module' => 'Home',
            'metadata'         => '{"dashlets":[{"width":"6","view":{"label":"Open Orders by Closing Date","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"saved_report_id":"84769af0-50e6-11eb-9704-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"auto_refresh":"60","sort":"estimated_closing::self::a","display_rows":"20","show_drilldown_button":true,"componentType":"view"},"x":"0","y":"0","height":"6","id":"48804403-6e96-4077-bcc4-a9e33cc270cf"},{"width":"6","view":{"label":"Open Orders by Purchase Price","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"saved_report_id":"a97b1b1e-5fb4-11eb-8c2e-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"auto_refresh":"60","show_drilldown_button":true,"componentType":"view","display_rows":"20","sort":"purchase_price::self::d"},"x":"6","y":"0","height":"6","id":"733a0374-145f-404f-8395-2f65ec90db2f"},{"width":"4","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Open Orders by Sales Rep (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"bar chart","saved_report_id":"7260da36-50d9-11eb-8835-0242ac140008","saved_report":"Open Orders by Sales Rep (with chart)","reportModule":null,"intelligent":false,"link":null,"showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"auto_refresh":"60","skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"0","y":"6","height":"6","id":"b8439436-5861-4924-adce-ace56b8d3098"},{"width":"4","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Open Orders by Transaction Type (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"pie chart","saved_report_id":"81d9cf56-50d2-11eb-b1bf-0242ac140008","saved_report":"Open Orders by Transaction Type (with chart)","reportModule":null,"intelligent":false,"link":null,"showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Transaction Type","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"approximate_total":false,"skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"4","y":"6","height":"6","id":"1ea3aaa2-5fe3-44bc-8b37-27ea3591da66"},{"width":"4","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Open Orders by Sales Rep and Transaction Type","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"horizontal group by chart","saved_report_id":"b0f0a18a-50e0-11eb-945d-0242ac140008","saved_report":"Open Orders by Sales Rep and Transaction Type","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":true,"skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"8","y":"6","height":"6","id":"3ba30d1f-809e-4679-a546-158c564dd0d2"}]}',
        ];

        $managerDashboardClosed = [
            'id'               => '3b96e148-50f3-11eb-8f7a-0242ac140008',
            'name'             => 'Manager Dashboards – Closed Orders',
            'dashboard_module' => 'Home',
            'metadata'         => '{"dashlets":[{"width":"6","view":{"label":"Closed Orders by Closing Date","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"auto_refresh":"60","saved_report_id":"43163f60-50ec-11eb-a071-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"sort":"estimated_closing::self::a","display_rows":"20","show_drilldown_button":true,"componentType":"view"},"x":"0","y":"0","height":"6","id":"d1884ac1-ab46-480d-9a58-73242affab1d"},{"width":"6","view":{"label":"Closed Orders by Purchase Price","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"saved_report_id":"60a2e7d6-5fb5-11eb-8e51-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"show_drilldown_button":true,"auto_refresh":"60","display_rows":"20","componentType":"view","sort":"purchase_price::self::d"},"x":"6","y":"0","height":"6","id":"ee0928f5-2cdd-420b-a18c-0bc2158e3a1a"},{"width":"4","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Closed Orders by Sales Rep (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"bar chart","saved_report_id":"75eb5264-50eb-11eb-a3b2-0242ac140008","saved_report":"Closed Orders by Sales Rep (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"auto_refresh":"60","skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"0","y":"6","height":"6","id":"cd030b09-da4d-4490-ae46-d8ada3a343da"},{"width":"4","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Closed Orders by Transaction Type (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"pie chart","saved_report_id":"e63a257c-50eb-11eb-8b51-0242ac140008","saved_report":"Closed Orders by Transaction Type (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Transaction Type","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"auto_refresh":"60","skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"4","y":"6","height":"6","id":"2bb73eab-1ad5-429f-8bb8-b6e0a241ba60"},{"width":"4","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Closed Orders by Sales Rep and Transaction Type","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"horizontal group by chart","saved_report_id":"26697b48-50ec-11eb-a932-0242ac140008","saved_report":"Closed Orders by Sales Rep and Transaction Type","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":true,"skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"8","y":"6","height":"6","id":"c7f6c13c-3680-4c4b-8289-0938660936ae"},{"width":"6","context":{"module":"Order_RQ_Order","link":null,"skipFetch":true},"view":{"label":"Closed Orders by Lender (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"bar chart","saved_report_id":"b17018fe-50ed-11eb-a4f4-0242ac140008","saved_report":"Closed Orders by Lender (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Name","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"skipFetch":true,"componentType":"view","show_drilldown_button":true},"x":"0","y":"12","height":"6","id":"daa14e05-8c64-4a89-bb6a-203ae98a94a2"}]}',
        ];

        $userDashboardOpened = [
            'id'               => '2b78146a-5fc8-11eb-aabd-0242ac140008',
            'name'             => 'User Dashboards – Open Orders',
            'dashboard_module' => 'Home',
            'metadata'         => '{"dashlets":[{"width":"6","view":{"label":"My Open Orders by Closing Date","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"auto_refresh":"60","show_drilldown_button":true,"saved_report_id":"c955d774-5fbb-11eb-b966-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"sort":"estimated_closing::self::a","display_rows":"20"},"x":"0","y":"0","height":"6","id":"46a4d147-845d-408d-8a0f-8fd039d226b8"},{"width":"6","view":{"label":"My Open Orders by Purchase Price","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"saved_report_id":"11de8cd4-5fbc-11eb-9837-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"auto_refresh":"60","sort":"purchase_price::self::d","display_rows":"20","show_drilldown_button":true},"x":"6","y":"0","height":"6","id":"3dd40cc9-0046-4fe9-bb97-94c572ab8981"},{"width":"4","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Open Orders by Sales Rep (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"bar chart","saved_report_id":"4bf16f5e-5fbc-11eb-945e-0242ac140008","saved_report":"My Open Orders by Sales Rep (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"show_drilldown_button":true,"auto_refresh":"60"},"x":"0","y":"6","height":"6","id":"c30c4919-a0cd-4932-85a8-8890c5b399e0"},{"width":"4","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Open Orders by Transaction Type (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"pie chart","saved_report_id":"7c0c604a-5fbc-11eb-9e92-0242ac140008","saved_report":"My Open Orders by Transaction Type (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Transaction Type","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"show_drilldown_button":true},"x":"4","y":"6","height":"6","id":"3a67d37e-3202-451f-a55a-5b86214c83da"},{"width":"4","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Open Orders by Sales Rep and Transaction Type","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"horizontal group by chart","saved_report_id":"ab85a32c-5fbc-11eb-899d-0242ac140008","saved_report":"My Open Orders by Sales Rep and Transaction Type","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":true,"show_drilldown_button":true},"x":"8","y":"6","height":"6","id":"c79dc013-4336-4b17-81ad-cb8923a312c7"}]}',
        ];

        $userDashboardClosed = [
            'id'               => 'c2a15a6c-5fc9-11eb-908a-0242ac140008',
            'name'             => 'User Dashboards – Closed Orders',
            'dashboard_module' => 'Home',
            'metadata'         => '{"dashlets":[{"width":"6","view":{"label":"My Closed Orders by Closing Date","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"saved_report_id":"c46c5aa4-5fbf-11eb-91b2-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"auto_refresh":"60","sort":"estimated_closing::self::a","display_rows":"20","show_drilldown_button":true},"x":"0","y":"0","height":"6","id":"17157857-8f9d-425a-850f-94a1ee1fc54c"},{"width":"6","view":{"label":"My Closed Orders by Purchase Price","type":"saved-reports-list","module":null,"show_summary":true,"show_total_count":true,"saved_report_id":"05bac0e4-5fc1-11eb-8b45-0242ac140008","display_columns":["self::name","self::order_status","self::transaction_type","self::purchase_price","self::estimated_closing"],"auto_refresh":"60","sort":"purchase_price::self::d","display_rows":"20","show_drilldown_button":true},"x":"6","y":"0","height":"6","id":"65c68885-be76-4fe6-8b65-c16e8a43c258"},{"width":"4","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Closed Orders by Sales Rep (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"bar chart","saved_report_id":"1b932150-5fc5-11eb-8607-0242ac140008","saved_report":"My Closed Orders by Sales Rep (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"auto_refresh":"60","show_drilldown_button":true},"x":"0","y":"6","height":"6","id":"81011e89-14ae-4953-b1a3-1461d1ff8d8e"},{"width":"4","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Closed Orders by Transaction Type (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"pie chart","saved_report_id":"67e6c750-5fc5-11eb-9282-0242ac140008","saved_report":"My Closed Orders by Transaction Type (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"auto_refresh":"60","allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Transaction Type","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"show_drilldown_button":true},"x":"4","y":"6","height":"6","id":"48e6b1dc-b162-466c-aed6-07383db50a54"},{"width":"4","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Closed Orders by Sales Rep and Transaction Type","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"horizontal group by chart","saved_report_id":"9642dba2-5fc5-11eb-8897-0242ac140008","saved_report":"My Closed Orders by Sales Rep and Transaction Type","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Sales Rep","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":true,"auto_refresh":"60","show_drilldown_button":true},"x":"8","y":"6","height":"6","id":"53f16897-c90c-4e81-89b0-2c01512d2e47"},{"width":"6","context":{"module":"Order_RQ_Order","link":"","skipFetch":true},"view":{"label":"My Closed Orders by Lender (with chart)","type":"w-saved-reports-chart","module":"Order_RQ_Order","chart_type":"bar chart","saved_report_id":"db7cbf26-5fc5-11eb-ad9f-0242ac140008","saved_report":"My Closed Orders by Lender (with chart)","reportModule":null,"intelligent":false,"link":"","showBarTotal":false,"allowScroll":true,"colorData":"class","hideEmptyGroups":true,"reduceXTicks":true,"rotateTicks":true,"show_controls":false,"show_title":true,"show_x_label":false,"show_y_label":false,"staggerTicks":true,"wrapTicks":true,"x_axis_label":"Name","y_axis_label":"Count","group1Sort":"default","group2Sort":"default","show_legend":true,"stacked":false,"auto_refresh":"60","show_drilldown_button":true},"x":"0","y":"12","height":"6","id":"d23b277a-c406-4dbf-a498-aeee5400b670"}]}',
        ];

        $this->sqlInsertDashboardIfNotExist($db, $managerDashboardOpened);
        $this->sqlInsertDashboardIfNotExist($db, $managerDashboardClosed);
        $this->sqlInsertDashboardIfNotExist($db, $userDashboardOpened);
        $this->sqlInsertDashboardIfNotExist($db, $userDashboardClosed);
    }

    public function sqlInsertDashboardIfNotExist($db, $dashMeta)
    {
        $dashId   = $dashMeta["id"];
        $name     = $dashMeta["name"];
        $module   = $dashMeta["dashboard_module"];
        $metadata = $dashMeta["metadata"];

        $conn      = $db->getConnection();
        $sqlInsert = <<<EOQ
        INSERT INTO
          dashboards
          (
						id,
						name,
						date_entered,
						date_modified,
						modified_user_id,
						created_by,
						description,
						deleted,
						dashboard_module,
						view_name,
						metadata,
						default_dashboard,
						team_id,
						team_set_id,
						assigned_user_id
          )
        VALUES (
          '{$dashId}',
          '{$name}',
          NOW(),
          NOW(),
          1,
          1,
          null,
          0,
          '{$module}',
          null,
          '{$metadata}',
          1,
          1,
          1,
          1
        )
        ON DUPLICATE KEY UPDATE
          name              = '{$name}',
          date_modified     = NOW(),
					metadata          = '{$metadata}'
EOQ;

        $exec = $conn->executeQuery($sqlInsert);
    }

    private function handleReports(\DBManager $db)
    {
        $openOrdersByClosingDate = [
            "id"          => "84769af0-50e6-11eb-9704-0242ac140008",
            "name"        => "Open Orders by Closing Date",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"estimated_closing","label":"LBL_ESTIMATED_CLOSING","vname":"Closing Date","type":"date","module":"Order_RQ_Order","mass_update":true,"required":true,"reportable":true,"importable":true,"table_key":"self","sort_dir":"a"}],"report_name":"Open Orders by Closing Date","chart_type":"none","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order","dependents":[]}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]}}}}',
            "isPublished" => "0",
        ];

        $openOrdersByPurchasePrice = [
            "id"          => "a97b1b1e-5fb4-11eb-8c2e-0242ac140008",
            "name"        => "Open Orders by Purchase Price",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"purchase_price","vname":"Purchase Price","type":"currency","importable":"true","duplicate_merge":"enabled","duplicate_merge_dom_value":"1","reportable":true,"merge_filter":"disabled","len":26,"size":"20","precision":6,"table_key":"self","sort_dir":"d"}],"report_name":"Open Orders by Purchase Price","chart_type":"none","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]}}}}',
            "isPublished" => "0",
        ];

        $openOrdersBySalesRep = [
            "id"          => "7260da36-50d9-11eb-8835-0242ac140008",
            "name"        => "Open Orders by Sales Rep (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "vGBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"},{"name":"sales_rep","label":"Sales Rep","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"Open Orders by Sales Rep (with chart)","chart_type":"vGBarF","do_round":1,"chart_description":"Open Orders by Sales Rep (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order","dependents":[]}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]}}}}',
            "isPublished" => "0",
        ];

        $openOrdersByTransactionType = [
            "id"          => "81d9cf56-50d2-11eb-b1bf-0242ac140008",
            "name"        => "Open Orders by Transaction Type (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "pieF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar","force_label":"Transaction Type"}],"summary_columns":[{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"Open Orders by Transaction Type (with chart)","chart_type":"pieF","do_round":1,"chart_description":"Open Orders by Transaction Type (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order","dependents":[]}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]}}}}',
            "isPublished" => "0",
        ];

        $openOrdersBySalesRepAndTransactionType = [
            "id"          => "b0f0a18a-50e0-11eb-945d-0242ac140008",
            "name"        => "Open Orders by Sales Rep and Transaction Type",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "hBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"},{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"Open Orders by Sales Rep and Transaction Type","chart_type":"hBarF","do_round":1,"chart_description":"Open Orders by Sales Rep and Transaction Type","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]}}}}',
            "isPublished" => "0",
        ];

        $this->sqlInsertReportIfNotExist($db, $openOrdersByClosingDate);
        $this->sqlInsertReportIfNotExist($db, $openOrdersByPurchasePrice);
        $this->sqlInsertReportIfNotExist($db, $openOrdersBySalesRep);
        $this->sqlInsertReportIfNotExist($db, $openOrdersByTransactionType);
        $this->sqlInsertReportIfNotExist($db, $openOrdersBySalesRepAndTransactionType);

        $closedOrdersByClosingDate = [
            "id"          => "43163f60-50ec-11eb-a071-0242ac140008",
            "name"        => "Closed Orders by Closing Date",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"estimated_closing","label":"LBL_ESTIMATED_CLOSING","vname":"Closing Date","type":"date","module":"Order_RQ_Order","mass_update":true,"required":true,"reportable":true,"importable":true,"table_key":"self","sort_dir":"a"}],"report_name":"Closed Orders by Closing Date","chart_type":"none","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]}}}}',
            "isPublished" => "0",
        ];

        $closedOrdersByPurchasePrice = [
            "id"          => "60a2e7d6-5fb5-11eb-8e51-0242ac140008",
            "name"        => "Closed Orders by Purchase Price",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"purchase_price","vname":"Purchase Price","type":"currency","importable":"true","duplicate_merge":"enabled","duplicate_merge_dom_value":"1","reportable":true,"merge_filter":"disabled","len":26,"size":"20","precision":6,"table_key":"self","sort_dir":"d"}],"report_name":"Closed Orders by Purchase Price","chart_type":"none","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]}}}}',
            "isPublished" => "0",
        ];

        $closedOrdersBySalesRep = [
            "id"          => "75eb5264-50eb-11eb-a3b2-0242ac140008",
            "name"        => "Closed Orders by Sales Rep (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "vGBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"},{"name":"sales_rep","label":"Sales Rep","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"Closed Orders by Sales Rep (with chart)","chart_type":"vGBarF","do_round":1,"chart_description":"Closed Orders by Sales Rep (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","input_name0":["CLOSED"]}}}}',
            "isPublished" => "0",
        ];

        $closedOrdersByTransactionType = [
            "id"          => "e63a257c-50eb-11eb-8b51-0242ac140008",
            "name"        => "Closed Orders by Transaction Type (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "pieF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar","force_label":"Transaction Type"}],"summary_columns":[{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"Closed Orders by Transaction Type (with chart)","chart_type":"pieF","do_round":1,"chart_description":"Closed Orders by Transaction Type (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]}}}}',
            "isPublished" => "0",
        ];

        $closedOrdersBySalesRepAndTransactionType = [
            "id"          => "26697b48-50ec-11eb-a932-0242ac140008",
            "name"        => "Closed Orders by Sales Rep and Transaction Type",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "hBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"},{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"Closed Orders by Sales Rep and Transaction Type","chart_type":"hBarF","do_round":1,"chart_description":"Closed Orders by Sales Rep and Transaction Type","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]}}}}',
            "isPublished" => "0",
        ];

        $closedOrdersByLender = [
            "id"          => "b17018fe-50ed-11eb-a4f4-0242ac140008",
            "name"        => "Closed Orders by Lender (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "vBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"name","label":"Name","table_key":"Order_RQ_Order:party_rq_party_order_rq_order:party_account","type":"name"}],"summary_columns":[{"name":"name","label":"Name","table_key":"Order_RQ_Order:party_rq_party_order_rq_order:party_account"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"order_by":[{"name":"estimated_closing","label":"LBL_ESTIMATED_CLOSING","vname":"Closing Date","type":"date","module":"Order_RQ_Order","mass_update":true,"required":true,"reportable":true,"importable":true,"table_key":"self","sort_dir":"a"}],"report_name":"Closed Orders by Lender (with chart)","chart_type":"vBarF","do_round":1,"chart_description":"Closed Orders by Lender (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order","dependents":[]},"Order_RQ_Order:party_rq_party_order_rq_order":{"name":"Orders  \u003E  RQ_Party","parent":"self","link_def":{"name":"party_rq_party_order_rq_order","relationship_name":"party_rq_party_order_rq_order","bean_is_lhs":false,"link_type":"many","label":"RQ_Party","module":"Party_RQ_Party","table_key":"Order_RQ_Order:party_rq_party_order_rq_order"},"dependents":["Filter.1_table_filter_row_2","group_by_row_2","display_summaries_row_group_by_row_2","Filter.1_table_filter_row_2","Filter.1_table_filter_row_2","Filter.1_table_filter_row_2","group_by_row_2","display_summaries_row_group_by_row_2","Filter.1_table_filter_row_2","Filter.1_table_filter_row_2","group_by_row_2","display_summaries_row_group_by_row_2","Filter.1_table_filter_row_2","group_by_row_1","display_summaries_row_group_by_row_1"],"module":"Party_RQ_Party","label":"RQ_Party"},"Order_RQ_Order:party_rq_party_order_rq_order:party_account":{"name":"Orders  \u003E  RQ_Party  \u003E  Party Accounts","parent":"Order_RQ_Order:party_rq_party_order_rq_order","link_def":{"name":"party_account","relationship_name":"party_account","bean_is_lhs":false,"link_type":"one","label":"Party Accounts","module":"Accounts","table_key":"Order_RQ_Order:party_rq_party_order_rq_order:party_account"},"dependents":["group_by_row_2","display_summaries_row_group_by_row_2","group_by_row_1","display_summaries_row_group_by_row_1"],"module":"Accounts","label":"Party Accounts"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"party_type","table_key":"Order_RQ_Order:party_rq_party_order_rq_order","qualifier_name":"is","runtime":1,"input_name0":["Lenders"]}}}}',
            "isPublished" => "0",
        ];

        $this->sqlInsertReportIfNotExist($db, $closedOrdersByPurchasePrice);
        $this->sqlInsertReportIfNotExist($db, $closedOrdersByClosingDate);
        $this->sqlInsertReportIfNotExist($db, $closedOrdersBySalesRep);
        $this->sqlInsertReportIfNotExist($db, $closedOrdersByTransactionType);
        $this->sqlInsertReportIfNotExist($db, $closedOrdersBySalesRepAndTransactionType);
        $this->sqlInsertReportIfNotExist($db, $closedOrdersByLender);

        $myOpenOrdersByClosingDate = [
            "id"          => "c955d774-5fbb-11eb-b966-0242ac140008",
            "name"        => "My Open Orders by Closing Date",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"estimated_closing","label":"LBL_ESTIMATED_CLOSING","vname":"Closing Date","type":"date","module":"Order_RQ_Order","mass_update":true,"required":true,"reportable":true,"importable":true,"table_key":"self","sort_dir":"a"}],"report_name":"My Open Orders by Closing Date","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order","dependents":[]},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_3"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}},"chart_type":"none"}',
            "isPublished" => "0",
        ];

        $myOpenOrdersByPurchasePrice = [
            "id"          => "11de8cd4-5fbc-11eb-9837-0242ac140008",
            "name"        => "My Open Orders by Purchase Price",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"purchase_price","vname":"Purchase Price","type":"currency","importable":"true","duplicate_merge":"enabled","duplicate_merge_dom_value":"1","reportable":true,"merge_filter":"disabled","len":26,"size":"20","precision":6,"table_key":"self","sort_dir":"d"}],"report_name":"My Open Orders by Purchase Price","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}},"chart_type":"none"}',
            "isPublished" => "0",
        ];

        $myOpenOrdersBySalesRep = [
            "id"          => "4bf16f5e-5fbc-11eb-945e-0242ac140008",
            "name"        => "My Open Orders by Sales Rep (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "vGBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"},{"name":"sales_rep","label":"Sales Rep","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"My Open Orders by Sales Rep (with chart)","chart_type":"vGBarF","do_round":1,"chart_description":"My Open Orders by Sales Rep (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $myOpenOrdersByTransactionType = [
            "id"          => "7c0c604a-5fbc-11eb-9e92-0242ac140008",
            "name"        => "My Open Orders by Transaction Type (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "pieF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar"}],"summary_columns":[{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"My Open Orders by Transaction Type (with chart)","chart_type":"pieF","do_round":1,"chart_description":"My Open Orders by Transaction Type (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $myOpenOrdersBySalesRepAndTransactionType = [
            "id"          => "ab85a32c-5fbc-11eb-899d-0242ac140008",
            "name"        => "My Open Orders by Sales Rep and Transaction Type",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "hBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"},{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"My Open Orders by Sales Rep and Transaction Type","chart_type":"hBarF","do_round":1,"chart_description":"My Open Orders by Sales Rep and Transaction Type","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["OPEN"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $this->sqlInsertReportIfNotExist($db, $myOpenOrdersByClosingDate);
        $this->sqlInsertReportIfNotExist($db, $myOpenOrdersByPurchasePrice);
        $this->sqlInsertReportIfNotExist($db, $myOpenOrdersBySalesRep);
        $this->sqlInsertReportIfNotExist($db, $myOpenOrdersByTransactionType);
        $this->sqlInsertReportIfNotExist($db, $myOpenOrdersBySalesRepAndTransactionType);

        $myClosedOrdersByClosingDate = [
            "id"          => "c46c5aa4-5fbf-11eb-91b2-0242ac140008",
            "name"        => "My Closed Orders by Closing Date",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"estimated_closing","label":"LBL_ESTIMATED_CLOSING","vname":"Closing Date","type":"date","module":"Order_RQ_Order","mass_update":true,"required":true,"reportable":true,"importable":true,"table_key":"self","sort_dir":"a"}],"report_name":"My Closed Orders by Closing Date","chart_type":"none","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2","Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $myClosedOrdersByPurchasePrice = [
            "id"          => "05bac0e4-5fc1-11eb-8b45-0242ac140008",
            "name"        => "My Closed Orders by Purchase Price",
            "module"      => "Order_RQ_Order",
            "reportType"  => "tabular",
            "chartType"   => "none",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[],"summary_columns":[],"order_by":[{"name":"purchase_price","vname":"Purchase Price","type":"currency","importable":"true","duplicate_merge":"enabled","duplicate_merge_dom_value":"1","reportable":true,"merge_filter":"disabled","len":26,"size":"20","precision":6,"table_key":"self","sort_dir":"d"}],"report_name":"My Closed Orders by Purchase Price","do_round":1,"numerical_chart_column":"","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"tabular","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}},"chart_type":"none"}',
            "isPublished" => "0",
        ];

        $myClosedOrdersBySalesRep = [
            "id"          => "1b932150-5fc5-11eb-8607-0242ac140008",
            "name"        => "My Closed Orders by Sales Rep (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "vGBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"},{"name":"sales_rep","label":"Sales Rep","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"My Closed Orders by Sales Rep (with chart)","chart_type":"vGBarF","do_round":1,"chart_description":"My Closed Orders by Sales Rep (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $myClosedOrdersByTransactionType = [
            "id"          => "67e6c750-5fc5-11eb-9282-0242ac140008",
            "name"        => "My Closed Orders by Transaction Type (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "pieF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar"}],"summary_columns":[{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"My Closed Orders by Transaction Type (with chart)","chart_type":"pieF","do_round":1,"chart_description":"My Closed Orders by Transaction Type (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $myClosedOrdersBySalesRepAndTransactionType = [
            "id"          => "9642dba2-5fc5-11eb-8897-0242ac140008",
            "name"        => "My Closed Orders by Sales Rep and Transaction Type",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "hBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"sales_rep","label":"Sales Rep","table_key":"self","type":"relate"},{"name":"transaction_type","label":"Transaction Type","table_key":"self","type":"varchar"}],"summary_columns":[{"name":"sales_rep","label":"Sales Rep","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"report_name":"My Closed Orders by Sales Rep and Transaction Type","chart_type":"hBarF","do_round":1,"chart_description":"My Closed Orders by Sales Rep and Transaction Type","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]}}}}',
            "isPublished" => "0",
        ];

        $myClosedOrdersByLender = [
            "id"          => "db7cbf26-5fc5-11eb-ad9f-0242ac140008",
            "name"        => "My Closed Orders by Lender (with chart)",
            "module"      => "Order_RQ_Order",
            "reportType"  => "detailed_summary",
            "chartType"   => "vBarF",
            "schduleType" => "pro",
            "contents"    => '{"display_columns":[{"name":"name","label":"Name","table_key":"self"},{"name":"order_status","label":"Status","table_key":"self"},{"name":"transaction_type","label":"Transaction Type","table_key":"self"},{"name":"order_number","label":"Qualia Order Number","table_key":"self"},{"name":"purchase_price","label":"Purchase Price","table_key":"self"},{"name":"estimated_closing","label":"Closing Date","table_key":"self"}],"module":"Order_RQ_Order","group_defs":[{"name":"name","label":"Name","table_key":"Order_RQ_Order:party_rq_party_order_rq_order:party_account","type":"name"}],"summary_columns":[{"name":"name","label":"Name","table_key":"Order_RQ_Order:party_rq_party_order_rq_order:party_account"},{"name":"count","label":"Count","field_type":"","group_function":"count","table_key":"self"}],"order_by":[{"name":"estimated_closing","label":"LBL_ESTIMATED_CLOSING","vname":"Closing Date","type":"date","module":"Order_RQ_Order","mass_update":true,"required":true,"reportable":true,"importable":true,"table_key":"self","sort_dir":"a"}],"report_name":"My Closed Orders by Lender (with chart)","chart_type":"vBarF","do_round":1,"chart_description":"My Closed Orders by Lender (with chart)","numerical_chart_column":"self:count","numerical_chart_column_type":"","assigned_user_id":"cb7cc1fc-2fdc-11eb-8468-0242ac140007","report_type":"summary","full_table_list":{"self":{"value":"Order_RQ_Order","module":"Order_RQ_Order","label":"Order_RQ_Order"},"Order_RQ_Order:assigned_user_link":{"name":"Orders  \u003E  Assigned to User","parent":"self","link_def":{"name":"assigned_user_link","relationship_name":"order_rq_order_assigned_user","bean_is_lhs":false,"link_type":"one","label":"Assigned to User","module":"Users","table_key":"Order_RQ_Order:assigned_user_link"},"dependents":["Filter.1_table_filter_row_2"],"module":"Users","label":"Assigned to User"},"Order_RQ_Order:party_rq_party_order_rq_order":{"name":"Orders  \u003E  RQ_Party","parent":"self","link_def":{"name":"party_rq_party_order_rq_order","relationship_name":"party_rq_party_order_rq_order","bean_is_lhs":false,"link_type":"many","label":"RQ_Party","module":"Party_RQ_Party","table_key":"Order_RQ_Order:party_rq_party_order_rq_order"},"dependents":["Filter.1_table_filter_row_3","group_by_row_1","display_summaries_row_group_by_row_1"],"module":"Party_RQ_Party","label":"RQ_Party"},"Order_RQ_Order:party_rq_party_order_rq_order:party_account":{"name":"Orders  \u003E  RQ_Party  \u003E  Party Accounts","parent":"Order_RQ_Order:party_rq_party_order_rq_order","link_def":{"name":"party_account","relationship_name":"party_account","bean_is_lhs":false,"link_type":"one","label":"Party Accounts","module":"Accounts","table_key":"Order_RQ_Order:party_rq_party_order_rq_order:party_account"},"dependents":["group_by_row_1","display_summaries_row_group_by_row_1"],"module":"Accounts","label":"Party Accounts"}},"filters_def":{"Filter_1":{"operator":"AND","0":{"name":"order_status","table_key":"self","qualifier_name":"is","runtime":1,"input_name0":["CLOSED"]},"1":{"name":"user_name","table_key":"Order_RQ_Order:assigned_user_link","qualifier_name":"is","runtime":1,"input_name0":["Current User"]},"2":{"name":"party_type","table_key":"Order_RQ_Order:party_rq_party_order_rq_order","qualifier_name":"is","runtime":1,"input_name0":["Lenders"]}}}}',
            "isPublished" => "0",
        ];

        $this->sqlInsertReportIfNotExist($db, $myClosedOrdersByPurchasePrice);
        $this->sqlInsertReportIfNotExist($db, $myClosedOrdersByClosingDate);
        $this->sqlInsertReportIfNotExist($db, $myClosedOrdersBySalesRep);
        $this->sqlInsertReportIfNotExist($db, $myClosedOrdersByTransactionType);
        $this->sqlInsertReportIfNotExist($db, $myClosedOrdersBySalesRepAndTransactionType);
        $this->sqlInsertReportIfNotExist($db, $myClosedOrdersByLender);
    }

    public function sqlInsertReportIfNotExist($db, $data)
    {
        $id          = $data["id"];
        $name        = $data["name"];
        $module      = $data["module"];
        $reportType  = $data["reportType"];
        $chartType   = $data["chartType"];
        $schduleType = $data["schduleType"];
        $contents    = $data["contents"];
        $isPublished = $data["isPublished"];

        $sqlInsert = <<<EOQ
        INSERT INTO
          saved_reports
        (
          id,
          name,
          date_entered,
          date_modified,
          modified_user_id,
          created_by,
          description,
          deleted,
          module,
          report_type,
          content,
          is_published,
          chart_type,
          schedule_type,
          favorite,
          assigned_user_id,
          team_id,
          team_set_id
        )
        VALUES (
          '{$id}',
          '{$name}',
          NOW(),
          NOW(),
          1,
          1,
          null,
          0,
          '{$module}',
          '{$reportType}',
          '{$contents}',
          {$isPublished},
          '{$chartType}',
          '{$schduleType}',
          0,
          1,
          1,
          1
        )
        ON DUPLICATE KEY UPDATE
          date_modified = NOW(),
          report_type   = '{$reportType}',
          content       = '{$contents}',
          is_published  = {$isPublished},
          chart_type    = '{$chartType}',
          schedule_type = '{$schduleType}',
          name = '{$name}'
EOQ;
        try {
            $conn      = $db->getConnection();
            $sqlResult = $conn->executeQuery($sqlInsert);
        } catch (Exception $e) {
            $GLOBALS['log']->debug("debug catch error for Qualia post install on saved_reports insert. Error: " . $e->getMessage());
        }
    }

    private function handleJobs()
    {
        $insertFailedRecord = [
            'name'            => 'Qualia - Insert Failed Records',
            'function'        => 'class::Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Jobs\InsertFailedRecord',
            'date_time_start' => '2005-01-01 08:45:00',
            'job_interval'    => '0::*/1::*::*::*',
            'job_status'      => 'Active',
            'catch_up'        => '1',
            'id'              => 'b63a01f6-6231-11eb-8b58-0242ac140007',
        ];

        // $syncSalesRepJob = [
        //     'name'            => 'Qualia - Sync Sales Rep',
        //     'function'        => 'class::Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Jobs\QualiaSyncSalesRepJob',
        //     'date_time_start' => '2005-01-01 08:45:00',
        //     'job_interval'    => '0::*/1::*::*::*',
        //     'job_status'      => 'Active',
        //     'catch_up'        => '1',
        //     'id'              => '36b954c6-e53b-11eb-906d-0242ac140007',
        // ];

        $this->handleScheduledJobs($insertFailedRecord);
        //$this->handleScheduledJobs($syncSalesRepJob);
    }

    public function handleScheduledJobs($jobDetails)
    {
        try {
            $job                  = BeanFactory::getBean('Schedulers');
            $job->name            = $jobDetails['name'];
            $job->job             = $jobDetails['function'];
            $job->date_time_start = $jobDetails['date_time_start'];
            $job->job_interval    = $jobDetails['job_interval'];
            $job->status          = $jobDetails['job_status'];
            $job->catch_up        = $jobDetails['catch_up'];
            $job->id              = $jobDetails['id'];
            $job->new_with_id     = true;
            $job->save();
        } catch (Exception $e) {
            $GLOBALS['log']->debug("Qualia Debug:" . $e->getMessage());
        }
    }

    private function handleModulesDisplay()
    {
        $administration = new Administration();

        $administration->retrieveSettings('MySettings');

        $moduleToBeRemoved = ["Calendar", "Calls", "Meetings", "Tasks", "Quotes", "Notes", "Emails", "wMaps",
            "pmse_Project", "pmse_Inbox", "pmse_Business_Rules"];

        if (isset($administration) && isset($administration->settings["MySettings_tab"])) {
            $tabs         = $administration->settings["MySettings_tab"];
            $trimmed_tabs = trim($tabs);
            //make sure serialized string is not empty
            if (!empty($trimmed_tabs)) {
                $tabs    = base64_decode($tabs);
                $tabs    = unserialize($tabs, ['allowed_classes' => false]);
                $newTabs = [];
                foreach ($tabs as $id => $tab) {

                    if (!in_array($tab, $moduleToBeRemoved)) {
                        if (is_string($id)) {
                            $newTabs[$id] = $tab;
                        } else {
                            $newTabs[] = $tab;
                        }
                    }
                }
            }
        }

        $administration->saveSetting('MySettings', 'tab', base64_encode(serialize($newTabs)));
    }
}
