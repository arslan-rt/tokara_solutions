<?php
// created: 2023-10-20 17:20:19
$dictionary["tk_financial_info_order_rq_order_1"] = array (
  'true_relationship_type' => 'one-to-one',
  'from_studio' => true,
  'relationships' => 
  array (
    'tk_financial_info_order_rq_order_1' => 
    array (
      'lhs_module' => 'tk_Financial_Info',
      'lhs_table' => 'tk_financial_info',
      'lhs_key' => 'id',
      'rhs_module' => 'Order_RQ_Order',
      'rhs_table' => 'order_rq_order',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'tk_financial_info_order_rq_order_1_c',
      'join_key_lhs' => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
      'join_key_rhs' => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
    ),
  ),
  'table' => 'tk_financial_info_order_rq_order_1_c',
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
    'tk_financial_info_order_rq_order_1tk_financial_info_ida' => 
    array (
      'name' => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
      'type' => 'id',
    ),
    'tk_financial_info_order_rq_order_1order_rq_order_idb' => 
    array (
      'name' => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_tk_financial_info_order_rq_order_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_tk_financial_info_order_rq_order_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'tk_financial_info_order_rq_order_1tk_financial_info_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_tk_financial_info_order_rq_order_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'tk_financial_info_order_rq_order_1order_rq_order_idb',
        1 => 'deleted',
      ),
    ),
  ),
);