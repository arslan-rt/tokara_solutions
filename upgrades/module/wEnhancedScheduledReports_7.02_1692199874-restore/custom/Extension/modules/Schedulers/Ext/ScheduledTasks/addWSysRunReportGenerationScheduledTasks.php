<?php

$job_strings[] = "addWSysRunReportGenerationScheduledTasks";

require_once "custom/include/SugarQueue/jobs/WsystemsSugarJobSendScheduledReport.php";

function addWSysRunReportGenerationScheduledTasks()
{
    include_once "custom/scripts/addWSysRunReportGenerationScheduledTasks.php";
    runWSysRunReportGenerationScheduledTasks();
    return true;
}
