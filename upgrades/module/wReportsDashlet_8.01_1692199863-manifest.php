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
  'author' =>  'Bogdan Cataron (W-Systems)',
  'description' =>  'Generates a dashlet from a saved report.',
  'icon' =>  '',
  'is_uninstallable' =>  true,
  'name' =>  'wReportsDashlet',
  'published_date' =>  '2023-01-05 13:46:40',
  'type' =>  'module',
  'version' =>  '8.01',
  'remove_tables' =>  'prompt'
);
$installdefs = array (
  'id' =>  'wReportsDashlet',
  'copy' =>  
  array (
    0 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/JSGroupings/wReportsDashlet.php',
      'to' =>  'custom/Extension/application/Ext/JSGroupings/wReportsDashlet.php'
    ),
    1 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.wReportsDashlet.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.wReportsDashlet.php'
    ),
    2 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/wReportsDashlet.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/wReportsDashlet.php'
    ),
    3 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Administration/Ext/Administration/wReportsDashlet.php',
      'to' =>  'custom/Extension/modules/Administration/Ext/Administration/wReportsDashlet.php'
    ),
    4 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Administration/Ext/Language/en_us.wReportsDashlet.php',
      'to' =>  'custom/Extension/modules/Administration/Ext/Language/en_us.wReportsDashlet.php'
    ),
    5 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Reports/Ext/LogicHooks/wReportsDashlet.php',
      'to' =>  'custom/Extension/modules/Reports/Ext/LogicHooks/wReportsDashlet.php'
    ),
    6 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Schedulers/Ext/Language/en_us.wReportsDashlet.php',
      'to' =>  'custom/Extension/modules/Schedulers/Ext/Language/en_us.wReportsDashlet.php'
    ),
    7 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Schedulers/Ext/ScheduledTasks/wReportsDashlet.php',
      'to' =>  'custom/Extension/modules/Schedulers/Ext/ScheduledTasks/wReportsDashlet.php'
    ),
    8 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/wReportsDashletApi.php',
      'to' =>  'custom/clients/base/api/wReportsDashletApi.php'
    ),
    9 =>     array (
      'from' =>  '<basepath>/custom/clients/base/layouts/wreportsdashlet-config/wreportsdashlet-config.php',
      'to' =>  'custom/clients/base/layouts/wreportsdashlet-config/wreportsdashlet-config.php'
    ),
    10 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-grand-total/saved-report-list-grand-total.hbs',
      'to' =>  'custom/clients/base/views/saved-report-list-grand-total/saved-report-list-grand-total.hbs'
    ),
    11 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-grand-total/saved-report-list-grand-total.js',
      'to' =>  'custom/clients/base/views/saved-report-list-grand-total/saved-report-list-grand-total.js'
    ),
    12 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-rows-columns/saved-report-list-rows-columns.hbs',
      'to' =>  'custom/clients/base/views/saved-report-list-rows-columns/saved-report-list-rows-columns.hbs'
    ),
    13 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-rows-columns/saved-report-list-rows-columns.js',
      'to' =>  'custom/clients/base/views/saved-report-list-rows-columns/saved-report-list-rows-columns.js'
    ),
    14 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-summary-details/saved-report-list-summary-details.hbs',
      'to' =>  'custom/clients/base/views/saved-report-list-summary-details/saved-report-list-summary-details.hbs'
    ),
    15 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-summary-details/saved-report-list-summary-details.js',
      'to' =>  'custom/clients/base/views/saved-report-list-summary-details/saved-report-list-summary-details.js'
    ),
    16 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-summary-header/saved-report-list-summary-header.hbs',
      'to' =>  'custom/clients/base/views/saved-report-list-summary-header/saved-report-list-summary-header.hbs'
    ),
    17 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-summary-header/saved-report-list-summary-header.js',
      'to' =>  'custom/clients/base/views/saved-report-list-summary-header/saved-report-list-summary-header.js'
    ),
    18 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-summary-row/saved-report-list-summary-row.hbs',
      'to' =>  'custom/clients/base/views/saved-report-list-summary-row/saved-report-list-summary-row.hbs'
    ),
    19 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-report-list-summary-row/saved-report-list-summary-row.js',
      'to' =>  'custom/clients/base/views/saved-report-list-summary-row/saved-report-list-summary-row.js'
    ),
    20 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-reports-list/saved-reports-list.hbs',
      'to' =>  'custom/clients/base/views/saved-reports-list/saved-reports-list.hbs'
    ),
    21 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-reports-list/saved-reports-list.js',
      'to' =>  'custom/clients/base/views/saved-reports-list/saved-reports-list.js'
    ),
    22 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/saved-reports-list/saved-reports-list.php',
      'to' =>  'custom/clients/base/views/saved-reports-list/saved-reports-list.php'
    ),
    23 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/accordion.wreportsdashlet-config.hbs',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/accordion.wreportsdashlet-config.hbs'
    ),
    24 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/default.wreportsdashlet-config.hbs',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/default.wreportsdashlet-config.hbs'
    ),
    25 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/headerpane.wreportsdashlet-config.hbs',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/headerpane.wreportsdashlet-config.hbs'
    ),
    26 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/horizontal.wreportsdashlet-config.hbs',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/horizontal.wreportsdashlet-config.hbs'
    ),
    27 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/wreportsdashlet-config.hbs',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/wreportsdashlet-config.hbs'
    ),
    28 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/wreportsdashlet-config.js',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/wreportsdashlet-config.js'
    ),
    29 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/wreportsdashlet-config/wreportsdashlet-config.php',
      'to' =>  'custom/clients/base/views/wreportsdashlet-config/wreportsdashlet-config.php'
    ),
    30 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/dashlets/saved-reports-list/saved-reports-list.hbs',
      'to' =>  'custom/clients/mobile/dashlets/saved-reports-list/saved-reports-list.hbs'
    ),
    31 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/dashlets/saved-reports-list/saved-reports-list.js',
      'to' =>  'custom/clients/mobile/dashlets/saved-reports-list/saved-reports-list.js'
    ),
    32 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-grand-total/saved-report-list-grand-total.hbs',
      'to' =>  'custom/clients/mobile/views/saved-report-list-grand-total/saved-report-list-grand-total.hbs'
    ),
    33 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-grand-total/saved-report-list-grand-total.js',
      'to' =>  'custom/clients/mobile/views/saved-report-list-grand-total/saved-report-list-grand-total.js'
    ),
    34 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-rows-columns/saved-report-list-rows-columns.hbs',
      'to' =>  'custom/clients/mobile/views/saved-report-list-rows-columns/saved-report-list-rows-columns.hbs'
    ),
    35 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-rows-columns/saved-report-list-rows-columns.js',
      'to' =>  'custom/clients/mobile/views/saved-report-list-rows-columns/saved-report-list-rows-columns.js'
    ),
    36 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-summary-details/saved-report-list-summary-details.hbs',
      'to' =>  'custom/clients/mobile/views/saved-report-list-summary-details/saved-report-list-summary-details.hbs'
    ),
    37 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-summary-details/saved-report-list-summary-details.js',
      'to' =>  'custom/clients/mobile/views/saved-report-list-summary-details/saved-report-list-summary-details.js'
    ),
    38 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-summary-header/saved-report-list-summary-header.hbs',
      'to' =>  'custom/clients/mobile/views/saved-report-list-summary-header/saved-report-list-summary-header.hbs'
    ),
    39 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-summary-header/saved-report-list-summary-header.js',
      'to' =>  'custom/clients/mobile/views/saved-report-list-summary-header/saved-report-list-summary-header.js'
    ),
    40 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-summary-row/saved-report-list-summary-row.hbs',
      'to' =>  'custom/clients/mobile/views/saved-report-list-summary-row/saved-report-list-summary-row.hbs'
    ),
    41 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/saved-report-list-summary-row/saved-report-list-summary-row.js',
      'to' =>  'custom/clients/mobile/views/saved-report-list-summary-row/saved-report-list-summary-row.js'
    ),
    42 =>     array (
      'from' =>  '<basepath>/custom/include/javascript/wCustomHandleBarsHelpers.js',
      'to' =>  'custom/include/javascript/wCustomHandleBarsHelpers.js'
    ),
    43 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Cache/AbstractCache.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Cache/AbstractCache.php'
    ),
    44 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Cache/None.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Cache/None.php'
    ),
    45 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Cache/Sugar.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Cache/Sugar.php'
    ),
    46 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Cache/Table.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Cache/Table.php'
    ),
    47 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Config.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Config.php'
    ),
    48 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Factory.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Factory.php'
    ),
    49 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/JSGroupings/RegisterRoutes.js',
      'to' =>  'custom/src/wsystems/wReportsDashlet/JSGroupings/RegisterRoutes.js'
    ),
    50 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/JSGroupings/plugins/sidecar.alert.js',
      'to' =>  'custom/src/wsystems/wReportsDashlet/JSGroupings/plugins/sidecar.alert.js'
    ),
    51 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Jobs/ClearReportsCacheJob.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Jobs/ClearReportsCacheJob.php'
    ),
    52 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Jobs/RemoveOutdatedReportsCacheJob.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Jobs/RemoveOutdatedReportsCacheJob.php'
    ),
    53 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/LinkFixManager.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/LinkFixManager.php'
    ),
    54 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/LogicHooks/ReportsHandleSaveHook.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/LogicHooks/ReportsHandleSaveHook.php'
    ),
    55 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Manager.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Manager.php'
    ),
    56 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Runner/AbstractRunner.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Runner/AbstractRunner.php'
    ),
    57 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Runner/Matrix.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Runner/Matrix.php'
    ),
    58 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Runner/RowsAndColumns.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Runner/RowsAndColumns.php'
    ),
    59 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Runner/Summation.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Runner/Summation.php'
    ),
    60 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Runner/SummationWithDetails.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Runner/SummationWithDetails.php'
    ),
    61 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Tables/ReportsCache.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Tables/ReportsCache.php'
    ),
    62 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Traits/BeanHandlerTrait.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Traits/BeanHandlerTrait.php'
    ),
    63 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Traits/ModuleConfigTrait.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Traits/ModuleConfigTrait.php'
    ),
    64 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/wReportsDashlet/Utils/Utils.php',
      'to' =>  'custom/src/wsystems/wReportsDashlet/Utils/Utils.php'
    )
  )
);