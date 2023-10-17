<?php

//Loop through the groupings to find grouping file you want to append to
foreach ($js_groupings as $key => $groupings) {
    foreach ($groupings as $file => $target) {
        //if the target grouping is found
        if ($target == 'include/javascript/sugar_grp7.min.js') {
            //append the custom JavaScript file
            $js_groupings[$key]['custom/include/wsystems/qualiaIntegration/UI/Orders/addNewTabsOnOrder.js'] = $target;

            // Sidecar plugins
            $js_groupings[$key]["custom/src/wsystems/QualiaIntegration/JSGroupings/plugins/sidecar.alert.js"]    = $target;
            $js_groupings[$key]["custom/src/wsystems/QualiaIntegration/JSGroupings/plugins/component.extend.js"] = $target;

            // Customizations
            $js_groupings[$key]["custom/src/wsystems/QualiaIntegration/JSGroupings/RegisterRoutes.js"]             = $target;
            $js_groupings[$key]["custom/src/wsystems/QualiaIntegration/JSGroupings/ContactsFilterSearchResult.js"] = $target;
        }

        break;
    }
}
