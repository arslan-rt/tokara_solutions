<?php
// created: 2019-01-10 13:51:45
$dictionary["Loans_Loans"]["fields"]["loans_loans_party_rq_party"] = array (
  'name' => 'loans_loans_party_rq_party',
  'type' => 'link',
  'relationship' => 'loans_loans_party_rq_party',
  'source' => 'non-db',
  'module' => 'Party_RQ_Party',
  'bean_name' => 'Party_RQ_Party',
  'vname' => 'LBL_LOANS_LOANS_PARTY_RQ_PARTY_FROM_PARTY_RQ_PARTY_TITLE',
  'id_name' => 'loans_loans_party_rq_partyparty_rq_party_idb',
);
$dictionary["Loans_Loans"]["fields"]["loans_loans_party_rq_party_name"] = array (
  'name' => 'loans_loans_party_rq_party_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_LOANS_LOANS_PARTY_RQ_PARTY_FROM_PARTY_RQ_PARTY_TITLE',
  'save' => true,
  'id_name' => 'loans_loans_party_rq_partyparty_rq_party_idb',
  'link' => 'loans_loans_party_rq_party',
  'table' => 'party_rq_party',
  'module' => 'Party_RQ_Party',
  'rname' => 'name',
);
$dictionary["Loans_Loans"]["fields"]["loans_loans_party_rq_partyparty_rq_party_idb"] = array (
  'name' => 'loans_loans_party_rq_partyparty_rq_party_idb',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_LOANS_LOANS_PARTY_RQ_PARTY_FROM_PARTY_RQ_PARTY_TITLE_ID',
  'id_name' => 'loans_loans_party_rq_partyparty_rq_party_idb',
  'link' => 'loans_loans_party_rq_party',
  'table' => 'party_rq_party',
  'module' => 'Party_RQ_Party',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'left',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
