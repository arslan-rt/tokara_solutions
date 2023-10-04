<?php

$hook_array["after_retrieve"][] = array(
    1,
    "Change the Reports action, in order to access the record in edit mode, by url",
    null,
    "Sugarcrm\\Sugarcrm\\custom\\wsystems\\wReportsDashlet\\LogicHooks\\ReportsHandleSaveHook",
    "handleEdit",
);
