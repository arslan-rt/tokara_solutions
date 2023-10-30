<?php
// created: 2019-01-10 13:51:51
$dictionary["Listg_Listings"]["fields"]["party_rq_party_listg_listings"] = array (
  'name' => 'party_rq_party_listg_listings',
  'type' => 'link',
  'relationship' => 'party_rq_party_listg_listings',
  'source' => 'non-db',
  'module' => 'Party_RQ_Party',
  'bean_name' => 'Party_RQ_Party',
  'side' => 'right',
  'vname' => 'LBL_PARTY_RQ_PARTY_LISTG_LISTINGS_FROM_LISTG_LISTINGS_TITLE',
  'id_name' => 'party_rq_party_listg_listingsparty_rq_party_ida',
  'link-type' => 'one',
);
$dictionary["Listg_Listings"]["fields"]["party_rq_party_listg_listings_name"] = array (
  'name' => 'party_rq_party_listg_listings_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PARTY_RQ_PARTY_LISTG_LISTINGS_FROM_PARTY_RQ_PARTY_TITLE',
  'save' => true,
  'id_name' => 'party_rq_party_listg_listingsparty_rq_party_ida',
  'link' => 'party_rq_party_listg_listings',
  'table' => 'party_rq_party',
  'module' => 'Party_RQ_Party',
  'rname' => 'name',
);
$dictionary["Listg_Listings"]["fields"]["party_rq_party_listg_listingsparty_rq_party_ida"] = array (
  'name' => 'party_rq_party_listg_listingsparty_rq_party_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_PARTY_RQ_PARTY_LISTG_LISTINGS_FROM_LISTG_LISTINGS_TITLE_ID',
  'id_name' => 'party_rq_party_listg_listingsparty_rq_party_ida',
  'link' => 'party_rq_party_listg_listings',
  'table' => 'party_rq_party',
  'module' => 'Party_RQ_Party',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
