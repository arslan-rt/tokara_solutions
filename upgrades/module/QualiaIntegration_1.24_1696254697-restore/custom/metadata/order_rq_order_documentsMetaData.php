<?php
// created: 2019-01-10 13:51:34
$dictionary["order_rq_order_documents"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'order_rq_order_documents' => 
    array (
      'lhs_module' => 'Order_RQ_Order',
      'lhs_table' => 'order_rq_order',
      'lhs_key' => 'id',
      'rhs_module' => 'Documents',
      'rhs_table' => 'documents',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'order_rq_order_documents_c',
      'join_key_lhs' => 'order_rq_order_documentsorder_rq_order_ida',
      'join_key_rhs' => 'order_rq_order_documentsdocuments_idb',
    ),
  ),
  'table' => 'order_rq_order_documents_c',
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
    'order_rq_order_documentsorder_rq_order_ida' => 
    array (
      'name' => 'order_rq_order_documentsorder_rq_order_ida',
      'type' => 'id',
    ),
    'order_rq_order_documentsdocuments_idb' => 
    array (
      'name' => 'order_rq_order_documentsdocuments_idb',
      'type' => 'id',
    ),
    'document_revision_id' => 
    array (
      'name' => 'document_revision_id',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_order_rq_order_documents_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_order_rq_order_documents_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'order_rq_order_documentsorder_rq_order_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_order_rq_order_documents_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'order_rq_order_documentsdocuments_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'order_rq_order_documents_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'order_rq_order_documentsdocuments_idb',
      ),
    ),
  ),
);