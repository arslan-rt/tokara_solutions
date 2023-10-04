<?php
$viewdefs["Contacts"]["base"]["view"]["subpanel-for-contactslinkedorders"] = array(
    "type"       => "subpanel-list",
    "rowactions" => array(
        "actions" => array(
            array(
                "type"       => "rowaction",
                "css_class"  => "btn",
                "tooltip"    => "LBL_PREVIEW",
                "event"      => "list:preview:fire",
                "icon"       => "fa-eye",
                "acl_action" => "view",
                "allow_bwc"  => false,
            ),
        ),
    ),
    "panels"     => array(
        0 => array(
            "name"   => "panel_header",
            "label"  => "Linked Contacts",
            "fields" => array(
                0 => array(
                    "name"    => "name",
                    "type"    => "fullname",
                    "fields"  => array(
                        "salutation",
                        "first_name",
                        "last_name",
                    ),
                    "link"    => true,
                    "label"   => "LBL_LIST_NAME",
                    "enabled" => true,
                    "default" => true,
                ),
                1 => array(
                    "name"     => "role_type",
                    "label"    => "Type",
                    "enabled"  => true,
                    "default"  => true,
                    "sortable" => false,
                ),
                2 => array(
                    "name"              => "account_name",
                    "target_record_key" => "account_id",
                    "target_module"     => "Accounts",
                    "label"             => "LBL_LIST_ACCOUNT_NAME",
                    "enabled"           => true,
                    "default"           => true,
                ),
                3 => array(
                    "name"    => "email",
                    "label"   => "LBL_LIST_EMAIL",
                    "enabled" => true,
                    "default" => true,
                ),
                5 => array(
                    "name"    => "phone_mobile",
                    "label"   => "LBL_MOBILE_PHONE",
                    "enabled" => true,
                    "default" => true,
                ),
                6 => array(
                    "name"    => "phone_work",
                    "label"   => "LBL_LIST_PHONE",
                    "enabled" => true,
                    "default" => true,
                ),
            ),
        ),
    ),
);
