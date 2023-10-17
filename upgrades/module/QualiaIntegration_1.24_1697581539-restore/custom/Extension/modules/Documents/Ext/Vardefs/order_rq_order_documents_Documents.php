<?php
// created: 2019-01-10 13:51:34
$dictionary["Document"]["fields"]["order_rq_order_documents"] = array (
  'name' => 'order_rq_order_documents',
  'type' => 'link',
  'relationship' => 'order_rq_order_documents',
  'source' => 'non-db',
  'module' => 'Order_RQ_Order',
  'bean_name' => 'Order_RQ_Order',
  'side' => 'right',
  'vname' => 'LBL_ORDER_RQ_ORDER_DOCUMENTS_FROM_DOCUMENTS_TITLE',
  'id_name' => 'order_rq_order_documentsorder_rq_order_ida',
  'link-type' => 'one',
);
$dictionary["Document"]["fields"]["order_rq_order_documents_name"] = array (
  'name' => 'order_rq_order_documents_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ORDER_RQ_ORDER_DOCUMENTS_FROM_ORDER_RQ_ORDER_TITLE',
  'save' => true,
  'id_name' => 'order_rq_order_documentsorder_rq_order_ida',
  'link' => 'order_rq_order_documents',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'name',
);
$dictionary["Document"]["fields"]["order_rq_order_documentsorder_rq_order_ida"] = array (
  'name' => 'order_rq_order_documentsorder_rq_order_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_ORDER_RQ_ORDER_DOCUMENTS_FROM_DOCUMENTS_TITLE_ID',
  'id_name' => 'order_rq_order_documentsorder_rq_order_ida',
  'link' => 'order_rq_order_documents',
  'table' => 'order_rq_order',
  'module' => 'Order_RQ_Order',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
