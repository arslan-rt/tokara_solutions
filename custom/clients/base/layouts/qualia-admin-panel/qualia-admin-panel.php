<?php

$viewdefs["base"]["layout"]["qualia-admin-panel"] = [
    "drawer"     => true, // True to render the layout within a drawer
    "adminAcl"   => true, // True to allow only admins to access the layout
    "components" => [
        [
            "layout" => [
                "type"         => "default",
                "name"         => "sidebar",
                "default_hide" => "1", // Default value for hiding the sidepane. `1` to hide, `0` to show.
                "hide_key"     => "qualia-admin-panel", // Key for storing the last state
                "last_state"   => [
                    "id" => "toggle-view", // Part of the key for storing the last state (used in LocalStorage]
                ],
                "components"   => [
                    [
                        "layout" => [
                            "type"       => "base",
                            "name"       => "main-pane",
                            "css_class"  => "main-pane",
                            "components" => [
                                [
                                    "view" => "qualia-admin-panel",
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
