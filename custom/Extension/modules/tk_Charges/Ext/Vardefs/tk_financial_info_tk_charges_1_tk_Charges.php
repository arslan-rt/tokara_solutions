<?php
// created: 2023-10-23 12:36:42
$dictionary["tk_Charges"]["fields"]["tk_financial_info_tk_charges_1"] = array (
  'name' => 'tk_financial_info_tk_charges_1',
  'type' => 'link',
  'relationship' => 'tk_financial_info_tk_charges_1',
  'source' => 'non-db',
  'module' => 'tk_Financial_Info',
  'bean_name' => 'tk_Financial_Info',
  'side' => 'right',
  'vname' => 'LBL_TK_FINANCIAL_INFO_TK_CHARGES_1_FROM_TK_CHARGES_TITLE',
  'id_name' => 'tk_financial_info_tk_charges_1tk_financial_info_ida',
  'link-type' => 'one',
);
$dictionary["tk_Charges"]["fields"]["tk_financial_info_tk_charges_1_name"] = array (
  'name' => 'tk_financial_info_tk_charges_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_TK_CHARGES_1_FROM_TK_FINANCIAL_INFO_TITLE',
  'save' => true,
  'id_name' => 'tk_financial_info_tk_charges_1tk_financial_info_ida',
  'link' => 'tk_financial_info_tk_charges_1',
  'table' => 'tk_financial_info',
  'module' => 'tk_Financial_Info',
  'rname' => 'name',
);
$dictionary["tk_Charges"]["fields"]["tk_financial_info_tk_charges_1tk_financial_info_ida"] = array (
  'name' => 'tk_financial_info_tk_charges_1tk_financial_info_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_TK_CHARGES_1_FROM_TK_CHARGES_TITLE_ID',
  'id_name' => 'tk_financial_info_tk_charges_1tk_financial_info_ida',
  'link' => 'tk_financial_info_tk_charges_1',
  'table' => 'tk_financial_info',
  'module' => 'tk_Financial_Info',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
