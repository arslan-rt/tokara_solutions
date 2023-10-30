<?php
// created: 2018-10-15 11:13:01
$viewdefs['Listg_Listings']['base']['layout']['subpanels']['components'][] =
array(
  'layout'                      => 'subpanel',
  'label'                       => 'Linked Orders',
  'context'                     => array(
    'link' => 'property_linked_orders',
  ),
  'override_subpanel_list_view' => 'subpanel-for-accountslinkedorders',
  'override_paneltop_view'      => 'panel-top-for-accountslinkedorders',
);
