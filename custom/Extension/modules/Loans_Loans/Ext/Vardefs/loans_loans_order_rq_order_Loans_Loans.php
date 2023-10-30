<?php
// created: 2019-01-10 13:51:45
$dictionary["Loans_Loans"]["fields"]["loans_loans_order_rq_order"] = array (
  'name' => 'loans_loans_order_rq_order',
  'type' => 'link',
  'relationship' => 'loans_loans_order_rq_order',
  'source' => 'non-db',
  'module' => 'Order_RQ_Order',
  'bean_name' => 'Order_RQ_Order',
  'side' => 'right',
  'vname' => 'LBL_LOANS_LOANS_ORDER_RQ_ORDER_FROM_LOANS_LOANS_TITLE',
  'id_name' => 'loans_loans_order_rq_orderorder_rq_order_ida',
  'link-type' => 'one',
);
$dictionary["Loans_Loans"]["fields"]["loans_loans_order_rq_order_name"] = array (
  'name' => 'loans_loans_order_rq_order_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_LOANS_LOANS_ORDER_RQ_ORDER_FROM_ORDER_RQ_ORDER_TITLE',
  'save' => true,
  'id_name' => 'loans_loans_order_rq_orderorder_rq_order_ida',
  'link' => 'loans_loans_order_rq_order',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'name',
);
$dictionary["Loans_Loans"]["fields"]["loans_loans_order_rq_orderorder_rq_order_ida"] = array (
  'name' => 'loans_loans_order_rq_orderorder_rq_order_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_LOANS_LOANS_ORDER_RQ_ORDER_FROM_LOANS_LOANS_TITLE_ID',
  'id_name' => 'loans_loans_order_rq_orderorder_rq_order_ida',
  'link' => 'loans_loans_order_rq_order',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
