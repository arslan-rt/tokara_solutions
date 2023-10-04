<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

require_once 'modules/SchedulersJobs/SchedulersJob.php';

/**
 * Class to run a job which should submit report to a single user and schedule next run time
 */
class WsystemsSugarJobSendScheduledReport implements RunnableSchedulerJob
{
    /**
     * @var SchedulersJob
     */
    protected $job;

    /**
     * @param SchedulersJob $job
     */
    public function setJob(SchedulersJob $job)
    {
        $this->job = $job;
    }

    /**
     * @param $data
     * @return bool
     */

    public function run($data)
    {
        require_once 'include/utils/autoloader.php';
        global $current_user;
        global $locale;
        global $app_list_strings;

        $this->job->runnable_ran  = true;
        $this->job->runnable_data = $data;

        $report_schedule_id = $data;

        require_once 'custom/modules/ReportSchedules/CustomReportSchedule.php';
        $reportSchedule = new CustomReportSchedule();
        $scheduleInfo   = $reportSchedule->getInfo($report_schedule_id);

        $GLOBALS["log"]->debug("-----> in Reports foreach() loop");

        $savedReport = BeanFactory::getBean('Reports', $scheduleInfo['report_id'], array('disable_row_level_security' => true, 'use_cache' => false));
        if (!$savedReport || !$savedReport->id || !$savedReport->ACLAccess('view')) {
            $GLOBALS["log"]->error('ScheduleReport: User ' . $current_user->id . ' can not access report id ' . $scheduleInfo['report_id']);
            $this->job->succeedJob();

            return true;
        }

        $GLOBALS["log"]->debug("-----> Generating Reporter");
        $reporter = new Report(from_html($savedReport->content));

        $reporter->is_saved_report   = true;
        $reporter->isScheduledReport = true;
        $reporter->saved_report      = $savedReport;
        $reporter->saved_report_id   = $savedReport->id;

        $mod_strings        = return_module_language($current_user->preferred_language, 'Reports');
        $userAppListStrings = $app_list_strings;

        $app_list_strings = return_app_list_strings_language($current_user->preferred_language);

        // prevent invalid report from being processed
        if (!$reporter->is_definition_valid()) {
            $invalidFields = $reporter->get_invalid_fields();
            $args          = array($scheduleInfo['report_id'], implode(', ', $invalidFields));
            $message       = string_format($mod_strings['ERR_REPORT_INVALID'], $args);

            $GLOBALS["log"]->fatal("-----> {$message}");

            $reportOwner = BeanFactory::retrieveBean('Users', $savedReport->assigned_user_id);
            if ($reportOwner) {
                $reportsUtils = new ReportsUtilities();
                try {
                    $reportsUtils->sendNotificationOfInvalidReport($reportOwner, $message);
                } catch (MailerException $me) {
                    //@todo consider logging the error at the very least
                }
            }

            $this->job->failJob('Report field definition is invalid');

            return false;
        } else {
            $GLOBALS["log"]->debug("-----> Reporter settings attributes");
            $reporter->layout_manager->setAttribute("no_sort", 1);
            if ($scheduleInfo['export_report_to_pdf'] === "1") {
                $GLOBALS["log"]->debug("-----> Reporter Handling PDF output");
                require_once 'modules/Reports/templates/templates_tcpdf.php';
                $reportFilename = template_handle_pdf($reporter, false);
            }

            // get the recipient's data...

            // first get all email addresses known for this recipient
            $recipientEmailAddresses = array($current_user->email1, $current_user->email2);

            // then retrieve first non-empty email address
            $recipientEmailAddress = array_shift($recipientEmailAddresses);

            // get the recipient name that accompanies the email address
            $recipientName = $locale->formatName($current_user);

            try {
                $GLOBALS["log"]->debug("-----> Generating Mailer");
                $mailer     = MailerFactory::getSystemDefaultMailer();
                $timedate   = TimeDate::getInstance();
                $reportTime = $timedate->getNow();
                $reportTime = $timedate->asUser($reportTime) . ' ' . $reportTime->format('T');
                $reportName = empty($savedReport->name) ? "Report" : $savedReport->name;
                // set the subject of the email
                $subject = $mod_strings["LBL_SUBJECT_SCHEDULED_REPORT"] . $reportName .
                    $mod_strings["LBL_SUBJECT_AS_OF"] . $reportTime;
                $mailer->setSubject($subject);

                // add the recipient
                $mailer->addRecipientsTo(new EmailIdentity($recipientEmailAddress, $recipientName));

                if ($scheduleInfo['additional_email'] != "" && $scheduleInfo['additional_email'] != null) {
                    $additional_emails = $scheduleInfo['additional_email'];
                    $cc_emails         = explode(',', $additional_emails);
                    foreach ($cc_emails as $cc_email_address) {
                        $mailer->addRecipientsCc(new EmailIdentity($cc_email_address));
                    }
                }

                if ($scheduleInfo['bcc_additional_email'] != "" && $scheduleInfo['bcc_additional_email'] != null) {
                    $bcc_additional_emails = $scheduleInfo['bcc_additional_email'];
                    $bcc_emails            = explode(',', $bcc_additional_emails);
                    foreach ($bcc_emails as $bcc_email_address) {
                        $mailer->addRecipientsBcc(new EmailIdentity($bcc_email_address));
                    }
                }

                // attach the pdf to report
                if ($scheduleInfo['export_report_to_pdf'] === "1") {
                    $charsToRemove = array("\r", "\n");
                    // remove these characters from the attachment name

                    $attachmentName = str_replace($charsToRemove, "", $reportName . ' ' . $reportTime);
                    // replace spaces with the underscores
                    $attachmentName = str_replace(" ", "_", "{$attachmentName}.pdf");
                    $attachment     = new Attachment($reportFilename, $attachmentName, Encoding::Base64, "application/pdf");
                    $mailer->addAttachment($attachment);
                }

                //Include link to report in email
                if ($scheduleInfo['include_link_to_report']) {
                    global $sugar_config;
                    //get url link of instance
                    $keep_site_url = $sugar_config['site_url'];
                    $keep_path     = "bwc/index.php?module=Reports&action=DetailView&record=";
                    //take report_id
                    $keep_report_id = $scheduleInfo['report_id'];
                    //build report link
                    $report_link = $keep_site_url . '/#' . $keep_path . $keep_report_id;
                    // set the body of the email
                    $body = $mod_strings["LBL_HELLO"];

                    if ($recipientName != "") {
                        $body .= " {$recipientName}";
                    }

                    //Include instructions to report in email
                    if ($scheduleInfo['add_instructions'] != "" && $scheduleInfo['add_instructions'] != null) {
                        $additional_emails = $scheduleInfo['add_instructions'];
                        $body .= ",\n\n" . $mod_strings["LBL_SCHEDULED_REPORT_MSG_INTRO"] . "<br /><br />"
                        . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY1"] . "<a href=" . $report_link . ">" . $savedReport->name . "</a>" . "<br /><br />"
                            . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY2"]
                            . $reportTime . "<br /><br />" . "<b>" . "Instructions: " . "</b>"
                            . $additional_emails;
                    } else {
                        $body .= ",\n\n" . $mod_strings["LBL_SCHEDULED_REPORT_MSG_INTRO"] . "<br /><br />"
                        . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY1"] . "<a href=" . $report_link . ">" . $savedReport->name . "</a>" . "<br /><br />"
                            . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY2"]
                            . $reportTime;
                    }
                } else {
                    // set the body of the email
                    $body = $mod_strings["LBL_HELLO"];

                    if ($recipientName != "") {
                        $body .= " {$recipientName}";
                    }
                    //Include instructions to report in email
                    if ($scheduleInfo['add_instructions'] != "" && $scheduleInfo['add_instructions'] != null) {
                        $additional_emails = $scheduleInfo['add_instructions'];
                        $body .= ",\n\n" . $mod_strings["LBL_SCHEDULED_REPORT_MSG_INTRO"] . "<br /><br />"
                        . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY1"] . $savedReport->name
                            . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY2"]
                            . $reportTime . "<br /><br />" . "<b>" . "Instructions: " . "</b>"
                            . $additional_emails;
                    } else {
                        $body .= ",\n\n" . $mod_strings["LBL_SCHEDULED_REPORT_MSG_INTRO"] . "<br /><br />"
                        . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY1"] . $savedReport->name
                            . $mod_strings["LBL_SCHEDULED_REPORT_MSG_BODY2"]
                            . $reportTime;
                    }
                }

                //get report resultData
                $returnData = $this->getSavedReportListViewById($scheduleInfo['report_id']);

                if ($scheduleInfo['show_report_in_body']) {
                    if ($returnData['report_type'] == 'summary') {
                        if (!$returnData['isSummationWithDetails']) {
                            $email_html_body = $this->getEmailHtmlBodyForSummary($returnData);
                        } else {
                            if ($returnData['fields']) {
                                $current_table_header       = $this->generateReportHeader($returnData['fields']);
                                $this->current_table_header = $current_table_header;
                            }
                            $email_html_body = $this->getEmailHtmlBodyForSummaryWithDetails($returnData);
                        }
                    }
                    if ($returnData['report_type'] == 'tabular') {
                        $email_html_body = $this->getEmailHtmlBodyForTabular($returnData);
                    }
                }

                //export as csv file
                if ($scheduleInfo['export_report_to_csv'] && $returnData['report_type'] == 'tabular') {

                    // attach the report, using the subject as the name of the attachment
                    $charsToRemoveFromCsv = array(
                        "\r",
                        "\n",
                    );
                    // remove these characters from the attachment name
                    $attachmentNameForCsv = str_replace($charsToRemoveFromCsv, "", $subject);
                    // replace spaces with the underscores
                    $filename = str_replace(" ", "_", "{$attachmentNameForCsv}.csv");

                    header("Content-Disposition: attachment; filename=" . $filename);
                    header("Content-Type: text/csv'");

                    //take data
                    $result = $returnData;
                    require_once "custom/include/upcurvecloud/SugarAutoLoaderCustom.php";

                    $filePath         = "upload//{$filename}";
                    $autoLoaderCustom = new SugarAutoLoaderCustom();
                    $autoLoaderCustom->touch($filePath, true);

                    require_once 'include/export_utils.php';
                    $reporter->plain_text_output = true;
                    //disable paging so we get all results in one pass
                    $reporter->enable_paging = false;
                    $reporter->run_query();
                    $reporter->_load_currency();
                    $header_arr = array();
                    $header_row = $reporter->get_header_row();
                    $content    = '';
                    foreach ($header_row as $cell) {
                        array_push($header_arr, $cell);
                    }
                    $header = implode("\"" . getDelimiter() . "\"", array_values($header_arr));
                    $header = "\"" . $header;
                    $header .= "\"\r\n";
                    $content .= $header;

                    while (($row = $reporter->get_next_row('result', 'display_columns', false, true)) != 0) {
                        $new_arr = array();

                        for ($i = 0; $i < count($row['cells']); $i++) {
                            array_push($new_arr, preg_replace("/\"/", "\"\"", from_html($row['cells'][$i])));
                        }

                        $line = implode("\"" . getDelimiter() . "\"", $new_arr);
                        $line = "\"" . $line;
                        $line .= "\"\r\n";

                        $content .= $line;
                    }
                    global $locale, $sugar_config;

                    $transContent = $GLOBALS['locale']->translateCharset(
                        $content,
                        'UTF-8',
                        $GLOBALS['locale']->getExportCharset(),
                        false,
                        true
                    );

                    $res = $autoLoaderCustom->put($filePath, $transContent, true);

                    //attach csv file to email
                    $attachment_csv = new Attachment($filePath, $filename, Encoding::Base64, "application/csv");
                    $mailer->addAttachment($attachment_csv);
                }

                //generate html to append to email body
                //check if we need to add html content to email body
                if ($email_html_body) {
                    $htmlbody = $body . '<br/><br/>' . $email_html_body;
                    $textBody = strip_tags(br2nl($body)); // need to create the plain-text part
                    $mailer->setTextBody($textBody);
                    $mailer->setHtmlBody($htmlbody);
                } else {
                    $textOnly = EmailFormatter::isTextOnly($body);
                    if ($textOnly) {
                        $mailer->setTextBody($body);
                    } else {
                        $textBody = strip_tags(br2nl($body)); // need to create the plain-text part
                        $mailer->setTextBody($textBody);
                        $mailer->setHtmlBody($body);
                    }
                }

                $GLOBALS["log"]->debug("-----> Sending PDF via Email to [ {$recipientEmailAddress} ]");
                $mailer->send();

                if (empty($filePath) === false) {
                    require_once "custom/include/upcurvecloud/SugarAutoLoaderCustom.php";
                    $autoLoaderCustom = new SugarAutoLoaderCustom();
                    $GLOBALS["log"]->debug("-----> Removing temporary CSV file");
                    $autoLoaderCustom->unlinkCustom($filePath);
                }

                $GLOBALS["log"]->debug("-----> Send successful");

                $numberOfDays         = date("t");
                $secondsInADay        = 86400;
                $monthlyIntervalIndex = 2;

                if ($scheduleInfo['time_interval'] == $monthlyIntervalIndex) {
                    $scheduleInfo["time_interval"] = $numberOfDays * $secondsInADay;
                }

                $reportSchedule->update_next_run_time(
                    $report_schedule_id,
                    $scheduleInfo["next_run"],
                    $scheduleInfo["time_interval"]
                );
            } catch (MailerException $me) {
                switch ($me->getCode()) {
                    case MailerException::InvalidEmailAddress:
                        $GLOBALS["log"]->info("No email address for {$recipientName}");
                        break;
                    default:
                        $GLOBALS["log"]->fatal("Mail error: " . $me->getMessage());
                        break;
                }
            }

            require_once "custom/include/upcurvecloud/SugarAutoLoaderCustom.php";

            $autoLoaderCustom = new SugarAutoLoaderCustom();

            if ($reportFilename && $scheduleInfo['export_report_to_pdf'] === "1") {
                $GLOBALS["log"]->debug("-----> Removing temporary PDF file");
                $autoLoaderCustom->unlink($reportFilename);
            }

            $app_list_strings = $userAppListStrings;

            $this->job->succeedJob();

            return true;
        }
    }

    public function getEmailHtmlBodyForSummaryWithDetails($returnData)
    {
        $html   = "<table style='font-family: arial, sans-serif;border-collapse: collapse;'>";
        $fields = $returnData['fields'];
        foreach ($returnData['collection'] as $name => $data) {
            $html .= "<tr style='width:100%;'><td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $this->generateReportGroup($data, $fields) . '</td></tr>';
        }
        $html .= '</table>';

        if ($returnData['grandTotal']) {
            $html .= "<h4>Grand Total</h4>";
            $html .= "<table style='font-family: arial, sans-serif;border-collapse: collapse;'>";
            $added_colored_line = false;
            foreach ($returnData['grandTotal'] as $prop) {
                if (!$added_colored_line) {
                    $html .= "<tr style='background-color: #dddddd;'>";
                    $added_colored_line = true;
                } else {
                    $html .= "<tr>";
                }
                foreach ($prop as $value) {
                    $html .= "<td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $value . "</td>";
                }
                $html .= "</tr>";
            }
            $html .= "</table>";
        }

        return $html;
    }

    public function generateReportGroup($group, $fields)
    {
        global $sugar_config;
        $html = "<table style='width:100%;font-family: arial, sans-serif;border-collapse: collapse;'>";

        if (isset($group['header'])) {
            $pos = strrpos($group['header'], "<a");
            if ($pos !== false) {
                $s           = explode('href="', $group['header']);
                $link        = explode('">', $s[1]);
                $current_url = $link[0];

                parse_str($current_url, $url_attr);

                if ($url_attr['record']) {
                    $link_with_site_url = $sugar_config['site_url'] . '/#' . $url_attr['module'] . '/' . $url_attr['record'];

                    $group['header'] = str_replace($current_url, $link_with_site_url, $group['header']);
                }
                $html .= "<tr style='width:100%;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $group['header'] . '</th></tr>';
            } else {
                $html .= "<tr style='width:100%;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $group['header'] . '</th></tr>';
            }
        }
        if (isset($group['wIsData']) && $group['wIsData'] === true) {
            if (isset($this->current_table_header) && sizeof($group) > 1) {
                $html .= $this->current_table_header;
            }

            foreach ($group as $key => $row) {
                if (is_numeric($key)) {
                    $html .= $this->generateReportRow($row, $key);
                }
            }
        } else {
            foreach ($group as $key => $row) {
                if ($key != 'wIsData' && $key != 'header') {
                    $html .= "<tr style='width:100%;'><td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $this->generateReportGroup($row, $fields) . '</td></tr>';
                }
            }
        }
        $html .= '</table>';

        return $html;
    }

    public function generateReportRow($row, $index)
    {
        global $sugar_config, $log;
        if ($index % 2 == 0) {
            $html = "<tr style='width:100%; background-color: #dddddd; width:100%;'>";
        } else {
            $html = "<tr style='width:100%;'>";
        }

        foreach ($row as $key => $val) {
            $pos = strrpos($val, "<a");
            if ($pos !== false) {
                $s           = explode('href="', $val);
                $link        = explode('">', $s[1]);
                $current_url = $link[0];

                parse_str($current_url, $url_attr);

                if ($url_attr['record']) {
                    $link_with_site_url = $sugar_config['site_url'] . '/#' . $url_attr['module'] . '/' . $url_attr['record'];

                    $val = str_replace($current_url, $link_with_site_url, $val);
                }
                $html .= "<td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $val . "</td>";
            } else {
                $html .= " <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $val . "</td>";
            }
        }
        $html .= '</tr>';

        return $html;
    }

    public function generateReportHeader($fields)
    {
        $html = "<tr style='width:100%;'>";
        foreach ($fields as $field) {
            $html .= "<th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $field['label'] . '</th>';
        }
        $html .= "</tr>";

        return $html;
    }

    public function getEmailHtmlBodyForSummary($returnData)
    {
        global $sugar_config, $log;
        $html = "<table style='font-family: arial, sans-serif;border-collapse: collapse;'>";

        if (!empty($returnData['headerTitles'])) {
            $html .= "<tr>";
            foreach ($returnData['headerTitles'][0] as $field_label) {
                $html .= "<th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $field_label . "</th>";
            }
            $html .= "</tr>";
        }

        foreach ($returnData['collection'] as $key => $row) {
            if (!empty($row)) {
                if ($key % 2 == 0) {
                    $html .= "<tr style='background-color: #dddddd;'>";
                } else {
                    $html .= "<tr>";
                }
                foreach ($row as $cell) {
                    $pos = strrpos($cell, "<a");
                    if ($pos !== false) {
                        $s           = explode('href="', $cell);
                        $link        = explode('">', $s[1]);
                        $current_url = $link[0];

                        parse_str($current_url, $url_attr);
                        if ($url_attr['record']) {
                            $link_with_site_url = $sugar_config['site_url'] . '/#' . $url_attr['module'] . '/' . $url_attr['record'];

                            $cell = str_replace($current_url, $link_with_site_url, $cell);
                        }
                        $html .= "<td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $cell . "</td>";
                    } else {
                        $html .= " <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $cell . "</td>";
                    }
                }
                $html .= "</tr>";
            }
        }
        $html .= "</table>";

        if ($returnData['grandTotal']) {
            $html .= "<h4>Grand Total</h4>";
            $html .= "<table style='font-family: arial, sans-serif;border-collapse: collapse;'>";
            $added_colored_line = false;
            foreach ($returnData['grandTotal'] as $prop) {
                if (!$added_colored_line) {
                    $html .= "<tr style='background-color: #dddddd;'>";
                    $added_colored_line = true;
                } else {
                    $html .= "<tr>";
                }
                foreach ($prop as $value) {
                    $html .= "<td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $value . "</td>";
                }
                $html .= "</tr>";
            }
            $html .= "</table>";
        }

        return $html;
    }

    public function getEmailHtmlBodyForTabular($returnData)
    {
        global $sugar_config, $log;

        $html = "<table style='font-family: arial, sans-serif;border-collapse: collapse;'>";

        if (!empty($returnData['fields'])) {
            $html .= "<tr>";
            foreach ($returnData['fields'] as $field) {
                if ($field['label']) {
                    $html .= "<th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $field['label'] . "</th>";
                } else {
                    $html .= "<th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $field['name'] . "</th>";
                }
            }
            $html .= "</tr>";
        }

        foreach ($returnData['collection'] as $key => $row) {
            if (!empty($row['cells'])) {
                if ($key % 2 == 0) {
                    $html .= "<tr style='background-color: #dddddd;'>";
                } else {
                    $html .= "<tr>";
                }
                foreach ($row['cells'] as $cell) {
                    $pos = strrpos($cell, "<a");
                    if ($pos !== false) {
                        $s           = explode('href="', $cell);
                        $link        = explode('">', $s[1]);
                        $current_url = $link[0];

                        parse_str($current_url, $url_attr);
                        if ($url_attr['record']) {
                            $link_with_site_url = $sugar_config['site_url'] . '/#' . $url_attr['module'] . '/' . $url_attr['record'];

                            $cell = str_replace($current_url, $link_with_site_url, $cell);
                        }

                        $html .= "<td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $cell . "</td>";
                    } else {
                        $html .= " <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>" . $cell . "</td>";
                    }
                }
                $html .= "</tr>";
            }
        }

        $html .= "</table>";

        return $html;
    }

    public function getSavedReportListViewById($report_id)
    {
        global $db, $current_user;
        $listReport = BeanFactory::getBean('Reports', $report_id, array(
            "encode"          => false,
            "strict_retrieve" => true,
        ));
        $report_content = json_decode($listReport->content, true);

        if (!empty($listReport)) {
            $returnData  = array();
            $this->title = $listReport->name;
            require_once "modules/Reports/Report.php";
            $reporter = new Report($listReport->content);

            $reporter->is_saved_report = true;

            $reporter->report_max      = 100000;
            $reporter->saved_report_id = $listReport->id;
            $reporter->get_total_header_row();
            $reporter->run_summary_combo_query();
            // build report data since it isn't a SugarBean
            $reportData               = array();
            $reportData['name']       = $reporter->name;
            $reportData['id']         = $reporter->saved_report_id;
            $reportData['module']     = $reporter->module;
            $returnData['reportData'] = $reportData;
            $rowList                  = array();
            $headers                  = array();
            $fields_to_display        = $reporter->report_def['display_columns'];
            $group_by_columns_count   = count($reporter->report_def['group_defs']);
            $group_def_array          = $reporter->report_def['group_defs'];
            $summary_columns_array    = $reporter->report_def['summary_columns'];
            $groupByIndexInHeaderRow  = array();
            $isSummationWithDetails   = $report_content['report_type'] == 'summary' && (count($fields_to_display) > 0);
            $isSimpleSummation        = $report_content['report_type'] == 'summary' && !$isSummationWithDetails;
            for ($i = 0; $i < count($summary_columns_array); $i++) {
                $groupByColumnLabel          = $summary_columns_array[$i]['label'];
                $groupByIndexInHeaderRow[$i] = $groupByColumnLabel;
            }
            $reporter->group_defs_Info = $groupByIndexInHeaderRow;
            $header_row                = $reporter->group_defs_Info;
            $headerTitles              = array();
            $rowsNumber                = 0;
            $hasCustomGrandTotal       = false;
            $grandTotalRow             = $reporter->get_summary_total_row();
            if (is_array($grandTotalRow)) {
                $hasCustomGrandTotal = true;
                $grandTotalRow       = $grandTotalRow['cells'];
            }
            if ($isSimpleSummation) {

                $rowsParsed = 0;
                // get the collection data and store it locally
                while ($reportResultRow = $reporter->get_summary_next_row()) {
                    $rowList[]  = $reportResultRow['cells'];
                    $rowsParsed = $rowsParsed + 1;
                }
                // getting the headers
                $reporter->run_summary_combo_query();
                $row                       = $reporter->get_summary_next_row();
                $headerTitles[$rowsNumber] = array();
                foreach ($row['cells'] as $cellIndex => $cellValue) {
                    $headerTitles[$rowsNumber][$cellIndex] = $this->getGroupByColumnName($reporter, $cellIndex, $header_row, $row, $isSummationWithDetails);
                }
            } elseif ($isSummationWithDetails) {
                $reporter->run_summary_combo_query();
                $row           = $db->fetchByAssoc($reporter->summary_result);
                $groupBysCount = 0;
                $groupBys      = array();
                // get params to group by
                if (is_array($row)) {
                    foreach ($row as $key => $value) {
                        if ($groupBysCount == $group_by_columns_count) {
                            break;
                        }
                        if ($isSummationWithDetails) {
                            $groupBys[] = $key;
                        } else {
                            array_unshift($groupBys, $key);
                        }

                        $groupBysCount++;
                    }
                }
                $rowsParsed     = 0;
                $cachedGroupBys = array();
                // cache their values
                while ($row = $db->fetchByAssoc($reporter->result)) {
                    $cachedGroupBys[] = array();
                    foreach ($groupBys as $groupByKey => $groupByValue) {
                        $cachedGroupBys[$rowsParsed][$groupByValue] = $row[$groupByValue];
                    }
                    $rowsParsed = $rowsParsed + 1;
                }

                $reporter->run_summary_combo_query();
                $rowsParsed = 0;
                // get the actual collection
                while ($reportResultRow = $reporter->get_next_row()) {
                    $rowValues = array();
                    // compose an array with the values
                    foreach ($reportResultRow['cells'] as $cellValue) {
                        $rowValues[] = $cellValue;
                    }
                    foreach ($groupBys as $groupByKey => $groupByValue) {
                        $rowValues[$groupByValue] = $cachedGroupBys[$rowsParsed][$groupByValue];
                    }
                    $rowsParsed = $rowsParsed + 1;
                    // insert the new values in the complete collection list
                    $rowList = $this->getGroup($rowList, $rowValues, $groupBys);
                    foreach ($groupBys as $groupByKey => $groupByValue) {
                        unset($rowValues[$groupByValue]);
                    }

                    $group[] = (object) $rowValues;
                }
                $rowsNumber = 0;
                // get the headers info
                $reporter->run_summary_combo_query();
                while ($row = $reporter->get_summary_next_row()) {
                    $headerTitles[$rowsNumber] = array();
                    // setting the titles
                    foreach ($row['cells'] as $cellIndex => $cellValue) {
                        $headerTitles[$rowsNumber][$cellIndex] = $this->getGroupByColumnName($reporter, $cellIndex, $header_row, $row, $isSummationWithDetails);
                    }
                    // add the count information to the title
                    if ((string) $row['cells'][0] === (string) $row['count']) {
                        $headerTitles[$rowsNumber][1] = $headerTitles[$rowsNumber][1] . ', ' . $headerTitles[$rowsNumber][0];
                        $headerTitles[$rowsNumber][0] = $headerTitles[$rowsNumber][count($headerTitles[$rowsNumber]) - 1];
                    } else {
                        $entries                             = count($headerTitles[$rowsNumber]) - 1;
                        $countText                           = 'Count = ' . $row['count'];
                        $headerTitles[$rowsNumber][$entries] = $headerTitles[$rowsNumber][$entries] . ', ' . $countText;
                    }
                    $rowsNumber = $rowsNumber + 1;
                }
                // add the titles directly to the collection
                $hedersInfoAdded = 0;
                $this->addHeadersInfo($rowList, $headerTitles, $hedersInfoAdded, 0, true);
            } else {
                $reporter->run_query();
                while ($row = $reporter->get_next_row('result')) {
                    $rowList[] = $row;
                }
            }
            // build the return data with the all the info needed
            $returnData['collection']                 = $rowList;
            $returnData['fields']                     = $fields_to_display;
            $returnData['report_type']                = $report_content['report_type'];
            $returnData['headerTitles']               = $headerTitles;
            $returnData['isSummationWithDetails']     = $isSummationWithDetails;
            $returnData['numberOfRows']               = $rowsParsed;
            $returnData['grandTotal']                 = array();
            $returnData['grandTotal']['columnNames']  = array();
            $returnData['grandTotal']['columnValues'] = array();
            if ($hasCustomGrandTotal) {
                for ($totalHeaderIndex = 0; $totalHeaderIndex < count($grandTotalRow); $totalHeaderIndex++) {
                    $value = $grandTotalRow[$totalHeaderIndex];
                    if (preg_match('/\d/', $value)) {
                        $returnData['grandTotal']['columnNames'][]  = $headerTitles[$rowsNumber][$totalHeaderIndex];
                        $returnData['grandTotal']['columnValues'][] = $value;
                    }
                }
            } else {
                $returnData['grandTotal']['columnNames'][]  = 'Count';
                $returnData['grandTotal']['columnValues'][] = $rowsParsed;
            }

            return $returnData;
        }
    }

    public function addHeadersInfo(&$rowList, $headerTitles, &$headerIndex, $subHeaderIndex, $isFirstHeader = false)
    {
        if (is_array($rowList)) {
            foreach ($rowList as $collectionKey => $collectionData) {
                if ($headerTitles[$headerIndex][$subHeaderIndex] && !$isFirstHeader && !$rowList['header']) {
                    $rowList['header'] = $headerTitles[$headerIndex][$subHeaderIndex];
                }
                if (($collectionKey !== 'header') && $rowList[$collectionKey]) {
                    if ($rowList[$collectionKey]['wIsData']) {
                        $newSubHeaderIndex = $subHeaderIndex + 1;
                        if ($isFirstHeader) {
                            $newSubHeaderIndex = 0;
                        }
                        $rowList[$collectionKey]['header'] = $headerTitles[$headerIndex][$newSubHeaderIndex];
                        $headerIndex                       = $headerIndex + 1;
                    } else {
                        $newSubHeaderIndex = $subHeaderIndex + 1;
                        if ($isFirstHeader) {
                            $newSubHeaderIndex = 0;
                        }
                        $this->addHeadersInfo($rowList[$collectionKey], $headerTitles, $headerIndex, $newSubHeaderIndex, false);
                    }
                }
            }
        }
    }

    public function getColumnsInfoFromHeaderExceptGroupBy(&$reporter, $header_row, $row)
    {
        $groupByIndexInHeaderRow = array();
        $group_def_array         = $reporter->report_def['group_defs'];
        $columnValues            = "";
        for ($i = 0; $i < count($group_def_array); $i++) {
            $key                       = $reporter->group_defs_Info[$this->getGroupByKey($group_def_array[$i])]['index'];
            $groupByIndexInHeaderRow[] = $key;
        }
        $count = 0;
        for ($i = 0; $i < count($header_row); $i++) {
            if (!in_array($i, $groupByIndexInHeaderRow)) {
                if ($count != 0) {
                    $columnValues = $columnValues . ", ";
                }
                $columnValues = $columnValues . $header_row[$i] . " = " . $row['cells'][$i];
                $count++;
            }
        }

        return $columnValues;
    }

    public function getGroupByColumnName(&$reporter, $index, $header_row, $row, $isSummationWithDetails = true)
    {
        $group_def_array    = $reporter->report_def['group_defs'];
        $attributeInfo      = $group_def_array[$index];
        $key                = $index;
        $groupByColumnLabel = $header_row[$index];
        $headerValue        = $row['cells'][$key];
        $columnValues       = "";
        if ($index == (count($group_def_array) - 1) && $isSummationWithDetails) {
            $columnValues = $this->getColumnsInfoFromHeaderExceptGroupBy($reporter, $header_row, $row);
        }
        if (empty($headerValue)) {
            $headerValue = "None";
        }
        if ($isSummationWithDetails) {
            $returnData = $groupByColumnLabel . " = " . $headerValue;
        } else {
            $returnData = $groupByColumnLabel;
        }

        if (!empty($columnValues)) {
            if (strpos($columnValues, $returnData) !== false) {
                $returnData = $columnValues;
            } else {
                $returnData = $returnData . ", " . $columnValues;
            }
        }

        return $returnData;
    }

    // fn
    public function getGroupByInfo($groupByArray, $summary_columns_array)
    {
        $gpByInfoArray = array();
        for ($i = 0; $i < count($summary_columns_array); $i++) {
            if (($summary_columns_array[$i]['name'] == $groupByArray['name']) && $summary_columns_array[$i]['label'] == $groupByArray['label'] && ($summary_columns_array[$i]['table_key'] == $groupByArray['table_key'])) {
                $gpByInfoArray          = $groupByArray;
                $gpByInfoArray['index'] = $i;
                break;
            } // if
        } // for

        return $gpByInfoArray;
    }

    // fn
    /**
     * Creates a unique key for a groupBy column
     * @param array $groupByArray
     * @return string
     */
    public function getGroupByKey($groupByArray)
    {
        // name+table_key may not be unique for some groupby columns, eg, 'Quarter: Modified Date'
        // and 'Month: Modified Date' both have the same 'name' and 'table_key'
        return $groupByArray['name'] . '#' . $groupByArray['table_key'] . '#' . $groupByArray['label'];
    }

    public function addDepthToArray($scheleton, $keys, $endValue)
    {
        if (count($keys) > 1) {
            $newKey             = $keys[0];
            $scheleton[$newKey] = array();
            $oldKey             = array_shift($keys);
            $newRows            = array();
            $scheleton[$newKey] = $this->addDepthToArray($scheleton[$newKey], $keys, $endValue);
        } else {
            $scheleton[$keys[0]][]          = $endValue;
            $scheleton[$keys[0]]['wIsData'] = true;
        }

        return $scheleton;
    }

    public function getGroup($rows, $row, $groupBys)
    {
        $groupBys  = $groupBys;
        $scheleton = array();
        $keys      = array();
        foreach ($groupBys as $keyValue) {
            $keys[] = $row[$keyValue];
            unset($row[$keyValue]);
        }
        $scheleton = $this->addDepthToArray($scheleton, $keys, $row);
        $rows      = $this->arrayMergeRecursiveCustom($rows, $scheleton);

        return $rows;
    }

    public function arrayMergeRecursiveCustom(array $array1, array $array2)
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
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key]) && ($containsArray === true)) {
                $merged[$key] = $this->arrayMergeRecursiveCustom($merged[$key], $value);
            } else {
                if (is_int($key)) {
                    $key = count($merged) - 1;
                }
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}
