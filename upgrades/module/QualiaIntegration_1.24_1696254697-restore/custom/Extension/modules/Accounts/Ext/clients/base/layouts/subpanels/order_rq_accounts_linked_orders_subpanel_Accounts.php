<?php
$viewdefs['Accounts']['base']['layout']['subpanels']['components'][] =
array(
    'layout'                      => 'subpanel',
    'label'                       => 'Linked Orders',
    'context'                     => array(
        'link' => 'order_rq_order_accounts',
    ),
    'override_subpanel_list_view' => 'subpanel-for-accountslinkedorders',
    'override_paneltop_view'      => 'panel-top-for-accountslinkedorders',
);
