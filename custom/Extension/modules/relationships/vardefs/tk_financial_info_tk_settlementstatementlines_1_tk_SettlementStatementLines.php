<?php
// created: 2023-10-24 11:31:26
$dictionary["tk_SettlementStatementLines"]["fields"]["tk_financial_info_tk_settlementstatementlines_1"] = array (
  'name' => 'tk_financial_info_tk_settlementstatementlines_1',
  'type' => 'link',
  'relationship' => 'tk_financial_info_tk_settlementstatementlines_1',
  'source' => 'non-db',
  'module' => 'tk_Financial_Info',
  'bean_name' => 'tk_Financial_Info',
  'side' => 'right',
  'vname' => 'LBL_TK_FINANCIAL_INFO_TK_SETTLEMENTSTATEMENTLINES_1_FROM_TK_SETTLEMENTSTATEMENTLINES_TITLE',
  'id_name' => 'tk_financi1bf3al_info_ida',
  'link-type' => 'one',
);
$dictionary["tk_SettlementStatementLines"]["fields"]["tk_financial_info_tk_settlementstatementlines_1_name"] = array (
  'name' => 'tk_financial_info_tk_settlementstatementlines_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_TK_SETTLEMENTSTATEMENTLINES_1_FROM_TK_FINANCIAL_INFO_TITLE',
  'save' => true,
  'id_name' => 'tk_financi1bf3al_info_ida',
  'link' => 'tk_financial_info_tk_settlementstatementlines_1',
  'table' => 'tk_financial_info',
  'module' => 'tk_Financial_Info',
  'rname' => 'name',
);
$dictionary["tk_SettlementStatementLines"]["fields"]["tk_financi1bf3al_info_ida"] = array (
  'name' => 'tk_financi1bf3al_info_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_TK_FINANCIAL_INFO_TK_SETTLEMENTSTATEMENTLINES_1_FROM_TK_SETTLEMENTSTATEMENTLINES_TITLE_ID',
  'id_name' => 'tk_financi1bf3al_info_ida',
  'link' => 'tk_financial_info_tk_settlementstatementlines_1',
  'table' => 'tk_financial_info',
  'module' => 'tk_Financial_Info',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
