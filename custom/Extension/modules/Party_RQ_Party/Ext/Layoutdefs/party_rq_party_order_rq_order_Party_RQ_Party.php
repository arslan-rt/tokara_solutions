<?php
 // created: 2019-01-10 13:51:51
$layout_defs["Party_RQ_Party"]["subpanel_setup"]['party_rq_party_order_rq_order'] = array (
  'order' => 100,
  'module' => 'Order_RQ_Order',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PARTY_RQ_PARTY_ORDER_RQ_ORDER_FROM_ORDER_RQ_ORDER_TITLE',
  'get_subpanel_data' => 'party_rq_party_order_rq_order',
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
