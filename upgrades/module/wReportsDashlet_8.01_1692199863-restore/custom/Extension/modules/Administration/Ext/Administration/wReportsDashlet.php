<?php

$admin_option_defs = [
    "Administration" => [
        "basic-config" => [
            "Administration",
            "LBL_WREPORTSDASHLET_PANEL_NAME",
            "LBL_WREPORTSDASHLET_PANEL_DESC",
            "javascript:parent.SUGAR.App.router.navigate(\"wReportsDashlet/config\", {trigger: true});",
        ],
    ],
];

$admin_group_header[] = [
    "LBL_WREPORTSDASHLET_PANEL_GROUP_NAME",
    "",
    false,
    $admin_option_defs,
    "LBL_WREPORTSDASHLET_PANEL_GROUP_DESC",
];
