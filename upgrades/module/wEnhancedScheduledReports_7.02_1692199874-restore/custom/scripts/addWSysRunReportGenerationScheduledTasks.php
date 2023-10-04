<?php

function runWSysRunReportGenerationScheduledTasks()
{
    $modListHeader = array();
    require_once "custom/modules/ReportSchedules/CustomReportSchedule.php";
    require_once "modules/Reports/utils.php";
    require_once "include/modules.php";
    require_once "config.php";
    require_once "custom/include/SugarQueue/jobs/WsystemsSugarJobSendScheduledReport.php";

    /** @var Localization $locale */
    global $sugar_config, $app_list_strings, $app_strings;

    $language         = $sugar_config["default_language"]; // here we"d better use English, because pdf coding problem.
    $app_list_strings = return_app_list_strings_language($language);
    $app_strings      = return_application_language($language);

    $reportSchedule = new CustomReportSchedule();
    $reportSchedule->handleFailedReports();
    $reportsToEmail = $reportSchedule->get_reports_to_email();

    //Process Enterprise Schedule reports via CSV
    //bug: 23934 - enable Advanced reports
    global $sugar_flavor;
    if ($sugar_flavor != "PRO") {
        require_once "modules/ReportMaker/process_scheduled.php";
    }

    global $modListHeader;

    $queue = new SugarJobQueue();
    foreach ($reportsToEmail as $scheduleInfo) {
        $job                   = BeanFactory::getBean("SchedulersJobs");
        $job->name             = "Send Scheduled Report " . $scheduleInfo["report_id"];
        $job->assigned_user_id = $scheduleInfo["user_id"];
        if ($scheduleInfo["show_report_in_body"] || $scheduleInfo["additional_email"] != ""
            || $scheduleInfo["bcc_additional_email"] != "" || $scheduleInfo["add_instructions"] != ""
            || $scheduleInfo["export_report_to_csv"] || $scheduleInfo["export_report_to_pdf"]
            || $scheduleInfo["include_link_to_report"]) {
            $job->target = "class::WsystemsSugarJobSendScheduledReport";
        } else {
            $job->target = "class::SugarJobSendScheduledReport";
        }
        $job->data      = $scheduleInfo["id"];
        $job->job_group = $scheduleInfo["report_id"];

        $queue->submitJob($job);
    }

    sugar_cleanup(false); // continue script execution so that if run from Scheduler, job status will be set back to "Active"

    return true;
}
