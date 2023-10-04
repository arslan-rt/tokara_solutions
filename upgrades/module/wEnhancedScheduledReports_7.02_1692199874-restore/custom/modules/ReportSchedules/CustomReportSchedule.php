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

require_once 'modules/ReportSchedules/ReportSchedule.php';

class CustomReportSchedule extends ReportSchedule
{
    /**
     * @deprecated Use __construct() instead
     */
    public function CustomReportSchedule()
    {
        parent::__construct();
    }

    /**
     * @param string $userId
     * @param string $scheduleType
     * @return string
     */
    protected function getQuery($userId = '', $scheduleType = 'pro')
    {
        $timedate = TimeDate::getInstance();
        $where    = '';
        if (!empty($userId)) {
            if ($scheduleType == 'pro') {
                $where = "AND reportschedules_users.user_id = '$userId'";
            } else {
                $where = "AND user_id = '$userId'";
            }
        }
        $time = $timedate->nowDb();
        if ($scheduleType == 'pro') {
            $query = "SELECT $this->table_name.id AS id, $this->table_name.report_id AS report_id, " .
                "$this->table_name.date_start AS date_start, $this->table_name.date_modified AS date_modified, " .
                "$this->table_name.next_run AS next_run, reportschedules_users.user_id AS user_id, " .
                "$this->table_name.show_report_in_body AS show_report_in_body, $this->table_name.additional_email AS additional_email, " .
                "$this->table_name.bcc_additional_email AS bcc_additional_email, " .
                "$this->table_name.add_instructions AS add_instructions, $this->table_name.export_report_to_csv AS export_report_to_csv, " .
                "$this->table_name.export_report_to_pdf AS export_report_to_pdf, " .
                "$this->table_name.include_link_to_report AS include_link_to_report " .
                "FROM $this->table_name " .
                "JOIN reportschedules_users on reportschedules_users.reportschedule_id = $this->table_name.id " .
                "JOIN saved_reports on saved_reports.id=$this->table_name.report_id " .
                "JOIN users on users.id = reportschedules_users.user_id " .
                "WHERE saved_reports.deleted = 0 AND " .
                "$this->table_name.next_run < '$time' $where AND " .
                "$this->table_name.deleted = 0 AND " .
                "$this->table_name.active = 1 AND " .
                "$this->table_name.schedule_type = '" . $scheduleType . "' AND " .
                "users.status = 'Active' AND users.deleted = 0 " .
                "AND reportschedules_users.deleted = 0 " .
                "ORDER BY $this->table_name.next_run ASC";
        } else {
            $query = "SELECT report_schedules.id AS id, report_schedules.report_id AS report_id, " .
                "report_schedules.date_start AS date_start,  report_schedules.date_modified AS date_modified, " .
                "report_schedules.next_run AS next_run, report_schedules.user_id AS user_id, " .
                "report_schedules.show_report_in_body AS show_report_in_body, report_schedules.additional_email AS additional_email, " .
                "report_schedules.bcc_additional_email AS bcc_additional_email," .
                "report_schedules.add_instructions AS add_instructions, report_schedules.export_report_to_csv AS export_report_to_csv, " .
                "report_schedules.export_report_to_pdf AS export_report_to_pdf, " .
                "report_schedules.include_link_to_report AS include_link_to_report" .
                "FROM $this->table_name \n" .
                "join saved_reports on saved_reports.id=$this->table_name.report_id \n" .
                "join users on users.id = report_schedules.user_id" .
                " WHERE saved_reports.deleted=0 AND \n" .
                "$this->table_name.next_run < '$time' $where AND \n" .
                "$this->table_name.deleted=0 AND \n" .
                "$this->table_name.active=1 AND " .
                "$this->table_name.schedule_type='" . $scheduleType . "' AND\n" .
                "users.status='Active' AND users.deleted='0'" .
                "ORDER BY $this->table_name.next_run ASC";
        }
        return $query;
    }

    /**
     * Handles failed reports by deactivating them and sending email notifications to owner and subscribed user
     */
    public function handleFailedReports()
    {
        $schedules_to_deactivate = $this->getSchedulesToDeactivate();
        foreach ($schedules_to_deactivate as $schedule) {
            LoggerManager::getLogger()->info('Deactivating report schedule ' . $schedule['id']);
            $this->deactivate($schedule['id']);

            $owner      = BeanFactory::retrieveBean('Users', $schedule['owner_id']);
            $scheduleId = $this->db->quoted($schedule['id']);
            $query      = <<<QUERY
SELECT
    user_id
FROM
    reportschedules_users
WHERE
    reportschedule_id = $scheduleId AND deleted = 0
QUERY;
            $subscriber = array();
            $result     = $this->db->query($query);
            while ($row = $this->db->fetchByAssoc($result)) {
                $subscriber[] = BeanFactory::retrieveBean('Users', $row['user_id']);
            }

            $utils = new ReportsUtilities();
            $utils->sendNotificationOfDisabledReport($schedule['report_id'], $owner, $subscriber, $schedule['name']);
        }
    }

    /**
     * Deactivates the given schedule
     *
     * @param string $id Schedule ID
     */
    public function deactivate($id)
    {
        $query = "UPDATE $this->table_name SET active = 0 WHERE id = " . $this->db->quoted($id);
        $this->db->query($query);
    }

    /**
     * Finds scheduled reports to be deactivated due to previous failure
     *
     * @return array
     */
    protected function getSchedulesToDeactivate()
    {
        $failure = SchedulersJob::JOB_FAILURE;

        $query = <<<QUERY
SELECT
    rs.id,
    rs.report_id,
    r.assigned_user_id owner_id,
    rs.user_id subscriber_id
FROM
    $this->table_name rs
    INNER JOIN (
        SELECT jq.job_group report_id, jq.execute_time
        FROM job_queue jq
        INNER JOIN (
            SELECT
                max(execute_time) mt,
                job_group
            FROM job_queue
            WHERE target = 'class::SugarJobSendScheduledReport' or target = 'class::WsystemsSugarJobSendScheduledReport'
            GROUP BY job_group
        ) last
        ON last.mt = jq.execute_time AND last.job_group = jq.job_group
        WHERE resolution = '{$failure}'
    ) j
    ON j.report_id = rs.report_id AND j.execute_time > rs.date_modified
        INNER JOIN saved_reports r
        ON r.id = rs.report_id
            INNER JOIN users u
            ON u.id = rs.user_id
WHERE
    r.deleted = 0
        AND rs.deleted = 0
        AND rs.active = 1
        AND u.status = 'Active'
        AND u.deleted = 0
QUERY;

        $reports = array();
        $result  = $this->db->query($query);
        while ($row = $this->db->fetchByAssoc($result)) {
            $reports[] = $row;
        }

        return $reports;
    }

    /**
     * Returns report schedule properties
     *
     * @param string $id Report schedule ID
     *
     * @return array
     */
    public function getInfo($id)
    {
        $query = "SELECT *
        FROM {$this->table_name}
        WHERE id = " . $this->db->quoted($id);
        $result = $this->db->query($query);
        $row    = $this->db->fetchByAssoc($result);
        $row    = $this->fromConvertReportScheduleDBRow($row);

        return $row;
    }

    private function getCustomIntervalTime($dateStart, $interval)
    {
        global $timedate;

        $beanDateStart   = $timedate->fromDb($this->date_start)->ts;
        $dateStart       = $dateStart > $beanDateStart ? $dateStart : $beanDateStart;
        $timeWithoutDate = $this->getStartDateTime($dateStart);

        $firstMonthIndex = 1;
        $numberOfMonths  = 12;
        $now             = time();
        $dateStart       = $now > $dateStart ? $now : $dateStart;

        $dateStartData       = $this->getSplitDate($dateStart);
        $currentMonthLastDay = intval(date("t", $dateStart));

        $day   = $dateStartData["day"];
        $month = $dateStartData["month"];
        $year  = $dateStartData["year"];

        if ($day >= $interval || $day === $currentMonthLastDay) {
            $month++;

            if ($month > $numberOfMonths) {
                $month = $firstMonthIndex;

                $year++;
            }
        }

        $currentMonthLastDay = intval(date("t", strtotime($month . "/01/" . $year)));
        $day                 = $interval > $currentMonthLastDay ? $currentMonthLastDay : $interval;
        $dateStart           = strtotime($month . "/" . $day . "/" . $year) + $timeWithoutDate;

        return $dateStart;
    }

    private function getSplitDate($dateStart)
    {
        $year  = intval(date("Y", $dateStart));
        $month = intval(date("m", $dateStart));
        $day   = intval(date("d", $dateStart));

        return array("year" => $year, "month" => $month, "day" => $day);
    }

    private function getStartDateTime($dateStart)
    {
        $dateStartData   = $this->getSplitDate($dateStart);
        $dateWithoutTime = strtotime($dateStartData["month"] . "/" . $dateStartData["day"] . "/" . $dateStartData["year"]);
        $timeWithoutDate = $dateStart - $dateWithoutTime;

        return $timeWithoutDate;
    }

    private function isCustomInterval($interval)
    {
        $customIntervals = array(1, 15, 31);

        return in_array($interval, $customIntervals);
    }

    public function update_next_run_time($schedule_id, $next_run, $interval)
    {
        if ($this->isCustomInterval($interval)) {
            global $timedate;

            $last_run = $this->getCustomIntervalTime($timedate->fromDb($next_run)->ts, $interval);

            $this->db->getConnection()
                 ->executeUpdate(
                     "UPDATE {$this->table_name} SET next_run = ? WHERE id = ?",
                     [$timedate->fromTimestamp($last_run)->asDb(), $schedule_id]
                 );
        } else {
            parent::update_next_run_time($schedule_id, $next_run, $interval);
        }
    }

    /**
     * Get the datetime when the schedule will run next
     *
     * @param $date_start
     * @param $interval
     * @return string
     */
    public function getNextRunDate($date_start, $interval)
    {
        if ($this->isCustomInterval($interval) || $this->isCustomInterval($this->time_interval)) {
            global $timedate;
            $properInterval = $interval != 0 ? $interval : $this->time_interval;

            $date_start = $timedate->fromDb($date_start)->ts;
            $date_start = $timedate->fromTimestamp($this->getCustomIntervalTime($date_start, $properInterval))->asDb();
        } else {
            $date_start = parent::getNextRunDate($date_start, $interval);
        }

        return $date_start;
    }
}
