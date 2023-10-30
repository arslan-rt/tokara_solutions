<?php
$viewdefs['Order_RQ_Order']['base']['view']['subpanel-for-accountslinkedorders'] = array(
    'type'       => 'subpanel-list',
    'rowactions' => array(
        'actions' => array(
            array(
                'type'       => 'rowaction',
                'css_class'  => 'btn',
                'tooltip'    => 'LBL_PREVIEW',
                'event'      => 'list:preview:fire',
                'icon'       => 'fa-eye',
                'acl_action' => 'view',
                'allow_bwc'  => false,
            ),
        ),
    ),
    'panels'     => array(
        0 => array(
            'name'   => 'panel_header',
            'label'  => 'Linked Orders',
            'fields' => array(
                0 => array(
                    'name'     => 'name',
                    'link'     => true,
                    "enabled"  => true,
                    "default"  => true,
                    "sortable" => false,
                ),
                1 => array(
                    'name'     => 'order_status',
                    'label'    => 'LBL_ORDER_STATUS',
                    "enabled"  => true,
                    "default"  => true,
                    "sortable" => false,
                ),
                2 => array(
                    "name"     => "role_type",
                    "label"    => "Type",
                    "enabled"  => true,
                    "default"  => true,
                    "sortable" => false,
                ),
            ),
        ),
    ),
);
