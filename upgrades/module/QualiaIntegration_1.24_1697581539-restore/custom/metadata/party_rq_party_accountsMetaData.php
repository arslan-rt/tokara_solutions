<?php
// created: 2019-01-10 13:51:51
$dictionary["party_rq_party_accounts"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'party_rq_party_accounts' => 
    array (
      'lhs_module' => 'Party_RQ_Party',
      'lhs_table' => 'party_rq_party',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'party_rq_party_accounts_c',
      'join_key_lhs' => 'party_rq_party_accountsparty_rq_party_ida',
      'join_key_rhs' => 'party_rq_party_accountsaccounts_idb',
    ),
  ),
  'table' => 'party_rq_party_accounts_c',
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
    'party_rq_party_accountsparty_rq_party_ida' => 
    array (
      'name' => 'party_rq_party_accountsparty_rq_party_ida',
      'type' => 'id',
    ),
    'party_rq_party_accountsaccounts_idb' => 
    array (
      'name' => 'party_rq_party_accountsaccounts_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_party_rq_party_accounts_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_party_rq_party_accounts_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'party_rq_party_accountsparty_rq_party_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_party_rq_party_accounts_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'party_rq_party_accountsaccounts_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'party_rq_party_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'party_rq_party_accountsparty_rq_party_ida',
        1 => 'party_rq_party_accountsaccounts_idb',
      ),
    ),
  ),
);