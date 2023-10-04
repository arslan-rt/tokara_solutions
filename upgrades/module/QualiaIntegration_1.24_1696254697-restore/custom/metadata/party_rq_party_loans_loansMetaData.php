<?php
// created: 2019-01-10 13:51:51
$dictionary["party_rq_party_loans_loans"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'party_rq_party_loans_loans' => 
    array (
      'lhs_module' => 'Party_RQ_Party',
      'lhs_table' => 'party_rq_party',
      'lhs_key' => 'id',
      'rhs_module' => 'Loans_Loans',
      'rhs_table' => 'loans_loans',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'party_rq_party_loans_loans_c',
      'join_key_lhs' => 'party_rq_party_loans_loansparty_rq_party_ida',
      'join_key_rhs' => 'party_rq_party_loans_loansloans_loans_idb',
    ),
  ),
  'table' => 'party_rq_party_loans_loans_c',
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
    'party_rq_party_loans_loansparty_rq_party_ida' => 
    array (
      'name' => 'party_rq_party_loans_loansparty_rq_party_ida',
      'type' => 'id',
    ),
    'party_rq_party_loans_loansloans_loans_idb' => 
    array (
      'name' => 'party_rq_party_loans_loansloans_loans_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_party_rq_party_loans_loans_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_party_rq_party_loans_loans_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'party_rq_party_loans_loansparty_rq_party_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_party_rq_party_loans_loans_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'party_rq_party_loans_loansloans_loans_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'party_rq_party_loans_loans_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'party_rq_party_loans_loansparty_rq_party_ida',
        1 => 'party_rq_party_loans_loansloans_loans_idb',
      ),
    ),
  ),
);