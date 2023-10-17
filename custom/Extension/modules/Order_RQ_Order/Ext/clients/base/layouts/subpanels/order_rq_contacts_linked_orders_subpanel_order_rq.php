<?php
$viewdefs["Order_RQ_Order"]["base"]["layout"]["subpanels"]["components"][] =
    [
    "layout"                      => "subpanel",
    "label"                       => "Linked Contacts",
    "context"                     => [
        "link" => "order_linked_contacts",
    ],
    "override_subpanel_list_view" => "subpanel-for-contactslinkedorders",
    "override_paneltop_view"      => "panel-top-for-contactslinkedorders",
];
