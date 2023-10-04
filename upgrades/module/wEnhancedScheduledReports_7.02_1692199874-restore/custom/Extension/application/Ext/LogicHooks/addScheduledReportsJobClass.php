<?php

$hook_version = 1;

if (!isset($hook_array)) {
    $hook_array = array();
}
if (!isset($hook_array["after_entry_point"])) {
    $hook_array["after_entry_point"] = array();
}

$hook_array["after_entry_point"][] = array(
    13,
    "Add wEnhancedScheduledReports Job class",
    "custom/modules/AddwEnhancedScheduledReportsJobClass.php",
    "AddwEnhancedScheduledReportsJobClass",
    "handle",
);
