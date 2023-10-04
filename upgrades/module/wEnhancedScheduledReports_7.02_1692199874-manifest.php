<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/
$manifest = array (
  'acceptable_sugar_versions' =>  
  array (
    0 => '13.0.*'
  ),
  'acceptable_sugar_flavors' =>  
  array (

  ),
  'readme' =>  'README.txt',
  'key' =>  'WSYS',
  'author' =>  'Cataron Bogdan, Mirel Ivan',
  'description' =>  'wSystems Run Report Generation Scheduled Tasks',
  'icon' =>  '',
  'is_uninstallable' =>  true,
  'name' =>  'wEnhancedScheduledReports',
  'published_date' =>  '2023-01-16 14:11:41',
  'type' =>  'module',
  'version' =>  '7.02',
  'remove_tables' =>  'prompt'
);
$installdefs = array (
  'pre_uninstall' =>  
  array (
    0 => '<basepath>/scripts/pre_uninstall.php'
  ),
  'post_install' =>  
  array (
    0 => '<basepath>/scripts/post_install.php'
  ),
  'id' =>  'wEnhancedScheduledReports',
  'copy' =>  
  array (
    0 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Include/ExtendReportScheduleBean.php',
      'to' =>  'custom/Extension/application/Ext/Include/ExtendReportScheduleBean.php'
    ),
    1 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/JSGroupings/wEnhancedScheduledReports.php',
      'to' =>  'custom/Extension/application/Ext/JSGroupings/wEnhancedScheduledReports.php'
    ),
    2 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.reportschedule_time_interval_dom.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.reportschedule_time_interval_dom.php'
    ),
    3 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/LogicHooks/addScheduledReportsJobClass.php',
      'to' =>  'custom/Extension/application/Ext/LogicHooks/addScheduledReportsJobClass.php'
    ),
    4 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/ReportSchedules/Ext/Vardefs/uEnhancedSchedulerReportsFields.php',
      'to' =>  'custom/Extension/modules/ReportSchedules/Ext/Vardefs/uEnhancedSchedulerReportsFields.php'
    ),
    5 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/ReportSchedules/Ext/clients/base/views/record/add_fields_to_recordView.php',
      'to' =>  'custom/Extension/modules/ReportSchedules/Ext/clients/base/views/record/add_fields_to_recordView.php'
    ),
    6 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Schedulers/Ext/Language/en_us.wSysRunReportGenerationTasks.php',
      'to' =>  'custom/Extension/modules/Schedulers/Ext/Language/en_us.wSysRunReportGenerationTasks.php'
    ),
    7 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Schedulers/Ext/ScheduledTasks/addWSysRunReportGenerationScheduledTasks.php',
      'to' =>  'custom/Extension/modules/Schedulers/Ext/ScheduledTasks/addWSysRunReportGenerationScheduledTasks.php'
    ),
    8 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/SchedulersJobs/Ext/LogicHooks/wEnhancedScheduledReports.php',
      'to' =>  'custom/Extension/modules/SchedulersJobs/Ext/LogicHooks/wEnhancedScheduledReports.php'
    ),
    9 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/wEnhancedScheduledReportsApi.php',
      'to' =>  'custom/clients/base/api/wEnhancedScheduledReportsApi.php'
    ),
    10 =>     array (
      'from' =>  '<basepath>/custom/include/SugarQueue/jobs/WsystemsSugarJobSendScheduledReport.php',
      'to' =>  'custom/include/SugarQueue/jobs/WsystemsSugarJobSendScheduledReport.php'
    ),
    11 =>     array (
      'from' =>  '<basepath>/custom/include/upcurvecloud/SugarAutoLoaderCustom.php',
      'to' =>  'custom/include/upcurvecloud/SugarAutoLoaderCustom.php'
    ),
    12 =>     array (
      'from' =>  '<basepath>/custom/modules/AddwEnhancedScheduledReportsJobClass.php',
      'to' =>  'custom/modules/AddwEnhancedScheduledReportsJobClass.php'
    ),
    13 =>     array (
      'from' =>  '<basepath>/custom/modules/ReportSchedules/CustomReportSchedule.php',
      'to' =>  'custom/modules/ReportSchedules/CustomReportSchedule.php'
    ),
    14 =>     array (
      'from' =>  '<basepath>/custom/scripts/addWSysRunReportGenerationScheduledTasks.php',
      'to' =>  'custom/scripts/addWSysRunReportGenerationScheduledTasks.php'
    ),
    15 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/JSGroupings/ReportSchedulesShowHideCsvField.js',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/JSGroupings/ReportSchedulesShowHideCsvField.js'
    ),
    16 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/JSGroupings/plugins/component.extend.js',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/JSGroupings/plugins/component.extend.js'
    ),
    17 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/LogicHooks/SchedulersJobsVerboseLoggerHook.php',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/LogicHooks/SchedulersJobsVerboseLoggerHook.php'
    ),
    18 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/Setup/Install.php',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/Setup/Install.php'
    ),
    19 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/Setup/Uninstall.php',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/Setup/Uninstall.php'
    ),
    20 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/Traits/BeanHandlerTrait.php',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/Traits/BeanHandlerTrait.php'
    ),
    21 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wEnhancedScheduledReports/Traits/SugarConfigTrait.php',
      'to' =>  'custom/src/wsystems/wEnhancedScheduledReports/Traits/SugarConfigTrait.php'
    )
  )
);