<?php
// created: 2023-10-20 17:20:19
$dictionary["Order_RQ_Order"]["fields"]["tk_financial_info_order_rq_order_1"] = array (
  'name' => 'tk_financial_info_order_rq_order_1',
  'type' => 'link',
  'relationship' => 'tk_financial_info_order_rq_order_1',
  'source' => 'non-db',
  'module' => 'tk_Financial_Info',
  'bean_name' => 'tk_Financial_Info',
  'vname' => 'LBL_TK_FINANCIAL_INFO_ORDER_RQ_ORDER_1_FROM_TK_FINANCIAL_INFO_TITLE',
  'id_name' => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
);
$dictionary["Order_RQ_Order"]["fields"]["tk_financial_info_order_rq_order_1_name"] = array (
  'name' => 'tk_financial_info_order_rq_order_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_ORDER_RQ_ORDER_1_FROM_TK_FINANCIAL_INFO_TITLE',
  'save' => true,
  'id_name' => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
  'link' => 'tk_financial_info_order_rq_order_1',
  'table' => 'tk_financial_info',
  'module' => 'tk_Financial_Info',
  'rname' => 'name',
);
$dictionary["Order_RQ_Order"]["fields"]["tk_financial_info_order_rq_order_1tk_financial_info_ida"] = array (
  'name' => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_ORDER_RQ_ORDER_1_FROM_TK_FINANCIAL_INFO_TITLE_ID',
  'id_name' => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
  'link' => 'tk_financial_info_order_rq_order_1',
  'table' => 'tk_financial_info',
  'module' => 'tk_Financial_Info',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'left',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
