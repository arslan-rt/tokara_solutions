<?php
// created: 2023-10-20 17:20:19
$dictionary["tk_Financial_Info"]["fields"]["tk_financial_info_order_rq_order_1"] = array (
  'name' => 'tk_financial_info_order_rq_order_1',
  'type' => 'link',
  'relationship' => 'tk_financial_info_order_rq_order_1',
  'source' => 'non-db',
  'module' => 'Order_RQ_Order',
  'bean_name' => 'Order_RQ_Order',
  'vname' => 'LBL_TK_FINANCIAL_INFO_ORDER_RQ_ORDER_1_FROM_ORDER_RQ_ORDER_TITLE',
  'id_name' => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
);
$dictionary["tk_Financial_Info"]["fields"]["tk_financial_info_order_rq_order_1_name"] = array (
  'name' => 'tk_financial_info_order_rq_order_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_ORDER_RQ_ORDER_1_FROM_ORDER_RQ_ORDER_TITLE',
  'save' => true,
  'id_name' => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
  'link' => 'tk_financial_info_order_rq_order_1',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'name',
);
$dictionary["tk_Financial_Info"]["fields"]["tk_financial_info_order_rq_order_1order_rq_order_idb"] = array (
  'name' => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_ORDER_RQ_ORDER_1_FROM_ORDER_RQ_ORDER_TITLE_ID',
  'id_name' => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
  'link' => 'tk_financial_info_order_rq_order_1',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'left',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
