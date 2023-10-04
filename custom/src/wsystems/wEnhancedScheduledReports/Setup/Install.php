<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wEnhancedScheduledReports\Setup;

use Sugarcrm\Sugarcrm\custom\wsystems\wEnhancedScheduledReports\Traits\SugarConfigTrait;

/**
 *
 * @package Sugarcrm\Sugarcrm\custom\wsystems\wEnhancedScheduledReports\Setup
 */
class Install
{
    use SugarConfigTrait;

    /**
     *
     * @return void
     */
    public function postInstall()
    {
        $this->configSet("schedule_report_with_chart", true);
    }
}
