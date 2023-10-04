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
    0 => '7.*',
    1 => '8.*',
    2 => '9.*',
    3 => '10.*',
    4 => '11.*'
  ),
  'acceptable_sugar_flavors' =>  
  array (

  ),
  'readme' =>  'README.txt',
  'key' =>  'WSYS',
  'author' =>  'Richard Tinca',
  'description' =>  'Improves the mobile application',
  'icon' =>  '',
  'is_uninstallable' =>  true,
  'name' =>  'wMobileApp',
  'published_date' =>  '2021-04-22 18:05:59',
  'type' =>  'module',
  'version' =>  '5.00',
  'remove_tables' =>  'prompt'
);
$installdefs = array (
  'id' =>  'wMobileApp',
  'copy' =>  
  array (
    0 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/JSGroupings/wMobileGroupings.php',
      'to' =>  'custom/Extension/application/Ext/JSGroupings/wMobileGroupings.php'
    ),
    1 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/wMobileApi.php',
      'to' =>  'custom/clients/base/api/wMobileApi.php'
    ),
    2 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/add-checkbox-view-on-inner-list/add-checkbox-view-on-inner-list.hbs',
      'to' =>  'custom/clients/mobile/views/add-checkbox-view-on-inner-list/add-checkbox-view-on-inner-list.hbs'
    ),
    3 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/user-profile/user-profile.hbs',
      'to' =>  'custom/clients/mobile/views/user-profile/user-profile.hbs'
    ),
    4 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/user-profile/user-profile.js',
      'to' =>  'custom/clients/mobile/views/user-profile/user-profile.js'
    ),
    5 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/user-profiles/user-profiles.hbs',
      'to' =>  'custom/clients/mobile/views/user-profiles/user-profiles.hbs'
    ),
    6 =>     array (
      'from' =>  '<basepath>/custom/clients/mobile/views/user-profiles/user-profiles.js',
      'to' =>  'custom/clients/mobile/views/user-profiles/user-profiles.js'
    ),
    7 =>     array (
      'from' =>  '<basepath>/custom/jssource/JSGroupings.php',
      'to' =>  'custom/jssource/JSGroupings.php'
    ),
    8 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/bootLoader/customizationsGenerator/MobileAutoLoader.php',
      'to' =>  'custom/src/wsystems/mobile/bootLoader/customizationsGenerator/MobileAutoLoader.php'
    ),
    9 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileBootLoaderManager.php',
      'to' =>  'custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileBootLoaderManager.php'
    ),
    10 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileCustomizationsHash.php',
      'to' =>  'custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileCustomizationsHash.php'
    ),
    11 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/bootLoader/customizationsLoader/bootLoader.js',
      'to' =>  'custom/src/wsystems/mobile/bootLoader/customizationsLoader/bootLoader.js'
    ),
    12 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/bootLoader/customizationsLoader/wMobileCustomizations.js',
      'to' =>  'custom/src/wsystems/mobile/bootLoader/customizationsLoader/wMobileCustomizations.js'
    ),
    13 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/javascript/wMobileApp/addGoToConfigButton.js',
      'to' =>  'custom/src/wsystems/mobile/include/javascript/wMobileApp/addGoToConfigButton.js'
    ),
    14 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/javascript/wMobileApp/addHeaderViewEvents.js',
      'to' =>  'custom/src/wsystems/mobile/include/javascript/wMobileApp/addHeaderViewEvents.js'
    ),
    15 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/javascript/wMobileApp/addSildeRightListView.js',
      'to' =>  'custom/src/wsystems/mobile/include/javascript/wMobileApp/addSildeRightListView.js'
    ),
    16 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/javascript/wMobileApp/handleSlideGestureBevhaviorRightListView.js',
      'to' =>  'custom/src/wsystems/mobile/include/javascript/wMobileApp/handleSlideGestureBevhaviorRightListView.js'
    ),
    17 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/javascript/wMobileApp/wMobileCustomizationsReloader.js',
      'to' =>  'custom/src/wsystems/mobile/include/javascript/wMobileApp/wMobileCustomizationsReloader.js'
    ),
    18 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/require/wMobileApp/wMobileDashletLoader.js',
      'to' =>  'custom/src/wsystems/mobile/include/require/wMobileApp/wMobileDashletLoader.js'
    ),
    19 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/require/wMobileApp/wMobileEntityLoader.js',
      'to' =>  'custom/src/wsystems/mobile/include/require/wMobileApp/wMobileEntityLoader.js'
    ),
    20 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/require/wMobileApp/wMobileFieldLoader.js',
      'to' =>  'custom/src/wsystems/mobile/include/require/wMobileApp/wMobileFieldLoader.js'
    ),
    21 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/require/wMobileApp/wMobileRouteHandler.js',
      'to' =>  'custom/src/wsystems/mobile/include/require/wMobileApp/wMobileRouteHandler.js'
    ),
    22 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/include/require/wMobileApp/wMobileViewLoader.js',
      'to' =>  'custom/src/wsystems/mobile/include/require/wMobileApp/wMobileViewLoader.js'
    ),
    23 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/widgets/mobileButton/mobileButton.js',
      'to' =>  'custom/src/wsystems/mobile/widgets/mobileButton/mobileButton.js'
    ),
    24 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/widgets/mobileButtonsManager/mobileButtonsContainer.hbs',
      'to' =>  'custom/src/wsystems/mobile/widgets/mobileButtonsManager/mobileButtonsContainer.hbs'
    ),
    25 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/widgets/mobileButtonsManager/mobileButtonsManager.js',
      'to' =>  'custom/src/wsystems/mobile/widgets/mobileButtonsManager/mobileButtonsManager.js'
    ),
    26 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/widgets/mobileMasterButton/mobileMasterButton.hbs',
      'to' =>  'custom/src/wsystems/mobile/widgets/mobileMasterButton/mobileMasterButton.hbs'
    ),
    27 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/widgets/mobileMasterButton/mobileMasterButton.js',
      'to' =>  'custom/src/wsystems/mobile/widgets/mobileMasterButton/mobileMasterButton.js'
    ),
    28 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/mobile/widgets/mobileMasterButton/wSystemsLogo.hbs',
      'to' =>  'custom/src/wsystems/mobile/widgets/mobileMasterButton/wSystemsLogo.hbs'
    )
  )
);