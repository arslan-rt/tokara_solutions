<?php

require_once "custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileBootLoaderManager.php";

$bootloaderManager = new wMobileBootLoaderManager();
$customizations    = $bootloaderManager->createCustomizationsFile();

$mobileGrpTarget            = "include/javascript/sugar_grp_mobile.min.js";
$mobileCustomizationsTarget = "custom/src/wsystems/mobile/bootLoader/customizationsLoader/wMobileCustomizations.js";

//Loop through the groupings to find grouping file you want to append to
foreach ($js_groupings as $key => $groupings) {
    foreach ($groupings as $file => $target) {
        //if the target grouping is found
        if ($target === $mobileGrpTarget) {
            //append the custom JavaScript file
            $js_groupings[$key][$mobileCustomizationsTarget] = $mobileGrpTarget;
        }
        break;
    }
}
