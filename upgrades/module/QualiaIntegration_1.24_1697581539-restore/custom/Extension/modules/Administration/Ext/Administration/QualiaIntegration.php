<?php

$admin_option_defs = [
    "Administration" => [
        "qualia-admin-panel" => [
            "Administration",
            "LBL_QUALIAINTEGRATION_BASIC_PANEL_NAME",
            "LBL_QUALIAINTEGRATION_BASIC_PANEL_DESC",
            "javascript:parent.SUGAR.App.router.navigate(\"QualiaIntegration/qualia/admin/panel\", {trigger: true});",
        ],
    ],
];

$admin_group_header[] = [
    "LBL_QUALIAINTEGRATION_PANEL_GROUP_NAME",
    "",
    false,
    $admin_option_defs,
    "LBL_QUALIAINTEGRATION_PANEL_GROUP_DESC",
];
