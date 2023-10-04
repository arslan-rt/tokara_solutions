<?php

foreach ($js_groupings as $key => $groupings) {
    foreach ($groupings as $file => $target) {
        if ($target == "include/javascript/sugar_grp7.min.js") {
            $js_groupings[$key]["custom/src/wsystems/wEnhancedScheduledReports/JSGroupings/plugins/component.extend.js"]        = "include/javascript/sugar_grp7.min.js";
            $js_groupings[$key]["custom/src/wsystems/wEnhancedScheduledReports/JSGroupings/ReportSchedulesShowHideCsvField.js"] = "include/javascript/sugar_grp7.min.js";
        }

        break;
    }
}
