<?php
 // created: 2019-01-10 13:51:45
$layout_defs["Order_RQ_Order"]["subpanel_setup"]['loans_loans_order_rq_order'] = array (
  'order' => 100,
  'module' => 'Loans_Loans',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_LOANS_LOANS_ORDER_RQ_ORDER_FROM_LOANS_LOANS_TITLE',
  'get_subpanel_data' => 'loans_loans_order_rq_order',
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
