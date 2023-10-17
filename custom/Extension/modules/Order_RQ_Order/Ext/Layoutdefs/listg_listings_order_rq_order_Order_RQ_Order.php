<?php
 // created: 2019-01-10 13:51:39
$layout_defs["Order_RQ_Order"]["subpanel_setup"]['listg_listings_order_rq_order'] = array (
  'order' => 100,
  'module' => 'Listg_Listings',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_LISTG_LISTINGS_ORDER_RQ_ORDER_FROM_LISTG_LISTINGS_TITLE',
  'get_subpanel_data' => 'listg_listings_order_rq_order',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
