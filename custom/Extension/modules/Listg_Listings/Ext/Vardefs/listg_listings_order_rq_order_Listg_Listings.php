<?php
// created: 2019-01-10 13:51:39
$dictionary["Listg_Listings"]["fields"]["listg_listings_order_rq_order"] = array (
  'name' => 'listg_listings_order_rq_order',
  'type' => 'link',
  'relationship' => 'listg_listings_order_rq_order',
  'source' => 'non-db',
  'module' => 'Order_RQ_Order',
  'bean_name' => 'Order_RQ_Order',
  'side' => 'right',
  'vname' => 'LBL_LISTG_LISTINGS_ORDER_RQ_ORDER_FROM_LISTG_LISTINGS_TITLE',
  'id_name' => 'listg_listings_order_rq_orderorder_rq_order_ida',
  'link-type' => 'one',
);
$dictionary["Listg_Listings"]["fields"]["listg_listings_order_rq_order_name"] = array (
  'name' => 'listg_listings_order_rq_order_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_LISTG_LISTINGS_ORDER_RQ_ORDER_FROM_ORDER_RQ_ORDER_TITLE',
  'save' => true,
  'id_name' => 'listg_listings_order_rq_orderorder_rq_order_ida',
  'link' => 'listg_listings_order_rq_order',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'name',
);
$dictionary["Listg_Listings"]["fields"]["listg_listings_order_rq_orderorder_rq_order_ida"] = array (
  'name' => 'listg_listings_order_rq_orderorder_rq_order_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_LISTG_LISTINGS_ORDER_RQ_ORDER_FROM_LISTG_LISTINGS_TITLE_ID',
  'id_name' => 'listg_listings_order_rq_orderorder_rq_order_ida',
  'link' => 'listg_listings_order_rq_order',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
