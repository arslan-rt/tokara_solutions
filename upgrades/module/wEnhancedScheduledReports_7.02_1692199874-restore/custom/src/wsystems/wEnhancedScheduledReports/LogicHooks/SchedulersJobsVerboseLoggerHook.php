<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wEnhancedScheduledReports\LogicHooks;

use SugarBean;

class SchedulersJobsVerboseLoggerHook
{
    /**
     * @param SugarBean $bean
     * @param string $event
     * @param array $arguments
     *
     * @return void
     */
    public function logErrors(SugarBean $bean, string $event, array $arguments): void
    {
        $bean->message = "Error: " . json_encode(error_get_last()) . ". ";
        return;
    }
}
