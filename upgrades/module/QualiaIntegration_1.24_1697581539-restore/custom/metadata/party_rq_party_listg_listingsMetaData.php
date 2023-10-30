<?php
// created: 2019-01-10 13:51:51
$dictionary["party_rq_party_listg_listings"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'party_rq_party_listg_listings' => 
    array (
      'lhs_module' => 'Party_RQ_Party',
      'lhs_table' => 'party_rq_party',
      'lhs_key' => 'id',
      'rhs_module' => 'Listg_Listings',
      'rhs_table' => 'listg_listings',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'party_rq_party_listg_listings_c',
      'join_key_lhs' => 'party_rq_party_listg_listingsparty_rq_party_ida',
      'join_key_rhs' => 'party_rq_party_listg_listingslistg_listings_idb',
    ),
  ),
  'table' => 'party_rq_party_listg_listings_c',
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
    'party_rq_party_listg_listingsparty_rq_party_ida' => 
    array (
      'name' => 'party_rq_party_listg_listingsparty_rq_party_ida',
      'type' => 'id',
    ),
    'party_rq_party_listg_listingslistg_listings_idb' => 
    array (
      'name' => 'party_rq_party_listg_listingslistg_listings_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_party_rq_party_listg_listings_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_party_rq_party_listg_listings_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'party_rq_party_listg_listingsparty_rq_party_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_party_rq_party_listg_listings_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'party_rq_party_listg_listingslistg_listings_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'party_rq_party_listg_listings_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'party_rq_party_listg_listingslistg_listings_idb',
      ),
    ),
  ),
);