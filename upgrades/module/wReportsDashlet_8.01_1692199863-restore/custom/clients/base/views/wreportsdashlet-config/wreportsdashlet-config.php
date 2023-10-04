<?php

$viewdefs["base"]["view"]["wreportsdashlet-config"] = [
    "template" => "wreportsdashlet-config",
    "style"    => "default", // Field alignment style. Can be one of [`horizontal`, `accordion`, `default`]
    "columns"  => 2, // Number of field columns to be displayed per panel
    "buttons"  => [
        [
            "type"      => "button",
            "name"      => "cancel_button",
            "label"     => "LBL_CANCEL_BUTTON_LABEL",
            "css_class" => "btn-invisible btn-link",
            "events"    => [
                "click" => "button:cancel_button:click",
            ],
        ],
        [
            "type"      => "button",
            "name"      => "save_button",
            "label"     => "LBL_SAVE_BUTTON_LABEL",
            "css_class" => "btn btn-primary",
            "icon"      => "fa-save",
            "events"    => [
                "click" => "button:save_button:click",
            ],
        ],
        [
            "name" => "sidebar_toggle",
            "type" => "sidebartoggle",
        ],
    ],
    "panels"   => [
        [
            "name"   => "panel_actions",
            "label"  => "LBL_WREPORTSDASHLET_CONFIG_ACTIONS",
            "header" => true,
            "fields" => [
                [
                    "name"          => "title",
                    "type"          => "label",
                    "default_value" => "LBL_WREPORTSDASHLET_CONFIG_TITLE",
                ],
            ],
        ],
        [
            "name"   => "panel_module_config",
            "label"  => "LBL_WREPORTSDASHLET_SETTINGS",
            "labels" => true,
            "fields" => [
                [
                    "name"    => "use_package_cache",
                    "label"   => "LBL_WREPORTSDASHLET_USE_PACKAGE_CACHE",
                    "type"    => "bool",
                    "view"    => "edit",
                    "default" => true,
                ],
            ],
        ],
    ],
];
