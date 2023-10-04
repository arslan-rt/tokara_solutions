<?php
// created: 2019-01-10 13:51:45
$dictionary["loans_loans_order_rq_order"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'loans_loans_order_rq_order' => 
    array (
      'lhs_module' => 'Order_RQ_Order',
      'lhs_table' => 'order_rq_order',
      'lhs_key' => 'id',
      'rhs_module' => 'Loans_Loans',
      'rhs_table' => 'loans_loans',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'loans_loans_order_rq_order_c',
      'join_key_lhs' => 'loans_loans_order_rq_orderorder_rq_order_ida',
      'join_key_rhs' => 'loans_loans_order_rq_orderloans_loans_idb',
    ),
  ),
  'table' => 'loans_loans_order_rq_order_c',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'type' => 'id',
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'default' => 0,
    ),
    'loans_loans_order_rq_orderorder_rq_order_ida' => 
    array (
      'name' => 'loans_loans_order_rq_orderorder_rq_order_ida',
      'type' => 'id',
    ),
    'loans_loans_order_rq_orderloans_loans_idb' => 
    array (
      'name' => 'loans_loans_order_rq_orderloans_loans_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_loans_loans_order_rq_order_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_loans_loans_order_rq_order_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'loans_loans_order_rq_orderorder_rq_order_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_loans_loans_order_rq_order_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'loans_loans_order_rq_orderloans_loans_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'loans_loans_order_rq_order_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'loans_loans_order_rq_orderloans_loans_idb',
      ),
    ),
  ),
);