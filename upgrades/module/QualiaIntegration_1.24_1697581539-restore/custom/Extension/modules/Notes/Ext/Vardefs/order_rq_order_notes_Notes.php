<?php
$dictionary["Note"]["fields"]["order_rq_order_notes"] = array(
    'name'         => 'order_rq_order_notes',
    'type'         => 'link',
    'relationship' => 'order_rq_order_notes',
    'source'       => 'non-db',
    'module'       => 'Order_RQ_Order',
    'bean_name'    => 'Order_RQ_Order',
    'side'         => 'right',
    'vname'        => 'LBL_ORDER_RQ_ORDER_NOTES_FROM_NOTES_TITLE',
    'id_name'      => 'order_rq_order_notesorder_rq_order_ida',
    'link-type'    => 'one',
);
$dictionary["Note"]["fields"]["order_rq_order_notes_name"] = array(
    'name'    => 'order_rq_order_notes_name',
    'type'    => 'relate',
    'source'  => 'non-db',
    'vname'   => 'LBL_ORDER_RQ_ORDER_NOTES_FROM_ORDER_RQ_ORDER_TITLE',
    'save'    => true,
    'id_name' => 'order_rq_order_notesorder_rq_order_ida',
    'link'    => 'order_rq_order_notes',
    'table'   => 'order_rq_order',
    'module'  => 'Order_RQ_Order',
    'rname'   => 'name',
);
$dictionary["Note"]["fields"]["order_rq_order_notesorder_rq_order_ida"] = array(
    'name'            => 'order_rq_order_notesorder_rq_order_ida',
    'type'            => 'id',
    'source'          => 'non-db',
    'vname'           => 'LBL_ORDER_RQ_ORDER_NOTES_FROM_NOTES_TITLE_ID',
    'id_name'         => 'order_rq_order_notesorder_rq_order_ida',
    'link'            => 'order_rq_order_notes',
    'table'           => 'order_rq_order',
    'module'          => 'Order_RQ_Order',
    'rname'           => 'id',
    'reportable'      => false,
    'side'            => 'right',
    'massupdate'      => false,
    'duplicate_merge' => 'disabled',
    'hideacl'         => true,
);