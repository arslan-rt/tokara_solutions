<?php
// created: 2019-01-10 13:51:45
$dictionary["Party_RQ_Party"]["fields"]["loans_loans_party_rq_party"] = array(
  'name'         => 'loans_loans_party_rq_party',
  'type'         => 'link',
  'relationship' => 'loans_loans_party_rq_party',
  'source'       => 'non-db',
  'module'       => 'Loans_Loans',
  'bean_name'    => 'Loans_Loans',
  'vname'        => 'LBL_LOANS_LOANS_PARTY_RQ_PARTY_FROM_LOANS_LOANS_TITLE',
  'id_name'      => 'loans_loans_party_rq_partyloans_loans_ida',
);
$dictionary["Party_RQ_Party"]["fields"]["loans_loans_party_rq_party_name"] = array(
  'name'    => 'loans_loans_party_rq_party_name',
  'type'    => 'relate',
  'source'  => 'non-db',
  'vname'   => 'LBL_LOANS_LOANS_PARTY_RQ_PARTY_FROM_LOANS_LOANS_TITLE',
  'save'    => true,
  'id_name' => 'loans_loans_party_rq_partyloans_loans_ida',
  'link'    => 'loans_loans_party_rq_party',
  'table'   => 'loans_loans',
  'module'  => 'Loans_Loans',
  'rname'   => 'name',
);
$dictionary["Party_RQ_Party"]["fields"]["loans_loans_party_rq_partyloans_loans_ida"] = array(
  'name'            => 'loans_loans_party_rq_partyloans_loans_ida',
  'type'            => 'id',
  'source'          => 'non-db',
  'vname'           => 'LBL_LOANS_LOANS_PARTY_RQ_PARTY_FROM_LOANS_LOANS_TITLE_ID',
  'id_name'         => 'loans_loans_party_rq_partyloans_loans_ida',
  'link'            => 'loans_loans_party_rq_party',
  'table'           => 'loans_loans',
  'module'          => 'Loans_Loans',
  'rname'           => 'id',
  'reportable'      => false,
  'side'            => 'left',
  'massupdate'      => false,
  'duplicate_merge' => 'disabled',
  'hideacl'         => true,
);
