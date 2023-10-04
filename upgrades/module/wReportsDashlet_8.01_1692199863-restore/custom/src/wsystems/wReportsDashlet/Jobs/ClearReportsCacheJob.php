<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Jobs;

use RunnableSchedulerJob;
use SchedulersJob;
use Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Utils\Utils as Utils;

class ClearReportsCacheJob implements RunnableSchedulerJob
{
    /**
     * @var SchedulersJob
     */
    protected $job;

    /**
     * @param SchedulersJob $job
     *
     * @return void
     */
    public function setJob(SchedulersJob $job): void
    {
        $this->job = $job;

    }

    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function run($data): bool
    {
        try {

            Utils::clearReportsCache();

        } catch (\Throwable $e) {
            $this->job->name .= " [ERROR: " . $e->getMessage() . "]";
            $this->job->message = $e->getMessage() . "\n" . $e->getTraceAsString();
        }

        return true;
    }
}
