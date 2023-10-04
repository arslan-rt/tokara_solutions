<?php
 // created: 2019-01-10 13:51:34
$layout_defs["Order_RQ_Order"]["subpanel_setup"]['order_rq_order_documents'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ORDER_RQ_ORDER_DOCUMENTS_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'order_rq_order_documents',
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
