<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\LogicHooks;

use ReportsController;
use SavedReport;
use SugarBean;

class ReportsHandleSaveHook
{
    const WREPORTS_DASHLET_ACTION = "wReportsDashletRedirectEdit";

    const REQUIRED_MODULE = "Reports";

    const REQUIRED_ACTION = "ReportCriteriaResults";

    /**
     * @param SugarBean $bean
     * @param string $event
     * @param array $arguments
     *
     * @return void
     */
    public function handleEdit(SavedReport $bean, $event, $arguments)
    {
        if ($this->shouldChange($arguments["id"]) === true) {
            $this->changeAction();
        }
    }

    /**
     * Check if the right conditions to change the action are met
     *
     * @param string $id
     * @return bool
     */
    private function shouldChange(string $id): bool
    {
        if (empty($id) === true) {
            return false;
        }

        if ($_REQUEST[self::WREPORTS_DASHLET_ACTION] !== "1") {
            return false;
        }

        if ($_REQUEST["action"] !== self::REQUIRED_ACTION) {
            return false;
        }

        if ($_REQUEST["module"] !== self::REQUIRED_MODULE) {
            return false;
        }

        return true;
    }

    /**
     * Change the action from ReportCriteriaResults to ReportsWizard in order the record to enter in Edit Mode
     *
     * @return void
     */
    private function changeAction(): void
    {
        if ($GLOBALS["app"]->controller instanceof ReportsController) {
            $GLOBALS["app"]->controller->view_object_map['action'] = 'ReportsWizard';
        }
    }
}
