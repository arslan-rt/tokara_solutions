<?php

$viewdefs["base"]["view"]["qualia-admin-panel"] = [
    "template" => "qualia-admin-panel",
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
    ],
    "panels"   => [
        [
            "name"    => "panel_sync_config",
            "label"   => "LBL_QUALIAINTEGRATION_CONFIG_SYNC_CONFIG",
            "labels"  => true,
            "columns" => 2,
            "fields"  => [
                [
                    "name"     => "listing_agent_sales_reps_config",
                    "label"    => "LBL_LISTING_AGENT_SALES_REPS_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
                [
                    "name"     => "selling_agent_sales_reps_config",
                    "label"    => "LBL_SELLING_AGENT_SALES_REPS_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
                [
                    "name"     => "listing_agent_credit_reps_config",
                    "label"    => "LBL_LISTING_AGENT_CREDIT_REPS_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
                [
                    "name"     => "selling_agent_credit_reps_config",
                    "label"    => "LBL_SELLING_AGENT_CREDIT_REPS_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
                [
                    "name"     => "escrow_closer_config",
                    "label"    => "LBL_ESCROW_CLOSER_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
                [
                    "name"     => "title_officer_config",
                    "label"    => "LBL_TITLE_OFFICER_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
                [
                    "name"     => "marketer_config",
                    "label"    => "LBL_MARKETER_CONFIG",
                    "type"     => "text",
                    "view"     => "edit",
                    "default"  => "",
                    "required" => false,
                ],
            ],
        ],
    ],
];
