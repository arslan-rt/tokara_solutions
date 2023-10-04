<?php

//Loop through the groupings to find grouping file you want to append to
foreach ($js_groupings as $key => $groupings) {
    foreach ($groupings as $file => $target) {
        //if the target grouping is found
        if ($target == "include/javascript/sugar_grp7.min.js") {
            // Sidecar plugins
            $js_groupings[$key]["custom/src/wsystems/wReportsDashlet/JSGroupings/plugins/sidecar.alert.js"] = "include/javascript/sugar_grp7.min.js";

            // Customizations
            $js_groupings[$key]["custom/include/javascript/wCustomHandleBarsHelpers.js"]             = "include/javascript/sugar_grp7.min.js";
            $js_groupings[$key]["custom/src/wsystems/wReportsDashlet/JSGroupings/RegisterRoutes.js"] = "include/javascript/sugar_grp7.min.js";
        }
        break;
    }
}
