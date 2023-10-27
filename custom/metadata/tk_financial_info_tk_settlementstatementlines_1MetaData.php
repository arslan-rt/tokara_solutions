<?php
// created: 2023-10-24 11:31:26
$dictionary["tk_financial_info_tk_settlementstatementlines_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'tk_financial_info_tk_settlementstatementlines_1' => 
    array (
      'lhs_module' => 'tk_Financial_Info',
      'lhs_table' => 'tk_financial_info',
      'lhs_key' => 'id',
      'rhs_module' => 'tk_SettlementStatementLines',
      'rhs_table' => 'tk_settlementstatementlines',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'tk_financial_info_tk_settlementstatementlines_1_c',
      'join_key_lhs' => 'tk_financi1bf3al_info_ida',
      'join_key_rhs' => 'tk_financie485ntlines_idb',
    ),
  ),
  'table' => 'tk_financial_info_tk_settlementstatementlines_1_c',
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
    'tk_financi1bf3al_info_ida' => 
    array (
      'name' => 'tk_financi1bf3al_info_ida',
      'type' => 'id',
    ),
    'tk_financie485ntlines_idb' => 
    array (
      'name' => 'tk_financie485ntlines_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_tk_financial_info_tk_settlementstatementlines_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_tk_financial_info_tk_settlementstatementlines_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'tk_financi1bf3al_info_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_tk_financial_info_tk_settlementstatementlines_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'tk_financie485ntlines_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'tk_financial_info_tk_settlementstatementlines_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'tk_financie485ntlines_idb',
      ),
    ),
  ),
);