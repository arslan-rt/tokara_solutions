<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/
$manifest = array (
  'acceptable_sugar_versions' =>
  array (
    0 => '10.*',
    1 => '11.*',
    2 => '12.*',
    3 => '13.*'
  ),
  'acceptable_sugar_flavors' =>
  array (

  ),
  'readme' =>  'README.txt',
  'key' =>  'WSYS',
  'author' =>  'Terry U',
  'description' =>  '',
  'icon' =>  '',
  'is_uninstallable' =>  true,
  'name' =>  'QualiaIntegration',
  'published_date' =>  '2022-10-07 12:05:07',
  'type' =>  'module',
  'version' =>  '1.24',
  'remove_tables' =>  'prompt'
);
$installdefs = array (
  'post_execute' =>
  array (
    0 => '<basepath>/scripts/post_install.php'
  ),
  'beans' =>
  array (
    0 =>     array (
      'module' =>  'Listg_Listings',
      'class' =>  'Listg_Listings',
      'path' =>  'modules/Listg_Listings/Listg_Listings.php',
      'tab' =>  true
    ),
    1 =>     array (
      'module' =>  'Loans_Loans',
      'class' =>  'Loans_Loans',
      'path' =>  'modules/Loans_Loans/Loans_Loans.php',
      'tab' =>  true
    ),
    2 =>     array (
      'module' =>  'Order_RQ_Order',
      'class' =>  'Order_RQ_Order',
      'path' =>  'modules/Order_RQ_Order/Order_RQ_Order.php',
      'tab' =>  true
    ),
    3 =>     array (
      'module' =>  'Party_RQ_Party',
      'class' =>  'Party_RQ_Party',
      'path' =>  'modules/Party_RQ_Party/Party_RQ_Party.php',
      'tab' =>  true
    )
  ),
  'id' =>  'QualiaIntegration',
  'copy' =>
  array (
    0 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/JSGroupings/QualiaIntegration.php',
      'to' =>  'custom/Extension/application/Ext/JSGroupings/QualiaIntegration.php'
    ),
    1 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ar_SA.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/ar_SA.Loans.php'
    ),
    2 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ar_SA.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/ar_SA.RQ_Order.php'
    ),
    3 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/bg_BG.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/bg_BG.Loans.php'
    ),
    4 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/bg_BG.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/bg_BG.RQ_Order.php'
    ),
    5 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ca_ES.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/ca_ES.Loans.php'
    ),
    6 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ca_ES.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/ca_ES.RQ_Order.php'
    ),
    7 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/cs_CZ.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/cs_CZ.Loans.php'
    ),
    8 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/cs_CZ.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/cs_CZ.RQ_Order.php'
    ),
    9 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/da_DK.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/da_DK.Loans.php'
    ),
    10 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/da_DK.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/da_DK.RQ_Order.php'
    ),
    11 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/de_DE.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/de_DE.Loans.php'
    ),
    12 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/de_DE.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/de_DE.RQ_Order.php'
    ),
    13 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/el_EL.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/el_EL.Loans.php'
    ),
    14 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/el_EL.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/el_EL.RQ_Order.php'
    ),
    15 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_UK.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_UK.Loans.php'
    ),
    16 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_UK.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_UK.RQ_Order.php'
    ),
    17 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.Listings.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.Listings.php'
    ),
    18 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.Loans.php'
    ),
    19 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.QualiaIntegration.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.QualiaIntegration.php'
    ),
    20 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.RQ_Order.php'
    ),
    21 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.RQ_Party.php'
    ),
    22 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us.sugar_parent_type_display.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us.sugar_parent_type_display.php'
    ),
    23 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/en_us_loanterm_list.php',
      'to' =>  'custom/Extension/application/Ext/Language/en_us_loanterm_list.php'
    ),
    24 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/es_ES.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/es_ES.Loans.php'
    ),
    25 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/es_ES.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/es_ES.RQ_Order.php'
    ),
    26 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/es_LA.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/es_LA.Loans.php'
    ),
    27 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/es_LA.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/es_LA.RQ_Order.php'
    ),
    28 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/et_EE.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/et_EE.Loans.php'
    ),
    29 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/et_EE.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/et_EE.RQ_Order.php'
    ),
    30 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/fi_FI.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/fi_FI.Loans.php'
    ),
    31 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/fi_FI.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/fi_FI.RQ_Order.php'
    ),
    32 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/fr_FR.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/fr_FR.Loans.php'
    ),
    33 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/fr_FR.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/fr_FR.RQ_Order.php'
    ),
    34 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/he_IL.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/he_IL.Loans.php'
    ),
    35 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/he_IL.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/he_IL.RQ_Order.php'
    ),
    36 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/hr_HR.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/hr_HR.Loans.php'
    ),
    37 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/hr_HR.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/hr_HR.RQ_Order.php'
    ),
    38 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/hu_HU.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/hu_HU.Loans.php'
    ),
    39 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/hu_HU.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/hu_HU.RQ_Order.php'
    ),
    40 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/it_it.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/it_it.Loans.php'
    ),
    41 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/it_it.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/it_it.RQ_Order.php'
    ),
    42 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ja_JP.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/ja_JP.Loans.php'
    ),
    43 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ja_JP.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/ja_JP.RQ_Order.php'
    ),
    44 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ko_KR.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/ko_KR.Loans.php'
    ),
    45 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ko_KR.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/ko_KR.RQ_Order.php'
    ),
    46 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/lt_LT.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/lt_LT.Loans.php'
    ),
    47 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/lt_LT.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/lt_LT.RQ_Order.php'
    ),
    48 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/lv_LV.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/lv_LV.Loans.php'
    ),
    49 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/lv_LV.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/lv_LV.RQ_Order.php'
    ),
    50 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/nb_NO.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/nb_NO.Loans.php'
    ),
    51 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/nb_NO.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/nb_NO.RQ_Order.php'
    ),
    52 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/nl_NL.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/nl_NL.Loans.php'
    ),
    53 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/nl_NL.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/nl_NL.RQ_Order.php'
    ),
    54 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/pl_PL.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/pl_PL.Loans.php'
    ),
    55 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/pl_PL.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/pl_PL.RQ_Order.php'
    ),
    56 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/pt_BR.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/pt_BR.Loans.php'
    ),
    57 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/pt_BR.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/pt_BR.RQ_Order.php'
    ),
    58 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/pt_PT.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/pt_PT.Loans.php'
    ),
    59 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/pt_PT.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/pt_PT.RQ_Order.php'
    ),
    60 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ro_RO.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/ro_RO.Loans.php'
    ),
    61 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ro_RO.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/ro_RO.RQ_Order.php'
    ),
    62 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ru_RU.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/ru_RU.Loans.php'
    ),
    63 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/ru_RU.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/ru_RU.RQ_Order.php'
    ),
    64 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sk_SK.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/sk_SK.Loans.php'
    ),
    65 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sk_SK.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/sk_SK.RQ_Order.php'
    ),
    66 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sq_AL.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/sq_AL.Loans.php'
    ),
    67 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sq_AL.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/sq_AL.RQ_Order.php'
    ),
    68 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sr_RS.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/sr_RS.Loans.php'
    ),
    69 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sr_RS.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/sr_RS.RQ_Order.php'
    ),
    70 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sv_SE.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/sv_SE.Loans.php'
    ),
    71 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/sv_SE.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/sv_SE.RQ_Order.php'
    ),
    72 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/th_TH.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/th_TH.Loans.php'
    ),
    73 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/th_TH.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/th_TH.RQ_Order.php'
    ),
    74 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/tr_TR.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/tr_TR.Loans.php'
    ),
    75 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/tr_TR.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/tr_TR.RQ_Order.php'
    ),
    76 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/uk_UA.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/uk_UA.Loans.php'
    ),
    77 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/uk_UA.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/uk_UA.RQ_Order.php'
    ),
    78 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/zh_CN.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/zh_CN.Loans.php'
    ),
    79 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/zh_CN.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/zh_CN.RQ_Order.php'
    ),
    80 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/zh_TW.Loans.php',
      'to' =>  'custom/Extension/application/Ext/Language/zh_TW.Loans.php'
    ),
    81 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/Language/zh_TW.RQ_Order.php',
      'to' =>  'custom/Extension/application/Ext/Language/zh_TW.RQ_Order.php'
    ),
    82 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/LogicHooks/QualiaIntegration.php',
      'to' =>  'custom/Extension/application/Ext/LogicHooks/QualiaIntegration.php'
    ),
    83 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/listg_listings_order_rq_order.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/listg_listings_order_rq_order.php'
    ),
    84 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/loans_loans_order_rq_order.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/loans_loans_order_rq_order.php'
    ),
    85 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/loans_loans_party_rq_party.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/loans_loans_party_rq_party.php'
    ),
    86 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/order_rq_order_accounts.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/order_rq_order_accounts.php'
    ),
    87 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/order_rq_order_documents.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/order_rq_order_documents.php'
    ),
    88 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/order_rq_order_notes.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/order_rq_order_notes.php'
    ),
    89 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/party_rq_party_accounts.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/party_rq_party_accounts.php'
    ),
    90 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/party_rq_party_contacts.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/party_rq_party_contacts.php'
    ),
    91 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/party_rq_party_listg_listings.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/party_rq_party_listg_listings.php'
    ),
    92 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/party_rq_party_loans_loans.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/party_rq_party_loans_loans.php'
    ),
    93 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/party_rq_party_order_rq_order.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/party_rq_party_order_rq_order.php'
    ),
    94 =>     array (
      'from' =>  '<basepath>/custom/Extension/application/Ext/TableDictionary/party_rq_party_party_rq_party.php',
      'to' =>  'custom/Extension/application/Ext/TableDictionary/party_rq_party_party_rq_party.php'
    ),
    95 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/AccountsParentLinkedOrders.php',
      'to' =>  'custom/Extension/modules/Accounts/AccountsParentLinkedOrders.php'
    ),
    96 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ar_SA.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ar_SA.RQ_Order.php'
    ),
    97 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ar_SA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ar_SA.RQ_Party.php'
    ),
    98 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/bg_BG.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/bg_BG.RQ_Order.php'
    ),
    99 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/bg_BG.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/bg_BG.RQ_Party.php'
    ),
    100 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ca_ES.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ca_ES.RQ_Order.php'
    ),
    101 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ca_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ca_ES.RQ_Party.php'
    ),
    102 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/cs_CZ.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/cs_CZ.RQ_Order.php'
    ),
    103 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/cs_CZ.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/cs_CZ.RQ_Party.php'
    ),
    104 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/da_DK.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/da_DK.RQ_Order.php'
    ),
    105 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/da_DK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/da_DK.RQ_Party.php'
    ),
    106 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/de_DE.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/de_DE.RQ_Order.php'
    ),
    107 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/de_DE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/de_DE.RQ_Party.php'
    ),
    108 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/el_EL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/el_EL.RQ_Order.php'
    ),
    109 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/el_EL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/el_EL.RQ_Party.php'
    ),
    110 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_UK.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/en_UK.RQ_Order.php'
    ),
    111 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_UK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/en_UK.RQ_Party.php'
    ),
    112 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_us.QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/en_us.QualiaIntegration.php'
    ),
    113 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_us.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/en_us.RQ_Order.php'
    ),
    114 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/en_us.RQ_Party.php'
    ),
    115 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/es_ES.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/es_ES.RQ_Order.php'
    ),
    116 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/es_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/es_ES.RQ_Party.php'
    ),
    117 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/es_LA.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/es_LA.RQ_Order.php'
    ),
    118 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/es_LA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/es_LA.RQ_Party.php'
    ),
    119 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/et_EE.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/et_EE.RQ_Order.php'
    ),
    120 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/et_EE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/et_EE.RQ_Party.php'
    ),
    121 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/fi_FI.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/fi_FI.RQ_Order.php'
    ),
    122 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/fi_FI.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/fi_FI.RQ_Party.php'
    ),
    123 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/fr_FR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/fr_FR.RQ_Order.php'
    ),
    124 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/fr_FR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/fr_FR.RQ_Party.php'
    ),
    125 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/he_IL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/he_IL.RQ_Order.php'
    ),
    126 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/he_IL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/he_IL.RQ_Party.php'
    ),
    127 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/hr_HR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/hr_HR.RQ_Order.php'
    ),
    128 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/hr_HR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/hr_HR.RQ_Party.php'
    ),
    129 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/hu_HU.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/hu_HU.RQ_Order.php'
    ),
    130 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/hu_HU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/hu_HU.RQ_Party.php'
    ),
    131 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/it_it.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/it_it.RQ_Order.php'
    ),
    132 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/it_it.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/it_it.RQ_Party.php'
    ),
    133 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ja_JP.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ja_JP.RQ_Order.php'
    ),
    134 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ja_JP.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ja_JP.RQ_Party.php'
    ),
    135 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ko_KR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ko_KR.RQ_Order.php'
    ),
    136 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ko_KR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ko_KR.RQ_Party.php'
    ),
    137 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/lt_LT.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/lt_LT.RQ_Order.php'
    ),
    138 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/lt_LT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/lt_LT.RQ_Party.php'
    ),
    139 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/lv_LV.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/lv_LV.RQ_Order.php'
    ),
    140 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/lv_LV.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/lv_LV.RQ_Party.php'
    ),
    141 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/nb_NO.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/nb_NO.RQ_Order.php'
    ),
    142 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/nb_NO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/nb_NO.RQ_Party.php'
    ),
    143 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/nl_NL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/nl_NL.RQ_Order.php'
    ),
    144 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/nl_NL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/nl_NL.RQ_Party.php'
    ),
    145 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/pl_PL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/pl_PL.RQ_Order.php'
    ),
    146 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/pl_PL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/pl_PL.RQ_Party.php'
    ),
    147 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/pt_BR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/pt_BR.RQ_Order.php'
    ),
    148 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/pt_BR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/pt_BR.RQ_Party.php'
    ),
    149 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/pt_PT.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/pt_PT.RQ_Order.php'
    ),
    150 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/pt_PT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/pt_PT.RQ_Party.php'
    ),
    151 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ro_RO.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ro_RO.RQ_Order.php'
    ),
    152 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ro_RO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ro_RO.RQ_Party.php'
    ),
    153 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ru_RU.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ru_RU.RQ_Order.php'
    ),
    154 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/ru_RU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/ru_RU.RQ_Party.php'
    ),
    155 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sk_SK.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sk_SK.RQ_Order.php'
    ),
    156 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sk_SK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sk_SK.RQ_Party.php'
    ),
    157 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sq_AL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sq_AL.RQ_Order.php'
    ),
    158 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sq_AL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sq_AL.RQ_Party.php'
    ),
    159 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sr_RS.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sr_RS.RQ_Order.php'
    ),
    160 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sr_RS.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sr_RS.RQ_Party.php'
    ),
    161 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sv_SE.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sv_SE.RQ_Order.php'
    ),
    162 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/sv_SE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/sv_SE.RQ_Party.php'
    ),
    163 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/th_TH.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/th_TH.RQ_Order.php'
    ),
    164 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/th_TH.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/th_TH.RQ_Party.php'
    ),
    165 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/tr_TR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/tr_TR.RQ_Order.php'
    ),
    166 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/tr_TR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/tr_TR.RQ_Party.php'
    ),
    167 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/uk_UA.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/uk_UA.RQ_Order.php'
    ),
    168 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/uk_UA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/uk_UA.RQ_Party.php'
    ),
    169 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/zh_CN.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/zh_CN.RQ_Order.php'
    ),
    170 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/zh_CN.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/zh_CN.RQ_Party.php'
    ),
    171 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/zh_TW.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/zh_TW.RQ_Order.php'
    ),
    172 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Language/zh_TW.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Language/zh_TW.RQ_Party.php'
    ),
    173 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Layoutdefs/order_rq_order_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Layoutdefs/order_rq_order_accounts_Accounts.php'
    ),
    174 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Layoutdefs/party_rq_party_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Layoutdefs/party_rq_party_accounts_Accounts.php'
    ),
    175 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/order_rq_order_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/order_rq_order_accounts_Accounts.php'
    ),
    176 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/party_rq_party_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/party_rq_party_accounts_Accounts.php'
    ),
    177 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/rq_party.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/rq_party.php'
    ),
    178 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_account_qualia_diff_hash.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_account_qualia_diff_hash.php'
    ),
    179 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_account_qualia_unique_hash.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_account_qualia_unique_hash.php'
    ),
    180 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_national_license_id.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_national_license_id.php'
    ),
    181 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_qualia_id_c.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_qualia_id_c.php'
    ),
    182 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_state_license_id.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_state_license_id.php'
    ),
    183 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_state_license_state.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_state_license_state.php'
    ),
    184 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_type.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_type.php'
    ),
    185 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Vardefs/sugarindex_account_qualia_id.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Vardefs/sugarindex_account_qualia_id.php'
    ),
    186 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Wirelesslayoutdefs/order_rq_order_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Wirelesslayoutdefs/order_rq_order_accounts_Accounts.php'
    ),
    187 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/Wirelesslayoutdefs/party_rq_party_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/Wirelesslayoutdefs/party_rq_party_accounts_Accounts.php'
    ),
    188 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/base/filters/default/QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/base/filters/default/QualiaIntegration.php'
    ),
    189 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/base/layouts/subpanels/order_rq_accounts_linked_orders_subpanel_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/base/layouts/subpanels/order_rq_accounts_linked_orders_subpanel_Accounts.php'
    ),
    190 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/base/layouts/subpanels/order_rq_order_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/base/layouts/subpanels/order_rq_order_accounts_Accounts.php'
    ),
    191 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/base/layouts/subpanels/party_rq_party_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/base/layouts/subpanels/party_rq_party_accounts_Accounts.php'
    ),
    192 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/base/views/list/list.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/base/views/list/list.php'
    ),
    193 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/mobile/layouts/subpanels/order_rq_order_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/mobile/layouts/subpanels/order_rq_order_accounts_Accounts.php'
    ),
    194 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/Ext/clients/mobile/layouts/subpanels/party_rq_party_accounts_Accounts.php',
      'to' =>  'custom/Extension/modules/Accounts/Ext/clients/mobile/layouts/subpanels/party_rq_party_accounts_Accounts.php'
    ),
    195 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Accounts/ReferralAccountsOrders.php',
      'to' =>  'custom/Extension/modules/Accounts/ReferralAccountsOrders.php'
    ),
    196 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Administration/Ext/Administration/QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Administration/Ext/Administration/QualiaIntegration.php'
    ),
    197 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Administration/Ext/Language/en_us.QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Administration/Ext/Language/en_us.QualiaIntegration.php'
    ),
    198 =>     array (
      'from' =>  '<basepath>/custom/include/ContactsParentLinkedOrders/ContactsParentLinkedOrders.php',
      'to' =>  'custom/include/ContactsParentLinkedOrders/ContactsParentLinkedOrders.php'
    ),
    199 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/ar_SA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/ar_SA.RQ_Party.php'
    ),
    200 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/bg_BG.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/bg_BG.RQ_Party.php'
    ),
    201 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/ca_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/ca_ES.RQ_Party.php'
    ),
    202 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/cs_CZ.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/cs_CZ.RQ_Party.php'
    ),
    203 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/da_DK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/da_DK.RQ_Party.php'
    ),
    204 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/de_DE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/de_DE.RQ_Party.php'
    ),
    205 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/el_EL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/el_EL.RQ_Party.php'
    ),
    206 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/en_UK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/en_UK.RQ_Party.php'
    ),
    207 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/en_us.QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/en_us.QualiaIntegration.php'
    ),
    208 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/en_us.RQ_Party.php'
    ),
    209 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/es_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/es_ES.RQ_Party.php'
    ),
    210 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/es_LA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/es_LA.RQ_Party.php'
    ),
    211 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/et_EE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/et_EE.RQ_Party.php'
    ),
    212 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/fi_FI.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/fi_FI.RQ_Party.php'
    ),
    213 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/fr_FR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/fr_FR.RQ_Party.php'
    ),
    214 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/he_IL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/he_IL.RQ_Party.php'
    ),
    215 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/hr_HR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/hr_HR.RQ_Party.php'
    ),
    216 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/hu_HU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/hu_HU.RQ_Party.php'
    ),
    217 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/it_it.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/it_it.RQ_Party.php'
    ),
    218 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/ja_JP.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/ja_JP.RQ_Party.php'
    ),
    219 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/ko_KR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/ko_KR.RQ_Party.php'
    ),
    220 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/lt_LT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/lt_LT.RQ_Party.php'
    ),
    221 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/lv_LV.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/lv_LV.RQ_Party.php'
    ),
    222 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/nb_NO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/nb_NO.RQ_Party.php'
    ),
    223 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/nl_NL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/nl_NL.RQ_Party.php'
    ),
    224 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/pl_PL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/pl_PL.RQ_Party.php'
    ),
    225 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/pt_BR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/pt_BR.RQ_Party.php'
    ),
    226 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/pt_PT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/pt_PT.RQ_Party.php'
    ),
    227 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/ro_RO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/ro_RO.RQ_Party.php'
    ),
    228 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/ru_RU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/ru_RU.RQ_Party.php'
    ),
    229 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/sk_SK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/sk_SK.RQ_Party.php'
    ),
    230 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/sq_AL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/sq_AL.RQ_Party.php'
    ),
    231 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/sr_RS.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/sr_RS.RQ_Party.php'
    ),
    232 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/sv_SE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/sv_SE.RQ_Party.php'
    ),
    233 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/th_TH.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/th_TH.RQ_Party.php'
    ),
    234 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/tr_TR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/tr_TR.RQ_Party.php'
    ),
    235 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/uk_UA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/uk_UA.RQ_Party.php'
    ),
    236 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/zh_CN.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/zh_CN.RQ_Party.php'
    ),
    237 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Language/zh_TW.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Language/zh_TW.RQ_Party.php'
    ),
    238 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Layoutdefs/party_rq_party_contacts_Contacts.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Layoutdefs/party_rq_party_contacts_Contacts.php'
    ),
    239 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/contacts_party_rel_def.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/contacts_party_rel_def.php'
    ),
    240 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/party_rq_party_contacts_Contacts.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/party_rq_party_contacts_Contacts.php'
    ),
    241 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_contact_account_link_meta_rq.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_contact_account_link_meta_rq.php'
    ),
    242 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_contacts_linked_orders.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_contacts_linked_orders.php'
    ),
    243 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_filter_related_contacts.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_filter_related_contacts.php'
    ),
    244 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_marital_status.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_marital_status.php'
    ),
    245 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_name_sort_property.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_name_sort_property.php'
    ),
    246 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_national_license_id.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_national_license_id.php'
    ),
    247 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_qualia_diff_hash.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_qualia_diff_hash.php'
    ),
    248 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_qualia_id_c.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_qualia_id_c.php'
    ),
    249 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_qualia_unique_hash.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_qualia_unique_hash.php'
    ),
    250 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_state_license_id.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_state_license_id.php'
    ),
    251 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_state_license_state.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_state_license_state.php'
    ),
    252 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Vardefs/sugarindex_contact_qualia_id.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Vardefs/sugarindex_contact_qualia_id.php'
    ),
    253 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/Wirelesslayoutdefs/party_rq_party_contacts_Contacts.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/Wirelesslayoutdefs/party_rq_party_contacts_Contacts.php'
    ),
    254 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/base/filters/basic/QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/base/filters/basic/QualiaIntegration.php'
    ),
    255 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/base/filters/default/QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/base/filters/default/QualiaIntegration.php'
    ),
    256 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/base/layouts/subpanels/order_rq_contacts_linked_orders_subpanel_Contacts.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/base/layouts/subpanels/order_rq_contacts_linked_orders_subpanel_Contacts.php'
    ),
    257 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/base/views/list/list.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/base/views/list/list.php'
    ),
    258 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/base/views/panel-top-for-contactslinkedorders/panel-top-for-contactslinkedorder.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/base/views/panel-top-for-contactslinkedorders/panel-top-for-contactslinkedorder.php'
    ),
    259 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/base/views/subpanel-for-contactslinkedorders/subpanel-for-contactslinkedorders.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/base/views/subpanel-for-contactslinkedorders/subpanel-for-contactslinkedorders.php'
    ),
    260 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Contacts/Ext/clients/mobile/layouts/subpanels/party_rq_party_contacts_Contacts.php',
      'to' =>  'custom/Extension/modules/Contacts/Ext/clients/mobile/layouts/subpanels/party_rq_party_contacts_Contacts.php'
    ),
    261 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Documents/Ext/Language/en_UK.Order.php',
      'to' =>  'custom/Extension/modules/Documents/Ext/Language/en_UK.Order.php'
    ),
    262 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Documents/Ext/Language/en_us.Order.php',
      'to' =>  'custom/Extension/modules/Documents/Ext/Language/en_us.Order.php'
    ),
    263 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Documents/Ext/Vardefs/order_rq_order_documents_Documents.php',
      'to' =>  'custom/Extension/modules/Documents/Ext/Vardefs/order_rq_order_documents_Documents.php'
    ),
    264 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ar_SA.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ar_SA.Listings.php'
    ),
    265 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ar_SA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ar_SA.RQ_Party.php'
    ),
    266 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/bg_BG.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/bg_BG.Listings.php'
    ),
    267 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/bg_BG.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/bg_BG.RQ_Party.php'
    ),
    268 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ca_ES.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ca_ES.Listings.php'
    ),
    269 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ca_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ca_ES.RQ_Party.php'
    ),
    270 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/cs_CZ.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/cs_CZ.Listings.php'
    ),
    271 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/cs_CZ.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/cs_CZ.RQ_Party.php'
    ),
    272 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/da_DK.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/da_DK.Listings.php'
    ),
    273 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/da_DK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/da_DK.RQ_Party.php'
    ),
    274 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/de_DE.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/de_DE.Listings.php'
    ),
    275 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/de_DE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/de_DE.RQ_Party.php'
    ),
    276 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/el_EL.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/el_EL.Listings.php'
    ),
    277 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/el_EL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/el_EL.RQ_Party.php'
    ),
    278 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/en_UK.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/en_UK.Listings.php'
    ),
    279 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/en_UK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/en_UK.RQ_Party.php'
    ),
    280 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/en_us.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/en_us.Listings.php'
    ),
    281 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/en_us.RQ_Party.php'
    ),
    282 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/es_ES.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/es_ES.Listings.php'
    ),
    283 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/es_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/es_ES.RQ_Party.php'
    ),
    284 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/es_LA.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/es_LA.Listings.php'
    ),
    285 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/es_LA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/es_LA.RQ_Party.php'
    ),
    286 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/et_EE.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/et_EE.Listings.php'
    ),
    287 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/et_EE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/et_EE.RQ_Party.php'
    ),
    288 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/fi_FI.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/fi_FI.Listings.php'
    ),
    289 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/fi_FI.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/fi_FI.RQ_Party.php'
    ),
    290 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/fr_FR.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/fr_FR.Listings.php'
    ),
    291 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/fr_FR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/fr_FR.RQ_Party.php'
    ),
    292 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/he_IL.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/he_IL.Listings.php'
    ),
    293 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/he_IL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/he_IL.RQ_Party.php'
    ),
    294 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/hr_HR.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/hr_HR.Listings.php'
    ),
    295 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/hr_HR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/hr_HR.RQ_Party.php'
    ),
    296 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/hu_HU.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/hu_HU.Listings.php'
    ),
    297 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/hu_HU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/hu_HU.RQ_Party.php'
    ),
    298 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/it_it.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/it_it.Listings.php'
    ),
    299 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/it_it.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/it_it.RQ_Party.php'
    ),
    300 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ja_JP.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ja_JP.Listings.php'
    ),
    301 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ja_JP.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ja_JP.RQ_Party.php'
    ),
    302 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ko_KR.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ko_KR.Listings.php'
    ),
    303 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ko_KR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ko_KR.RQ_Party.php'
    ),
    304 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/lt_LT.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/lt_LT.Listings.php'
    ),
    305 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/lt_LT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/lt_LT.RQ_Party.php'
    ),
    306 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/lv_LV.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/lv_LV.Listings.php'
    ),
    307 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/lv_LV.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/lv_LV.RQ_Party.php'
    ),
    308 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/nb_NO.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/nb_NO.Listings.php'
    ),
    309 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/nb_NO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/nb_NO.RQ_Party.php'
    ),
    310 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/nl_NL.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/nl_NL.Listings.php'
    ),
    311 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/nl_NL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/nl_NL.RQ_Party.php'
    ),
    312 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/pl_PL.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/pl_PL.Listings.php'
    ),
    313 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/pl_PL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/pl_PL.RQ_Party.php'
    ),
    314 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/pt_BR.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/pt_BR.Listings.php'
    ),
    315 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/pt_BR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/pt_BR.RQ_Party.php'
    ),
    316 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/pt_PT.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/pt_PT.Listings.php'
    ),
    317 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/pt_PT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/pt_PT.RQ_Party.php'
    ),
    318 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ro_RO.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ro_RO.Listings.php'
    ),
    319 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ro_RO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ro_RO.RQ_Party.php'
    ),
    320 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ru_RU.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ru_RU.Listings.php'
    ),
    321 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/ru_RU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/ru_RU.RQ_Party.php'
    ),
    322 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sk_SK.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sk_SK.Listings.php'
    ),
    323 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sk_SK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sk_SK.RQ_Party.php'
    ),
    324 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sq_AL.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sq_AL.Listings.php'
    ),
    325 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sq_AL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sq_AL.RQ_Party.php'
    ),
    326 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sr_RS.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sr_RS.Listings.php'
    ),
    327 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sr_RS.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sr_RS.RQ_Party.php'
    ),
    328 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sv_SE.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sv_SE.Listings.php'
    ),
    329 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/sv_SE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/sv_SE.RQ_Party.php'
    ),
    330 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/th_TH.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/th_TH.Listings.php'
    ),
    331 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/th_TH.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/th_TH.RQ_Party.php'
    ),
    332 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/tr_TR.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/tr_TR.Listings.php'
    ),
    333 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/tr_TR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/tr_TR.RQ_Party.php'
    ),
    334 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/uk_UA.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/uk_UA.Listings.php'
    ),
    335 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/uk_UA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/uk_UA.RQ_Party.php'
    ),
    336 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/zh_CN.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/zh_CN.Listings.php'
    ),
    337 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/zh_CN.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/zh_CN.RQ_Party.php'
    ),
    338 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/zh_TW.Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/zh_TW.Listings.php'
    ),
    339 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Language/zh_TW.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Language/zh_TW.RQ_Party.php'
    ),
    340 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Vardefs/listg_listings_order_rq_order_Listg_Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Vardefs/listg_listings_order_rq_order_Listg_Listings.php'
    ),
    341 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Vardefs/party_rq_party_listg_listings_Listg_Listings.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Vardefs/party_rq_party_listg_listings_Listg_Listings.php'
    ),
    342 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Vardefs/rq_party.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Vardefs/rq_party.php'
    ),
    343 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Vardefs/sugarfield_properties_linked_orders.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Vardefs/sugarfield_properties_linked_orders.php'
    ),
    344 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/Vardefs/sugarindex_legal_description.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/Vardefs/sugarindex_legal_description.php'
    ),
    345 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Listg_Listings/Ext/clients/base/layouts/subpanels/order_rq_properties_linked_orders_subpanel_Properties.php',
      'to' =>  'custom/Extension/modules/Listg_Listings/Ext/clients/base/layouts/subpanels/order_rq_properties_linked_orders_subpanel_Properties.php'
    ),
    346 =>     array (
      'from' =>  '<basepath>/custom/include/PropertiesParentLinkedOrders/PropertiesParentLinkedOrders.php',
      'to' =>  'custom/include/PropertiesParentLinkedOrders/PropertiesParentLinkedOrders.php'
    ),
    347 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ar_SA.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ar_SA.Loans.php'
    ),
    348 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ar_SA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ar_SA.RQ_Party.php'
    ),
    349 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/bg_BG.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/bg_BG.Loans.php'
    ),
    350 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/bg_BG.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/bg_BG.RQ_Party.php'
    ),
    351 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ca_ES.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ca_ES.Loans.php'
    ),
    352 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ca_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ca_ES.RQ_Party.php'
    ),
    353 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/cs_CZ.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/cs_CZ.Loans.php'
    ),
    354 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/cs_CZ.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/cs_CZ.RQ_Party.php'
    ),
    355 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/da_DK.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/da_DK.Loans.php'
    ),
    356 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/da_DK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/da_DK.RQ_Party.php'
    ),
    357 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/de_DE.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/de_DE.Loans.php'
    ),
    358 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/de_DE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/de_DE.RQ_Party.php'
    ),
    359 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/el_EL.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/el_EL.Loans.php'
    ),
    360 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/el_EL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/el_EL.RQ_Party.php'
    ),
    361 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/en_UK.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/en_UK.Loans.php'
    ),
    362 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/en_UK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/en_UK.RQ_Party.php'
    ),
    363 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/en_us.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/en_us.Loans.php'
    ),
    364 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/en_us.Loans_Custom_Labels.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/en_us.Loans_Custom_Labels.php'
    ),
    365 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/en_us.RQ_Party.php'
    ),
    366 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/es_ES.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/es_ES.Loans.php'
    ),
    367 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/es_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/es_ES.RQ_Party.php'
    ),
    368 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/es_LA.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/es_LA.Loans.php'
    ),
    369 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/es_LA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/es_LA.RQ_Party.php'
    ),
    370 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/et_EE.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/et_EE.Loans.php'
    ),
    371 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/et_EE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/et_EE.RQ_Party.php'
    ),
    372 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/fi_FI.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/fi_FI.Loans.php'
    ),
    373 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/fi_FI.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/fi_FI.RQ_Party.php'
    ),
    374 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/fr_FR.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/fr_FR.Loans.php'
    ),
    375 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/fr_FR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/fr_FR.RQ_Party.php'
    ),
    376 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/he_IL.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/he_IL.Loans.php'
    ),
    377 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/he_IL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/he_IL.RQ_Party.php'
    ),
    378 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/hr_HR.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/hr_HR.Loans.php'
    ),
    379 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/hr_HR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/hr_HR.RQ_Party.php'
    ),
    380 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/hu_HU.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/hu_HU.Loans.php'
    ),
    381 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/hu_HU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/hu_HU.RQ_Party.php'
    ),
    382 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/it_it.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/it_it.Loans.php'
    ),
    383 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/it_it.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/it_it.RQ_Party.php'
    ),
    384 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ja_JP.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ja_JP.Loans.php'
    ),
    385 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ja_JP.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ja_JP.RQ_Party.php'
    ),
    386 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ko_KR.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ko_KR.Loans.php'
    ),
    387 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ko_KR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ko_KR.RQ_Party.php'
    ),
    388 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/lt_LT.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/lt_LT.Loans.php'
    ),
    389 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/lt_LT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/lt_LT.RQ_Party.php'
    ),
    390 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/lv_LV.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/lv_LV.Loans.php'
    ),
    391 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/lv_LV.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/lv_LV.RQ_Party.php'
    ),
    392 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/nb_NO.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/nb_NO.Loans.php'
    ),
    393 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/nb_NO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/nb_NO.RQ_Party.php'
    ),
    394 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/nl_NL.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/nl_NL.Loans.php'
    ),
    395 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/nl_NL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/nl_NL.RQ_Party.php'
    ),
    396 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/pl_PL.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/pl_PL.Loans.php'
    ),
    397 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/pl_PL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/pl_PL.RQ_Party.php'
    ),
    398 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/pt_BR.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/pt_BR.Loans.php'
    ),
    399 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/pt_BR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/pt_BR.RQ_Party.php'
    ),
    400 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/pt_PT.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/pt_PT.Loans.php'
    ),
    401 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/pt_PT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/pt_PT.RQ_Party.php'
    ),
    402 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ro_RO.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ro_RO.Loans.php'
    ),
    403 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ro_RO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ro_RO.RQ_Party.php'
    ),
    404 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ru_RU.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ru_RU.Loans.php'
    ),
    405 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/ru_RU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/ru_RU.RQ_Party.php'
    ),
    406 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sk_SK.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sk_SK.Loans.php'
    ),
    407 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sk_SK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sk_SK.RQ_Party.php'
    ),
    408 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sq_AL.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sq_AL.Loans.php'
    ),
    409 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sq_AL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sq_AL.RQ_Party.php'
    ),
    410 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sr_RS.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sr_RS.Loans.php'
    ),
    411 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sr_RS.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sr_RS.RQ_Party.php'
    ),
    412 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sv_SE.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sv_SE.Loans.php'
    ),
    413 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/sv_SE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/sv_SE.RQ_Party.php'
    ),
    414 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/th_TH.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/th_TH.Loans.php'
    ),
    415 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/th_TH.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/th_TH.RQ_Party.php'
    ),
    416 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/tr_TR.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/tr_TR.Loans.php'
    ),
    417 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/tr_TR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/tr_TR.RQ_Party.php'
    ),
    418 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/uk_UA.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/uk_UA.Loans.php'
    ),
    419 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/uk_UA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/uk_UA.RQ_Party.php'
    ),
    420 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/zh_CN.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/zh_CN.Loans.php'
    ),
    421 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/zh_CN.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/zh_CN.RQ_Party.php'
    ),
    422 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/zh_TW.Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/zh_TW.Loans.php'
    ),
    423 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Language/zh_TW.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Language/zh_TW.RQ_Party.php'
    ),
    424 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Layoutdefs/party_rq_party_loans_loans_Loans_Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Layoutdefs/party_rq_party_loans_loans_Loans_Loans.php'
    ),
    425 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Vardefs/loans_loans_order_rq_order_Loans_Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Vardefs/loans_loans_order_rq_order_Loans_Loans.php'
    ),
    426 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Vardefs/loans_loans_party_rq_party_Loans_Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Vardefs/loans_loans_party_rq_party_Loans_Loans.php'
    ),
    427 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Vardefs/party_rq_party_loans_loans_Loans_Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Vardefs/party_rq_party_loans_loans_Loans_Loans.php'
    ),
    428 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Vardefs/rq_party.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Vardefs/rq_party.php'
    ),
    429 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Vardefs/sugarfield_loans_linked_orders.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Vardefs/sugarfield_loans_linked_orders.php'
    ),
    430 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/Wirelesslayoutdefs/party_rq_party_loans_loans_Loans_Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/Wirelesslayoutdefs/party_rq_party_loans_loans_Loans_Loans.php'
    ),
    431 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/clients/base/layouts/subpanels/order_rq_properties_linked_orders_subpanel_Properties.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/clients/base/layouts/subpanels/order_rq_properties_linked_orders_subpanel_Properties.php'
    ),
    432 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Loans_Loans/Ext/clients/mobile/layouts/subpanels/party_rq_party_loans_loans_Loans_Loans.php',
      'to' =>  'custom/Extension/modules/Loans_Loans/Ext/clients/mobile/layouts/subpanels/party_rq_party_loans_loans_Loans_Loans.php'
    ),
    433 =>     array (
      'from' =>  '<basepath>/custom/include/LoansParentLinkedOrders/LoansParentLinkedOrders.php',
      'to' =>  'custom/include/LoansParentLinkedOrders/LoansParentLinkedOrders.php'
    ),
    434 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Notes/Ext/Language/en_UK.Order.php',
      'to' =>  'custom/Extension/modules/Notes/Ext/Language/en_UK.Order.php'
    ),
    435 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Notes/Ext/Language/en_us.Order.php',
      'to' =>  'custom/Extension/modules/Notes/Ext/Language/en_us.Order.php'
    ),
    436 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Notes/Ext/Vardefs/order_rq_order_notes_Notes.php',
      'to' =>  'custom/Extension/modules/Notes/Ext/Vardefs/order_rq_order_notes_Notes.php'
    ),
    437 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.Listings.php'
    ),
    438 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.Loans.php'
    ),
    439 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.RQ_Order.php'
    ),
    440 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ar_SA.RQ_Party.php'
    ),
    441 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.Listings.php'
    ),
    442 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.Loans.php'
    ),
    443 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.RQ_Order.php'
    ),
    444 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/bg_BG.RQ_Party.php'
    ),
    445 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.Listings.php'
    ),
    446 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.Loans.php'
    ),
    447 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.RQ_Order.php'
    ),
    448 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ca_ES.RQ_Party.php'
    ),
    449 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.Listings.php'
    ),
    450 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.Loans.php'
    ),
    451 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.RQ_Order.php'
    ),
    452 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/cs_CZ.RQ_Party.php'
    ),
    453 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.Listings.php'
    ),
    454 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.Loans.php'
    ),
    455 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.RQ_Order.php'
    ),
    456 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/da_DK.RQ_Party.php'
    ),
    457 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.Listings.php'
    ),
    458 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.Loans.php'
    ),
    459 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.RQ_Order.php'
    ),
    460 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/de_DE.RQ_Party.php'
    ),
    461 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.Listings.php'
    ),
    462 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.Loans.php'
    ),
    463 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.RQ_Order.php'
    ),
    464 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/el_EL.RQ_Party.php'
    ),
    465 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.Listings.php'
    ),
    466 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.Loans.php'
    ),
    467 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.RQ_Order.php'
    ),
    468 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_UK.RQ_Party.php'
    ),
    469 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.Contacts.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.Contacts.php'
    ),
    470 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.Listings.php'
    ),
    471 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.Loans.php'
    ),
    472 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.RQ_Order.php'
    ),
    473 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.RQ_Party.php'
    ),
    474 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.custom_fields_rq.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.custom_fields_rq.php'
    ),
    475 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.propertyaddress_country_label.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.propertyaddress_country_label.php'
    ),
    476 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.underwriter_label.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/en_us.underwriter_label.php'
    ),
    477 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.Listings.php'
    ),
    478 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.Loans.php'
    ),
    479 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.RQ_Order.php'
    ),
    480 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_ES.RQ_Party.php'
    ),
    481 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.Listings.php'
    ),
    482 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.Loans.php'
    ),
    483 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.RQ_Order.php'
    ),
    484 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/es_LA.RQ_Party.php'
    ),
    485 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.Listings.php'
    ),
    486 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.Loans.php'
    ),
    487 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.RQ_Order.php'
    ),
    488 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/et_EE.RQ_Party.php'
    ),
    489 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.Listings.php'
    ),
    490 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.Loans.php'
    ),
    491 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.RQ_Order.php'
    ),
    492 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fi_FI.RQ_Party.php'
    ),
    493 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.Listings.php'
    ),
    494 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.Loans.php'
    ),
    495 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.RQ_Order.php'
    ),
    496 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/fr_FR.RQ_Party.php'
    ),
    497 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.Listings.php'
    ),
    498 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.Loans.php'
    ),
    499 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.RQ_Order.php'
    ),
    500 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/he_IL.RQ_Party.php'
    ),
    501 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.Listings.php'
    ),
    502 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.Loans.php'
    ),
    503 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.RQ_Order.php'
    ),
    504 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hr_HR.RQ_Party.php'
    ),
    505 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.Listings.php'
    ),
    506 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.Loans.php'
    ),
    507 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.RQ_Order.php'
    ),
    508 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/hu_HU.RQ_Party.php'
    ),
    509 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.Listings.php'
    ),
    510 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.Loans.php'
    ),
    511 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.RQ_Order.php'
    ),
    512 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/it_it.RQ_Party.php'
    ),
    513 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.Listings.php'
    ),
    514 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.Loans.php'
    ),
    515 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.RQ_Order.php'
    ),
    516 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ja_JP.RQ_Party.php'
    ),
    517 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.Listings.php'
    ),
    518 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.Loans.php'
    ),
    519 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.RQ_Order.php'
    ),
    520 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ko_KR.RQ_Party.php'
    ),
    521 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.Listings.php'
    ),
    522 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.Loans.php'
    ),
    523 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.RQ_Order.php'
    ),
    524 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lt_LT.RQ_Party.php'
    ),
    525 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.Listings.php'
    ),
    526 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.Loans.php'
    ),
    527 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.RQ_Order.php'
    ),
    528 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/lv_LV.RQ_Party.php'
    ),
    529 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.Listings.php'
    ),
    530 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.Loans.php'
    ),
    531 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.RQ_Order.php'
    ),
    532 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nb_NO.RQ_Party.php'
    ),
    533 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.Listings.php'
    ),
    534 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.Loans.php'
    ),
    535 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.RQ_Order.php'
    ),
    536 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/nl_NL.RQ_Party.php'
    ),
    537 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.Listings.php'
    ),
    538 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.Loans.php'
    ),
    539 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.RQ_Order.php'
    ),
    540 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pl_PL.RQ_Party.php'
    ),
    541 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.Listings.php'
    ),
    542 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.Loans.php'
    ),
    543 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.RQ_Order.php'
    ),
    544 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_BR.RQ_Party.php'
    ),
    545 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.Listings.php'
    ),
    546 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.Loans.php'
    ),
    547 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.RQ_Order.php'
    ),
    548 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/pt_PT.RQ_Party.php'
    ),
    549 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.Listings.php'
    ),
    550 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.Loans.php'
    ),
    551 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.RQ_Order.php'
    ),
    552 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ro_RO.RQ_Party.php'
    ),
    553 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.Listings.php'
    ),
    554 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.Loans.php'
    ),
    555 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.RQ_Order.php'
    ),
    556 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/ru_RU.RQ_Party.php'
    ),
    557 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.Listings.php'
    ),
    558 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.Loans.php'
    ),
    559 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.RQ_Order.php'
    ),
    560 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sk_SK.RQ_Party.php'
    ),
    561 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.Listings.php'
    ),
    562 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.Loans.php'
    ),
    563 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.RQ_Order.php'
    ),
    564 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sq_AL.RQ_Party.php'
    ),
    565 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.Listings.php'
    ),
    566 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.Loans.php'
    ),
    567 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.RQ_Order.php'
    ),
    568 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sr_RS.RQ_Party.php'
    ),
    569 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.Listings.php'
    ),
    570 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.Loans.php'
    ),
    571 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.RQ_Order.php'
    ),
    572 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/sv_SE.RQ_Party.php'
    ),
    573 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.Listings.php'
    ),
    574 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.Loans.php'
    ),
    575 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.RQ_Order.php'
    ),
    576 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/th_TH.RQ_Party.php'
    ),
    577 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.Listings.php'
    ),
    578 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.Loans.php'
    ),
    579 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.RQ_Order.php'
    ),
    580 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/tr_TR.RQ_Party.php'
    ),
    581 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.Listings.php'
    ),
    582 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.Loans.php'
    ),
    583 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.RQ_Order.php'
    ),
    584 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/uk_UA.RQ_Party.php'
    ),
    585 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.Listings.php'
    ),
    586 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.Loans.php'
    ),
    587 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.RQ_Order.php'
    ),
    588 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_CN.RQ_Party.php'
    ),
    589 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.Listings.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.Listings.php'
    ),
    590 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.Loans.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.Loans.php'
    ),
    591 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.RQ_Order.php'
    ),
    592 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Language/zh_TW.RQ_Party.php'
    ),
    593 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/listg_listings_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/listg_listings_order_rq_order_Order_RQ_Order.php'
    ),
    594 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/loans_loans_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/loans_loans_order_rq_order_Order_RQ_Order.php'
    ),
    595 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/order_rq_order_documents_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/order_rq_order_documents_Order_RQ_Order.php'
    ),
    596 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/order_rq_order_notes_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/order_rq_order_notes_Order_RQ_Order.php'
    ),
    597 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/party_rq_party_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Layoutdefs/party_rq_party_order_rq_order_Order_RQ_Order.php'
    ),
    598 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/listg_listings_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/listg_listings_order_rq_order_Order_RQ_Order.php'
    ),
    599 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/loans_loans_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/loans_loans_order_rq_order_Order_RQ_Order.php'
    ),
    600 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/opened_date_for_order_c.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/opened_date_for_order_c.php'
    ),
    601 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/order_rq_order_accounts_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/order_rq_order_accounts_Order_RQ_Order.php'
    ),
    602 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/order_rq_order_documents_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/order_rq_order_documents_Order_RQ_Order.php'
    ),
    603 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/order_rq_order_notes_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/order_rq_order_notes_Order_RQ_Order.php'
    ),
    604 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/party_rq_party_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/party_rq_party_order_rq_order_Order_RQ_Order.php'
    ),
    605 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_contact_closing_agent_link.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_contact_closing_agent_link.php'
    ),
    606 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_linked_orders_contacts.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_linked_orders_contacts.php'
    ),
    607 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_name.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_name.php'
    ),
    608 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_order_service.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_order_service.php'
    ),
    609 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_ordertype_c.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarfield_ordertype_c.php'
    ),
    610 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarindex_qualia_id.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Vardefs/sugarindex_qualia_id.php'
    ),
    611 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/listg_listings_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/listg_listings_order_rq_order_Order_RQ_Order.php'
    ),
    612 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/loans_loans_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/loans_loans_order_rq_order_Order_RQ_Order.php'
    ),
    613 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/order_rq_order_documents_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/order_rq_order_documents_Order_RQ_Order.php'
    ),
    614 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/order_rq_order_notes_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/order_rq_order_notes_Order_RQ_Order.php'
    ),
    615 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/party_rq_party_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/Wirelesslayoutdefs/party_rq_party_order_rq_order_Order_RQ_Order.php'
    ),
    616 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/listg_listings_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/listg_listings_order_rq_order_Order_RQ_Order.php'
    ),
    617 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/loans_loans_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/loans_loans_order_rq_order_Order_RQ_Order.php'
    ),
    618 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/order_rq_contacts_linked_orders_subpanel_order_rq.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/order_rq_contacts_linked_orders_subpanel_order_rq.php'
    ),
    619 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/order_rq_order_documents_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/order_rq_order_documents_Order_RQ_Order.php'
    ),
    620 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/order_rq_order_notes_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/order_rq_order_notes_Order_RQ_Order.php'
    ),
    621 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/party_rq_party_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/layouts/subpanels/party_rq_party_order_rq_order_Order_RQ_Order.php'
    ),
    622 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/views/panel-top-for-accountslinkedorders/panel-top-for-accountslinkedorders.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/views/panel-top-for-accountslinkedorders/panel-top-for-accountslinkedorders.php'
    ),
    623 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/base/views/subpanel-for-accountslinkedorders/subpanel-for-accountslinkedorders.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/base/views/subpanel-for-accountslinkedorders/subpanel-for-accountslinkedorders.php'
    ),
    624 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/listg_listings_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/listg_listings_order_rq_order_Order_RQ_Order.php'
    ),
    625 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/loans_loans_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/loans_loans_order_rq_order_Order_RQ_Order.php'
    ),
    626 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/order_rq_order_documents_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/order_rq_order_documents_Order_RQ_Order.php'
    ),
    627 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/order_rq_order_notes_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/order_rq_order_notes_Order_RQ_Order.php'
    ),
    628 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/party_rq_party_order_rq_order_Order_RQ_Order.php',
      'to' =>  'custom/Extension/modules/Order_RQ_Order/Ext/clients/mobile/layouts/subpanels/party_rq_party_order_rq_order_Order_RQ_Order.php'
    ),
    629 =>     array (
      'from' =>  '<basepath>/custom/include/OrdersParentLinkedContacts/OrdersParentLinkedContacts.php',
      'to' =>  'custom/include/OrdersParentLinkedContacts/OrdersParentLinkedContacts.php'
    ),
    630 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ar_SA.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ar_SA.Loans.php'
    ),
    631 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ar_SA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ar_SA.RQ_Party.php'
    ),
    632 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/bg_BG.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/bg_BG.Loans.php'
    ),
    633 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/bg_BG.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/bg_BG.RQ_Party.php'
    ),
    634 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ca_ES.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ca_ES.Loans.php'
    ),
    635 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ca_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ca_ES.RQ_Party.php'
    ),
    636 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/cs_CZ.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/cs_CZ.Loans.php'
    ),
    637 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/cs_CZ.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/cs_CZ.RQ_Party.php'
    ),
    638 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/da_DK.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/da_DK.Loans.php'
    ),
    639 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/da_DK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/da_DK.RQ_Party.php'
    ),
    640 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/de_DE.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/de_DE.Loans.php'
    ),
    641 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/de_DE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/de_DE.RQ_Party.php'
    ),
    642 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/el_EL.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/el_EL.Loans.php'
    ),
    643 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/el_EL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/el_EL.RQ_Party.php'
    ),
    644 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/en_UK.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/en_UK.Loans.php'
    ),
    645 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/en_UK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/en_UK.RQ_Party.php'
    ),
    646 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/en_us.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/en_us.Loans.php'
    ),
    647 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/en_us.QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/en_us.QualiaIntegration.php'
    ),
    648 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/en_us.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/en_us.RQ_Party.php'
    ),
    649 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/es_ES.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/es_ES.Loans.php'
    ),
    650 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/es_ES.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/es_ES.RQ_Party.php'
    ),
    651 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/es_LA.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/es_LA.Loans.php'
    ),
    652 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/es_LA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/es_LA.RQ_Party.php'
    ),
    653 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/et_EE.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/et_EE.Loans.php'
    ),
    654 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/et_EE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/et_EE.RQ_Party.php'
    ),
    655 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/fi_FI.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/fi_FI.Loans.php'
    ),
    656 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/fi_FI.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/fi_FI.RQ_Party.php'
    ),
    657 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/fr_FR.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/fr_FR.Loans.php'
    ),
    658 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/fr_FR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/fr_FR.RQ_Party.php'
    ),
    659 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/he_IL.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/he_IL.Loans.php'
    ),
    660 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/he_IL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/he_IL.RQ_Party.php'
    ),
    661 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/hr_HR.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/hr_HR.Loans.php'
    ),
    662 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/hr_HR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/hr_HR.RQ_Party.php'
    ),
    663 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/hu_HU.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/hu_HU.Loans.php'
    ),
    664 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/hu_HU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/hu_HU.RQ_Party.php'
    ),
    665 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/it_it.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/it_it.Loans.php'
    ),
    666 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/it_it.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/it_it.RQ_Party.php'
    ),
    667 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ja_JP.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ja_JP.Loans.php'
    ),
    668 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ja_JP.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ja_JP.RQ_Party.php'
    ),
    669 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ko_KR.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ko_KR.Loans.php'
    ),
    670 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ko_KR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ko_KR.RQ_Party.php'
    ),
    671 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/lt_LT.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/lt_LT.Loans.php'
    ),
    672 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/lt_LT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/lt_LT.RQ_Party.php'
    ),
    673 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/lv_LV.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/lv_LV.Loans.php'
    ),
    674 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/lv_LV.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/lv_LV.RQ_Party.php'
    ),
    675 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/nb_NO.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/nb_NO.Loans.php'
    ),
    676 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/nb_NO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/nb_NO.RQ_Party.php'
    ),
    677 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/nl_NL.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/nl_NL.Loans.php'
    ),
    678 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/nl_NL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/nl_NL.RQ_Party.php'
    ),
    679 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/pl_PL.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/pl_PL.Loans.php'
    ),
    680 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/pl_PL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/pl_PL.RQ_Party.php'
    ),
    681 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_BR.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_BR.Loans.php'
    ),
    682 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_BR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_BR.RQ_Party.php'
    ),
    683 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_PT.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_PT.Loans.php'
    ),
    684 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_PT.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/pt_PT.RQ_Party.php'
    ),
    685 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ro_RO.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ro_RO.Loans.php'
    ),
    686 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ro_RO.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ro_RO.RQ_Party.php'
    ),
    687 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ru_RU.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ru_RU.Loans.php'
    ),
    688 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/ru_RU.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/ru_RU.RQ_Party.php'
    ),
    689 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sk_SK.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sk_SK.Loans.php'
    ),
    690 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sk_SK.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sk_SK.RQ_Party.php'
    ),
    691 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sq_AL.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sq_AL.Loans.php'
    ),
    692 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sq_AL.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sq_AL.RQ_Party.php'
    ),
    693 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sr_RS.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sr_RS.Loans.php'
    ),
    694 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sr_RS.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sr_RS.RQ_Party.php'
    ),
    695 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sv_SE.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sv_SE.Loans.php'
    ),
    696 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/sv_SE.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/sv_SE.RQ_Party.php'
    ),
    697 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/th_TH.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/th_TH.Loans.php'
    ),
    698 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/th_TH.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/th_TH.RQ_Party.php'
    ),
    699 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/tr_TR.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/tr_TR.Loans.php'
    ),
    700 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/tr_TR.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/tr_TR.RQ_Party.php'
    ),
    701 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/uk_UA.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/uk_UA.Loans.php'
    ),
    702 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/uk_UA.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/uk_UA.RQ_Party.php'
    ),
    703 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_CN.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_CN.Loans.php'
    ),
    704 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_CN.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_CN.RQ_Party.php'
    ),
    705 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_TW.Loans.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_TW.Loans.php'
    ),
    706 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_TW.RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Language/zh_TW.RQ_Party.php'
    ),
    707 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_accounts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_accounts_Party_RQ_Party.php'
    ),
    708 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_contacts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_contacts_Party_RQ_Party.php'
    ),
    709 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_listg_listings_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_listg_listings_Party_RQ_Party.php'
    ),
    710 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_loans_loans_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_loans_loans_Party_RQ_Party.php'
    ),
    711 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_order_rq_order_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_order_rq_order_Party_RQ_Party.php'
    ),
    712 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_party_rq_party_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Layoutdefs/party_rq_party_party_rq_party_Party_RQ_Party.php'
    ),
    713 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/loans_loans_party_rq_party_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/loans_loans_party_rq_party_Party_RQ_Party.php'
    ),
    714 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_accounts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_accounts_Party_RQ_Party.php'
    ),
    715 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_contacts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_contacts_Party_RQ_Party.php'
    ),
    716 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_listg_listings_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_listg_listings_Party_RQ_Party.php'
    ),
    717 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_loans_loans_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_loans_loans_Party_RQ_Party.php'
    ),
    718 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_order_rq_order_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_order_rq_order_Party_RQ_Party.php'
    ),
    719 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_party_rq_party_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/party_rq_party_party_rq_party_Party_RQ_Party.php'
    ),
    720 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarfield_parent_party_type.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarfield_parent_party_type.php'
    ),
    721 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarfield_qualia_id_c.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarfield_qualia_id_c.php'
    ),
    722 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarfield_qualia_parent_role.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarfield_qualia_parent_role.php'
    ),
    723 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_name.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_name.php'
    ),
    724 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_party_parent.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_party_parent.php'
    ),
    725 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_party_type.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_party_type.php'
    ),
    726 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_qualia_unique_hash.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Vardefs/sugarindex_qualia_unique_hash.php'
    ),
    727 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_accounts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_accounts_Party_RQ_Party.php'
    ),
    728 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_contacts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_contacts_Party_RQ_Party.php'
    ),
    729 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_listg_listings_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_listg_listings_Party_RQ_Party.php'
    ),
    730 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_loans_loans_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_loans_loans_Party_RQ_Party.php'
    ),
    731 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_order_rq_order_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_order_rq_order_Party_RQ_Party.php'
    ),
    732 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_party_rq_party_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/Wirelesslayoutdefs/party_rq_party_party_rq_party_Party_RQ_Party.php'
    ),
    733 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_accounts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_accounts_Party_RQ_Party.php'
    ),
    734 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_contacts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_contacts_Party_RQ_Party.php'
    ),
    735 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_listg_listings_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_listg_listings_Party_RQ_Party.php'
    ),
    736 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_loans_loans_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_loans_loans_Party_RQ_Party.php'
    ),
    737 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_order_rq_order_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_order_rq_order_Party_RQ_Party.php'
    ),
    738 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_party_rq_party_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/base/layouts/subpanels/party_rq_party_party_rq_party_Party_RQ_Party.php'
    ),
    739 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_accounts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_accounts_Party_RQ_Party.php'
    ),
    740 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_contacts_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_contacts_Party_RQ_Party.php'
    ),
    741 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_listg_listings_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_listg_listings_Party_RQ_Party.php'
    ),
    742 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_loans_loans_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_loans_loans_Party_RQ_Party.php'
    ),
    743 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_order_rq_order_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_order_rq_order_Party_RQ_Party.php'
    ),
    744 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_party_rq_party_Party_RQ_Party.php',
      'to' =>  'custom/Extension/modules/Party_RQ_Party/Ext/clients/mobile/layouts/subpanels/party_rq_party_party_rq_party_Party_RQ_Party.php'
    ),
    745 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Schedulers/Ext/Language/en_us.QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Schedulers/Ext/Language/en_us.QualiaIntegration.php'
    ),
    746 =>     array (
      'from' =>  '<basepath>/custom/Extension/modules/Schedulers/Ext/ScheduledTasks/QualiaIntegration.php',
      'to' =>  'custom/Extension/modules/Schedulers/Ext/ScheduledTasks/QualiaIntegration.php'
    ),
    747 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/QualiaApi.php',
      'to' =>  'custom/clients/base/api/QualiaApi.php'
    ),
    748 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/QualiaConfigApi.php',
      'to' =>  'custom/clients/base/api/QualiaConfigApi.php'
    ),
    749 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/QualiaCustomRelateApiForContacts.php',
      'to' =>  'custom/clients/base/api/QualiaCustomRelateApiForContacts.php'
    ),
    750 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/QualiaCustomRelateApiForOrderRQ.php',
      'to' =>  'custom/clients/base/api/QualiaCustomRelateApiForOrderRQ.php'
    ),
    751 =>     array (
      'from' =>  '<basepath>/custom/clients/base/api/QualiaPartiesCollectionData.php',
      'to' =>  'custom/clients/base/api/QualiaPartiesCollectionData.php'
    ),
    752 =>     array (
      'from' =>  '<basepath>/custom/clients/base/layouts/qualia-admin-panel/qualia-admin-panel.php',
      'to' =>  'custom/clients/base/layouts/qualia-admin-panel/qualia-admin-panel.php'
    ),
    753 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent/party-agent.hbs',
      'to' =>  'custom/clients/base/views/party-agent/party-agent.hbs'
    ),
    754 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent/party-agent.js',
      'to' =>  'custom/clients/base/views/party-agent/party-agent.js'
    ),
    755 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact/party-agent-contact.js',
      'to' =>  'custom/clients/base/views/party-agent-contact/party-agent-contact.js'
    ),
    756 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-borrower/party-agent-contact-borrower.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-borrower/party-agent-contact-borrower.js'
    ),
    757 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-borrower-seller/party-agent-contact-borrower-seller.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-borrower-seller/party-agent-contact-borrower-seller.js'
    ),
    758 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company/party-agent-contact-company.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company/party-agent-contact-company.js'
    ),
    759 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-lender/party-agent-contact-company-lender.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-lender/party-agent-contact-company-lender.js'
    ),
    760 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-listing-agencies/party-agent-contact-company-listing-agencies.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-listing-agencies/party-agent-contact-company-listing-agencies.js'
    ),
    761 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-mortgage-brokerages/party-agent-contact-company-mortgage-brokerages.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-mortgage-brokerages/party-agent-contact-company-mortgage-brokerages.js'
    ),
    762 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-other-contacts/party-agent-contact-company-other-contacts.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-other-contacts/party-agent-contact-company-other-contacts.js'
    ),
    763 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-recording-offices/party-agent-contact-company-recording-offices.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-recording-offices/party-agent-contact-company-recording-offices.js'
    ),
    764 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-selling-agencies/party-agent-contact-company-selling-agencies.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-selling-agencies/party-agent-contact-company-selling-agencies.js'
    ),
    765 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-settlement-agencies/party-agent-contact-company-settlement-agencies.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-settlement-agencies/party-agent-contact-company-settlement-agencies.js'
    ),
    766 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-surveying-firms/party-agent-contact-company-surveying-firms.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-surveying-firms/party-agent-contact-company-surveying-firms.js'
    ),
    767 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-tax-authorities/party-agent-contact-company-tax-authorities.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-tax-authorities/party-agent-contact-company-tax-authorities.js'
    ),
    768 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-title-abstractors/party-agent-contact-company-title-abstractors.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-title-abstractors/party-agent-contact-company-title-abstractors.js'
    ),
    769 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-title-companies/party-agent-contact-company-title-companies.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-title-companies/party-agent-contact-company-title-companies.js'
    ),
    770 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-company-underwriters/party-agent-contact-company-underwriters.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-company-underwriters/party-agent-contact-company-underwriters.js'
    ),
    771 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-seller/party-agent-contact-seller.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-seller/party-agent-contact-seller.js'
    ),
    772 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-settlement-team/party-agent-contact-settlement-team.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-settlement-team/party-agent-contact-settlement-team.js'
    ),
    773 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-agent-contact-source-of-business/party-agent-contact-source-of-business.js',
      'to' =>  'custom/clients/base/views/party-agent-contact-source-of-business/party-agent-contact-source-of-business.js'
    ),
    774 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-loan/party-loan.js',
      'to' =>  'custom/clients/base/views/party-loan/party-loan.js'
    ),
    775 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-panel/party-panel.hbs',
      'to' =>  'custom/clients/base/views/party-panel/party-panel.hbs'
    ),
    776 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-panel/party-panel.js',
      'to' =>  'custom/clients/base/views/party-panel/party-panel.js'
    ),
    777 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/party-property/party-property.js',
      'to' =>  'custom/clients/base/views/party-property/party-property.js'
    ),
    778 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/qualia-admin-panel/default.qualia-admin-panel.hbs',
      'to' =>  'custom/clients/base/views/qualia-admin-panel/default.qualia-admin-panel.hbs'
    ),
    779 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/qualia-admin-panel/headerpane.qualia-admin-panel.hbs',
      'to' =>  'custom/clients/base/views/qualia-admin-panel/headerpane.qualia-admin-panel.hbs'
    ),
    780 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/qualia-admin-panel/qualia-admin-panel.hbs',
      'to' =>  'custom/clients/base/views/qualia-admin-panel/qualia-admin-panel.hbs'
    ),
    781 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/qualia-admin-panel/qualia-admin-panel.js',
      'to' =>  'custom/clients/base/views/qualia-admin-panel/qualia-admin-panel.js'
    ),
    782 =>     array (
      'from' =>  '<basepath>/custom/clients/base/views/qualia-admin-panel/qualia-admin-panel.php',
      'to' =>  'custom/clients/base/views/qualia-admin-panel/qualia-admin-panel.php'
    ),
    783 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContacts.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContacts.php'
    ),
    784 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsCreateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsCreateTrait.php'
    ),
    785 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsHelperTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsHelperTrait.php'
    ),
    786 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsManager.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsManager.php'
    ),
    787 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsUpdateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/AccountForContacts/AccountForContactsUpdateTrait.php'
    ),
    788 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/Contacts.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/Contacts.php'
    ),
    789 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsCreateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsCreateTrait.php'
    ),
    790 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsHelperTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsHelperTrait.php'
    ),
    791 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsManager.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsManager.php'
    ),
    792 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsUpdateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Contacts/ContactsUpdateTrait.php'
    ),
    793 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/Loans.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/Loans.php'
    ),
    794 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansCreateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansCreateTrait.php'
    ),
    795 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansHelperTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansHelperTrait.php'
    ),
    796 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansManager.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansManager.php'
    ),
    797 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansUpdateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Loans/LoansUpdateTrait.php'
    ),
    798 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/Property.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/Property.php'
    ),
    799 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyCreateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyCreateTrait.php'
    ),
    800 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyHelperTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyHelperTrait.php'
    ),
    801 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyManager.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyManager.php'
    ),
    802 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyUpdateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/Property/PropertyUpdateTrait.php'
    ),
    803 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeam.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeam.php'
    ),
    804 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamCreateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamCreateTrait.php'
    ),
    805 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamHelperTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamHelperTrait.php'
    ),
    806 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamManager.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamManager.php'
    ),
    807 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamUpdateTrait.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/Children/SettlementTeam/SettlementTeamUpdateTrait.php'
    ),
    808 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/CreateNewOrder.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/CreateNewOrder.php'
    ),
    809 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/UpdateExistingOrder.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/Actions/UpdateExistingOrder.php'
    ),
    810 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/OrderCore.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/OrderCore.php'
    ),
    811 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/ProcessOrders.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/ReceiveMessages/modules/orders/ProcessOrders.php'
    ),
    812 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/UI/Orders/addNewTabsOnOrder.js',
      'to' =>  'custom/include/wsystems/qualiaIntegration/UI/Orders/addNewTabsOnOrder.js'
    ),
    813 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/QualiaArrayUtils.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/QualiaArrayUtils.php'
    ),
    814 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/QualiaBeanUtils.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/QualiaBeanUtils.php'
    ),
    815 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/QualiaGlobalVariables.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/QualiaGlobalVariables.php'
    ),
    816 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/QualiaSimpleUtils.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/QualiaSimpleUtils.php'
    ),
    817 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/QualiaTraitsUtils.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/QualiaTraitsUtils.php'
    ),
    818 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/Queries.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/Queries.php'
    ),
    819 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/StringUtils.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/StringUtils.php'
    ),
    820 =>     array (
      'from' =>  '<basepath>/custom/include/wsystems/qualiaIntegration/Utils/TimeDateUtils.php',
      'to' =>  'custom/include/wsystems/qualiaIntegration/Utils/TimeDateUtils.php'
    ),
    821 =>     array (
      'from' =>  '<basepath>/custom/metadata/listg_listings_order_rq_orderMetaData.php',
      'to' =>  'custom/metadata/listg_listings_order_rq_orderMetaData.php'
    ),
    822 =>     array (
      'from' =>  '<basepath>/custom/metadata/loans_loans_order_rq_orderMetaData.php',
      'to' =>  'custom/metadata/loans_loans_order_rq_orderMetaData.php'
    ),
    823 =>     array (
      'from' =>  '<basepath>/custom/metadata/loans_loans_party_rq_partyMetaData.php',
      'to' =>  'custom/metadata/loans_loans_party_rq_partyMetaData.php'
    ),
    824 =>     array (
      'from' =>  '<basepath>/custom/metadata/order_rq_order_accountsMetaData.php',
      'to' =>  'custom/metadata/order_rq_order_accountsMetaData.php'
    ),
    825 =>     array (
      'from' =>  '<basepath>/custom/metadata/order_rq_order_documentsMetaData.php',
      'to' =>  'custom/metadata/order_rq_order_documentsMetaData.php'
    ),
    826 =>     array (
      'from' =>  '<basepath>/custom/metadata/order_rq_order_notesMetaData.php',
      'to' =>  'custom/metadata/order_rq_order_notesMetaData.php'
    ),
    827 =>     array (
      'from' =>  '<basepath>/custom/metadata/party_rq_party_accountsMetaData.php',
      'to' =>  'custom/metadata/party_rq_party_accountsMetaData.php'
    ),
    828 =>     array (
      'from' =>  '<basepath>/custom/metadata/party_rq_party_contactsMetaData.php',
      'to' =>  'custom/metadata/party_rq_party_contactsMetaData.php'
    ),
    829 =>     array (
      'from' =>  '<basepath>/custom/metadata/party_rq_party_listg_listingsMetaData.php',
      'to' =>  'custom/metadata/party_rq_party_listg_listingsMetaData.php'
    ),
    830 =>     array (
      'from' =>  '<basepath>/custom/metadata/party_rq_party_loans_loansMetaData.php',
      'to' =>  'custom/metadata/party_rq_party_loans_loansMetaData.php'
    ),
    831 =>     array (
      'from' =>  '<basepath>/custom/metadata/party_rq_party_order_rq_orderMetaData.php',
      'to' =>  'custom/metadata/party_rq_party_order_rq_orderMetaData.php'
    ),
    832 =>     array (
      'from' =>  '<basepath>/custom/metadata/party_rq_party_party_rq_partyMetaData.php',
      'to' =>  'custom/metadata/party_rq_party_party_rq_partyMetaData.php'
    ),
    833 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/JSGroupings/ContactsFilterSearchResult.js',
      'to' =>  'custom/src/wsystems/QualiaIntegration/JSGroupings/ContactsFilterSearchResult.js'
    ),
    834 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/JSGroupings/RegisterRoutes.js',
      'to' =>  'custom/src/wsystems/QualiaIntegration/JSGroupings/RegisterRoutes.js'
    ),
    835 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/JSGroupings/plugins/component.extend.js',
      'to' =>  'custom/src/wsystems/QualiaIntegration/JSGroupings/plugins/component.extend.js'
    ),
    836 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/JSGroupings/plugins/sidecar.alert.js',
      'to' =>  'custom/src/wsystems/QualiaIntegration/JSGroupings/plugins/sidecar.alert.js'
    ),
    837 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/Jobs/InsertFailedRecord.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/Jobs/InsertFailedRecord.php'
    ),
    838 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/LogicHooks/ContactsFilterListHook.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/LogicHooks/ContactsFilterListHook.php'
    ),
    839 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/LogicHooks/FilterRelatedAfterHook.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/LogicHooks/FilterRelatedAfterHook.php'
    ),
    840 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/LogicHooks/FilterRelatedSetupAfterHook.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/LogicHooks/FilterRelatedSetupAfterHook.php'
    ),
    841 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/LogicHooks/OrdersFilterListHook.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/LogicHooks/OrdersFilterListHook.php'
    ),
    842 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/Setup/Install.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/Setup/Install.php'
    ),
    843 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/Traits/BeanHandlerTrait.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/Traits/BeanHandlerTrait.php'
    ),
    844 =>     array (
      'from' =>  '<basepath>/custom/src/wsystems/QualiaIntegration/Traits/ModuleConfigTrait.php',
      'to' =>  'custom/src/wsystems/QualiaIntegration/Traits/ModuleConfigTrait.php'
    ),
    845 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/CreateListg_Listings.gif',
      'to' =>  'custom/themes/default/images/CreateListg_Listings.gif'
    ),
    846 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/CreateLoans_Loans.gif',
      'to' =>  'custom/themes/default/images/CreateLoans_Loans.gif'
    ),
    847 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/CreateOrder_RQ_Order.gif',
      'to' =>  'custom/themes/default/images/CreateOrder_RQ_Order.gif'
    ),
    848 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/CreateParty_RQ_PARTY.gif',
      'to' =>  'custom/themes/default/images/CreateParty_RQ_PARTY.gif'
    ),
    849 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/CreateParty_RQ_Party.gif',
      'to' =>  'custom/themes/default/images/CreateParty_RQ_Party.gif'
    ),
    850 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/Createwsys_rq_transaction_history.gif',
      'to' =>  'custom/themes/default/images/Createwsys_rq_transaction_history.gif'
    ),
    851 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/Listg_Listings.gif',
      'to' =>  'custom/themes/default/images/Listg_Listings.gif'
    ),
    852 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/Loans_Loans.gif',
      'to' =>  'custom/themes/default/images/Loans_Loans.gif'
    ),
    853 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/Order_RQ_Order.gif',
      'to' =>  'custom/themes/default/images/Order_RQ_Order.gif'
    ),
    854 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/Party_RQ_PARTY.gif',
      'to' =>  'custom/themes/default/images/Party_RQ_PARTY.gif'
    ),
    855 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/Party_RQ_Party.gif',
      'to' =>  'custom/themes/default/images/Party_RQ_Party.gif'
    ),
    856 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Listg_Listings_32.png',
      'to' =>  'custom/themes/default/images/icon_Listg_Listings_32.png'
    ),
    857 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Listg_Listings_bar_32.png',
      'to' =>  'custom/themes/default/images/icon_Listg_Listings_bar_32.png'
    ),
    858 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Loans_Loans_32.png',
      'to' =>  'custom/themes/default/images/icon_Loans_Loans_32.png'
    ),
    859 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Loans_Loans_bar_32.png',
      'to' =>  'custom/themes/default/images/icon_Loans_Loans_bar_32.png'
    ),
    860 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Order_RQ_Order_32.png',
      'to' =>  'custom/themes/default/images/icon_Order_RQ_Order_32.png'
    ),
    861 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Order_RQ_Order_bar_32.png',
      'to' =>  'custom/themes/default/images/icon_Order_RQ_Order_bar_32.png'
    ),
    862 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Party_RQ_PARTY_32.png',
      'to' =>  'custom/themes/default/images/icon_Party_RQ_PARTY_32.png'
    ),
    863 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Party_RQ_PARTY_bar_32.png',
      'to' =>  'custom/themes/default/images/icon_Party_RQ_PARTY_bar_32.png'
    ),
    864 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Party_RQ_Party_32.png',
      'to' =>  'custom/themes/default/images/icon_Party_RQ_Party_32.png'
    ),
    865 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Party_RQ_Party_bar_32.png',
      'to' =>  'custom/themes/default/images/icon_Party_RQ_Party_bar_32.png'
    ),
    866 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_Wsys_rq_transaction_history_32.png',
      'to' =>  'custom/themes/default/images/icon_Wsys_rq_transaction_history_32.png'
    ),
    867 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/icon_wsys_rq_transaction_history_bar_32.png',
      'to' =>  'custom/themes/default/images/icon_wsys_rq_transaction_history_bar_32.png'
    ),
    868 =>     array (
      'from' =>  '<basepath>/custom/themes/default/images/wsys_rq_transaction_history.gif',
      'to' =>  'custom/themes/default/images/wsys_rq_transaction_history.gif'
    ),
    869 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/Dashlets/Listg_ListingsDashlet/Listg_ListingsDashlet.meta.php',
      'to' =>  'modules/Listg_Listings/Dashlets/Listg_ListingsDashlet/Listg_ListingsDashlet.meta.php'
    ),
    870 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/Dashlets/Listg_ListingsDashlet/Listg_ListingsDashlet.php',
      'to' =>  'modules/Listg_Listings/Dashlets/Listg_ListingsDashlet/Listg_ListingsDashlet.php'
    ),
    871 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/Listg_Listings.php',
      'to' =>  'modules/Listg_Listings/Listg_Listings.php'
    ),
    872 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/Listg_Listings_sugar.php',
      'to' =>  'modules/Listg_Listings/Listg_Listings_sugar.php'
    ),
    873 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/filters/basic/basic.php',
      'to' =>  'modules/Listg_Listings/clients/base/filters/basic/basic.php'
    ),
    874 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/filters/default/default.php',
      'to' =>  'modules/Listg_Listings/clients/base/filters/default/default.php'
    ),
    875 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/menus/header/header.php',
      'to' =>  'modules/Listg_Listings/clients/base/menus/header/header.php'
    ),
    876 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/menus/quickcreate/quickcreate.php',
      'to' =>  'modules/Listg_Listings/clients/base/menus/quickcreate/quickcreate.php'
    ),
    877 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/dupecheck-list/dupecheck-list.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/dupecheck-list/dupecheck-list.php'
    ),
    878 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/list/list.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/list/list.php'
    ),
    879 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/massupdate/massupdate.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/massupdate/massupdate.php'
    ),
    880 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/record/record.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/record/record.php'
    ),
    881 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/search-list/search-list.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/search-list/search-list.php'
    ),
    882 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/selection-list/selection-list.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/selection-list/selection-list.php'
    ),
    883 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/base/views/subpanel-list/subpanel-list.php',
      'to' =>  'modules/Listg_Listings/clients/base/views/subpanel-list/subpanel-list.php'
    ),
    884 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/mobile/layouts/detail/detail.php',
      'to' =>  'modules/Listg_Listings/clients/mobile/layouts/detail/detail.php'
    ),
    885 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/mobile/layouts/edit/edit.php',
      'to' =>  'modules/Listg_Listings/clients/mobile/layouts/edit/edit.php'
    ),
    886 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/mobile/layouts/list/list.php',
      'to' =>  'modules/Listg_Listings/clients/mobile/layouts/list/list.php'
    ),
    887 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/mobile/views/detail/detail.php',
      'to' =>  'modules/Listg_Listings/clients/mobile/views/detail/detail.php'
    ),
    888 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/mobile/views/edit/edit.php',
      'to' =>  'modules/Listg_Listings/clients/mobile/views/edit/edit.php'
    ),
    889 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/clients/mobile/views/list/list.php',
      'to' =>  'modules/Listg_Listings/clients/mobile/views/list/list.php'
    ),
    890 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/ar_SA.lang.php',
      'to' =>  'modules/Listg_Listings/language/ar_SA.lang.php'
    ),
    891 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/bg_BG.lang.php',
      'to' =>  'modules/Listg_Listings/language/bg_BG.lang.php'
    ),
    892 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/ca_ES.lang.php',
      'to' =>  'modules/Listg_Listings/language/ca_ES.lang.php'
    ),
    893 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/cs_CZ.lang.php',
      'to' =>  'modules/Listg_Listings/language/cs_CZ.lang.php'
    ),
    894 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/da_DK.lang.php',
      'to' =>  'modules/Listg_Listings/language/da_DK.lang.php'
    ),
    895 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/de_DE.lang.php',
      'to' =>  'modules/Listg_Listings/language/de_DE.lang.php'
    ),
    896 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/el_EL.lang.php',
      'to' =>  'modules/Listg_Listings/language/el_EL.lang.php'
    ),
    897 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/en_UK.lang.php',
      'to' =>  'modules/Listg_Listings/language/en_UK.lang.php'
    ),
    898 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/en_us.lang.php',
      'to' =>  'modules/Listg_Listings/language/en_us.lang.php'
    ),
    899 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/es_ES.lang.php',
      'to' =>  'modules/Listg_Listings/language/es_ES.lang.php'
    ),
    900 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/es_LA.lang.php',
      'to' =>  'modules/Listg_Listings/language/es_LA.lang.php'
    ),
    901 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/et_EE.lang.php',
      'to' =>  'modules/Listg_Listings/language/et_EE.lang.php'
    ),
    902 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/fi_FI.lang.php',
      'to' =>  'modules/Listg_Listings/language/fi_FI.lang.php'
    ),
    903 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/fr_FR.lang.php',
      'to' =>  'modules/Listg_Listings/language/fr_FR.lang.php'
    ),
    904 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/he_IL.lang.php',
      'to' =>  'modules/Listg_Listings/language/he_IL.lang.php'
    ),
    905 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/hr_HR.lang.php',
      'to' =>  'modules/Listg_Listings/language/hr_HR.lang.php'
    ),
    906 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/hu_HU.lang.php',
      'to' =>  'modules/Listg_Listings/language/hu_HU.lang.php'
    ),
    907 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/it_it.lang.php',
      'to' =>  'modules/Listg_Listings/language/it_it.lang.php'
    ),
    908 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/ja_JP.lang.php',
      'to' =>  'modules/Listg_Listings/language/ja_JP.lang.php'
    ),
    909 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/ko_KR.lang.php',
      'to' =>  'modules/Listg_Listings/language/ko_KR.lang.php'
    ),
    910 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/lt_LT.lang.php',
      'to' =>  'modules/Listg_Listings/language/lt_LT.lang.php'
    ),
    911 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/lv_LV.lang.php',
      'to' =>  'modules/Listg_Listings/language/lv_LV.lang.php'
    ),
    912 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/nb_NO.lang.php',
      'to' =>  'modules/Listg_Listings/language/nb_NO.lang.php'
    ),
    913 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/nl_NL.lang.php',
      'to' =>  'modules/Listg_Listings/language/nl_NL.lang.php'
    ),
    914 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/pl_PL.lang.php',
      'to' =>  'modules/Listg_Listings/language/pl_PL.lang.php'
    ),
    915 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/pt_BR.lang.php',
      'to' =>  'modules/Listg_Listings/language/pt_BR.lang.php'
    ),
    916 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/pt_PT.lang.php',
      'to' =>  'modules/Listg_Listings/language/pt_PT.lang.php'
    ),
    917 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/ro_RO.lang.php',
      'to' =>  'modules/Listg_Listings/language/ro_RO.lang.php'
    ),
    918 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/ru_RU.lang.php',
      'to' =>  'modules/Listg_Listings/language/ru_RU.lang.php'
    ),
    919 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/sk_SK.lang.php',
      'to' =>  'modules/Listg_Listings/language/sk_SK.lang.php'
    ),
    920 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/sq_AL.lang.php',
      'to' =>  'modules/Listg_Listings/language/sq_AL.lang.php'
    ),
    921 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/sr_RS.lang.php',
      'to' =>  'modules/Listg_Listings/language/sr_RS.lang.php'
    ),
    922 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/sv_SE.lang.php',
      'to' =>  'modules/Listg_Listings/language/sv_SE.lang.php'
    ),
    923 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/th_TH.lang.php',
      'to' =>  'modules/Listg_Listings/language/th_TH.lang.php'
    ),
    924 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/tr_TR.lang.php',
      'to' =>  'modules/Listg_Listings/language/tr_TR.lang.php'
    ),
    925 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/uk_UA.lang.php',
      'to' =>  'modules/Listg_Listings/language/uk_UA.lang.php'
    ),
    926 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/zh_CN.lang.php',
      'to' =>  'modules/Listg_Listings/language/zh_CN.lang.php'
    ),
    927 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/language/zh_TW.lang.php',
      'to' =>  'modules/Listg_Listings/language/zh_TW.lang.php'
    ),
    928 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/SearchFields.php',
      'to' =>  'modules/Listg_Listings/metadata/SearchFields.php'
    ),
    929 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/dashletviewdefs.php',
      'to' =>  'modules/Listg_Listings/metadata/dashletviewdefs.php'
    ),
    930 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/detailviewdefs.php',
      'to' =>  'modules/Listg_Listings/metadata/detailviewdefs.php'
    ),
    931 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/editviewdefs.php',
      'to' =>  'modules/Listg_Listings/metadata/editviewdefs.php'
    ),
    932 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/listviewdefs.php',
      'to' =>  'modules/Listg_Listings/metadata/listviewdefs.php'
    ),
    933 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/metafiles.php',
      'to' =>  'modules/Listg_Listings/metadata/metafiles.php'
    ),
    934 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/popupdefs.php',
      'to' =>  'modules/Listg_Listings/metadata/popupdefs.php'
    ),
    935 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/quickcreatedefs.php',
      'to' =>  'modules/Listg_Listings/metadata/quickcreatedefs.php'
    ),
    936 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/searchdefs.php',
      'to' =>  'modules/Listg_Listings/metadata/searchdefs.php'
    ),
    937 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/studio.php',
      'to' =>  'modules/Listg_Listings/metadata/studio.php'
    ),
    938 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/metadata/subpanels/default.php',
      'to' =>  'modules/Listg_Listings/metadata/subpanels/default.php'
    ),
    939 =>     array (
      'from' =>  '<basepath>/modules/Listg_Listings/vardefs.php',
      'to' =>  'modules/Listg_Listings/vardefs.php'
    ),
    940 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/Dashlets/Loans_LoansDashlet/Loans_LoansDashlet.meta.php',
      'to' =>  'modules/Loans_Loans/Dashlets/Loans_LoansDashlet/Loans_LoansDashlet.meta.php'
    ),
    941 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/Dashlets/Loans_LoansDashlet/Loans_LoansDashlet.php',
      'to' =>  'modules/Loans_Loans/Dashlets/Loans_LoansDashlet/Loans_LoansDashlet.php'
    ),
    942 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/Loans_Loans.php',
      'to' =>  'modules/Loans_Loans/Loans_Loans.php'
    ),
    943 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/Loans_Loans_sugar.php',
      'to' =>  'modules/Loans_Loans/Loans_Loans_sugar.php'
    ),
    944 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/filters/basic/basic.php',
      'to' =>  'modules/Loans_Loans/clients/base/filters/basic/basic.php'
    ),
    945 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/filters/default/default.php',
      'to' =>  'modules/Loans_Loans/clients/base/filters/default/default.php'
    ),
    946 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/menus/header/header.php',
      'to' =>  'modules/Loans_Loans/clients/base/menus/header/header.php'
    ),
    947 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/menus/quickcreate/quickcreate.php',
      'to' =>  'modules/Loans_Loans/clients/base/menus/quickcreate/quickcreate.php'
    ),
    948 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/dupecheck-list/dupecheck-list.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/dupecheck-list/dupecheck-list.php'
    ),
    949 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/list/list.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/list/list.php'
    ),
    950 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/massupdate/massupdate.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/massupdate/massupdate.php'
    ),
    951 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/record/record.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/record/record.php'
    ),
    952 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/search-list/search-list.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/search-list/search-list.php'
    ),
    953 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/selection-list/selection-list.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/selection-list/selection-list.php'
    ),
    954 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/base/views/subpanel-list/subpanel-list.php',
      'to' =>  'modules/Loans_Loans/clients/base/views/subpanel-list/subpanel-list.php'
    ),
    955 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/mobile/layouts/detail/detail.php',
      'to' =>  'modules/Loans_Loans/clients/mobile/layouts/detail/detail.php'
    ),
    956 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/mobile/layouts/edit/edit.php',
      'to' =>  'modules/Loans_Loans/clients/mobile/layouts/edit/edit.php'
    ),
    957 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/mobile/layouts/list/list.php',
      'to' =>  'modules/Loans_Loans/clients/mobile/layouts/list/list.php'
    ),
    958 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/mobile/views/detail/detail.php',
      'to' =>  'modules/Loans_Loans/clients/mobile/views/detail/detail.php'
    ),
    959 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/mobile/views/edit/edit.php',
      'to' =>  'modules/Loans_Loans/clients/mobile/views/edit/edit.php'
    ),
    960 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/clients/mobile/views/list/list.php',
      'to' =>  'modules/Loans_Loans/clients/mobile/views/list/list.php'
    ),
    961 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/ar_SA.lang.php',
      'to' =>  'modules/Loans_Loans/language/ar_SA.lang.php'
    ),
    962 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/bg_BG.lang.php',
      'to' =>  'modules/Loans_Loans/language/bg_BG.lang.php'
    ),
    963 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/ca_ES.lang.php',
      'to' =>  'modules/Loans_Loans/language/ca_ES.lang.php'
    ),
    964 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/cs_CZ.lang.php',
      'to' =>  'modules/Loans_Loans/language/cs_CZ.lang.php'
    ),
    965 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/da_DK.lang.php',
      'to' =>  'modules/Loans_Loans/language/da_DK.lang.php'
    ),
    966 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/de_DE.lang.php',
      'to' =>  'modules/Loans_Loans/language/de_DE.lang.php'
    ),
    967 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/el_EL.lang.php',
      'to' =>  'modules/Loans_Loans/language/el_EL.lang.php'
    ),
    968 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/en_UK.lang.php',
      'to' =>  'modules/Loans_Loans/language/en_UK.lang.php'
    ),
    969 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/en_us.lang.php',
      'to' =>  'modules/Loans_Loans/language/en_us.lang.php'
    ),
    970 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/es_ES.lang.php',
      'to' =>  'modules/Loans_Loans/language/es_ES.lang.php'
    ),
    971 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/es_LA.lang.php',
      'to' =>  'modules/Loans_Loans/language/es_LA.lang.php'
    ),
    972 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/et_EE.lang.php',
      'to' =>  'modules/Loans_Loans/language/et_EE.lang.php'
    ),
    973 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/fi_FI.lang.php',
      'to' =>  'modules/Loans_Loans/language/fi_FI.lang.php'
    ),
    974 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/fr_FR.lang.php',
      'to' =>  'modules/Loans_Loans/language/fr_FR.lang.php'
    ),
    975 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/he_IL.lang.php',
      'to' =>  'modules/Loans_Loans/language/he_IL.lang.php'
    ),
    976 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/hr_HR.lang.php',
      'to' =>  'modules/Loans_Loans/language/hr_HR.lang.php'
    ),
    977 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/hu_HU.lang.php',
      'to' =>  'modules/Loans_Loans/language/hu_HU.lang.php'
    ),
    978 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/it_it.lang.php',
      'to' =>  'modules/Loans_Loans/language/it_it.lang.php'
    ),
    979 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/ja_JP.lang.php',
      'to' =>  'modules/Loans_Loans/language/ja_JP.lang.php'
    ),
    980 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/ko_KR.lang.php',
      'to' =>  'modules/Loans_Loans/language/ko_KR.lang.php'
    ),
    981 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/lt_LT.lang.php',
      'to' =>  'modules/Loans_Loans/language/lt_LT.lang.php'
    ),
    982 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/lv_LV.lang.php',
      'to' =>  'modules/Loans_Loans/language/lv_LV.lang.php'
    ),
    983 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/nb_NO.lang.php',
      'to' =>  'modules/Loans_Loans/language/nb_NO.lang.php'
    ),
    984 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/nl_NL.lang.php',
      'to' =>  'modules/Loans_Loans/language/nl_NL.lang.php'
    ),
    985 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/pl_PL.lang.php',
      'to' =>  'modules/Loans_Loans/language/pl_PL.lang.php'
    ),
    986 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/pt_BR.lang.php',
      'to' =>  'modules/Loans_Loans/language/pt_BR.lang.php'
    ),
    987 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/pt_PT.lang.php',
      'to' =>  'modules/Loans_Loans/language/pt_PT.lang.php'
    ),
    988 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/ro_RO.lang.php',
      'to' =>  'modules/Loans_Loans/language/ro_RO.lang.php'
    ),
    989 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/ru_RU.lang.php',
      'to' =>  'modules/Loans_Loans/language/ru_RU.lang.php'
    ),
    990 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/sk_SK.lang.php',
      'to' =>  'modules/Loans_Loans/language/sk_SK.lang.php'
    ),
    991 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/sq_AL.lang.php',
      'to' =>  'modules/Loans_Loans/language/sq_AL.lang.php'
    ),
    992 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/sr_RS.lang.php',
      'to' =>  'modules/Loans_Loans/language/sr_RS.lang.php'
    ),
    993 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/sv_SE.lang.php',
      'to' =>  'modules/Loans_Loans/language/sv_SE.lang.php'
    ),
    994 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/th_TH.lang.php',
      'to' =>  'modules/Loans_Loans/language/th_TH.lang.php'
    ),
    995 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/tr_TR.lang.php',
      'to' =>  'modules/Loans_Loans/language/tr_TR.lang.php'
    ),
    996 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/uk_UA.lang.php',
      'to' =>  'modules/Loans_Loans/language/uk_UA.lang.php'
    ),
    997 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/zh_CN.lang.php',
      'to' =>  'modules/Loans_Loans/language/zh_CN.lang.php'
    ),
    998 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/language/zh_TW.lang.php',
      'to' =>  'modules/Loans_Loans/language/zh_TW.lang.php'
    ),
    999 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/SearchFields.php',
      'to' =>  'modules/Loans_Loans/metadata/SearchFields.php'
    ),
    1000 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/dashletviewdefs.php',
      'to' =>  'modules/Loans_Loans/metadata/dashletviewdefs.php'
    ),
    1001 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/detailviewdefs.php',
      'to' =>  'modules/Loans_Loans/metadata/detailviewdefs.php'
    ),
    1002 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/editviewdefs.php',
      'to' =>  'modules/Loans_Loans/metadata/editviewdefs.php'
    ),
    1003 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/listviewdefs.php',
      'to' =>  'modules/Loans_Loans/metadata/listviewdefs.php'
    ),
    1004 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/metafiles.php',
      'to' =>  'modules/Loans_Loans/metadata/metafiles.php'
    ),
    1005 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/popupdefs.php',
      'to' =>  'modules/Loans_Loans/metadata/popupdefs.php'
    ),
    1006 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/quickcreatedefs.php',
      'to' =>  'modules/Loans_Loans/metadata/quickcreatedefs.php'
    ),
    1007 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/searchdefs.php',
      'to' =>  'modules/Loans_Loans/metadata/searchdefs.php'
    ),
    1008 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/studio.php',
      'to' =>  'modules/Loans_Loans/metadata/studio.php'
    ),
    1009 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/metadata/subpanels/default.php',
      'to' =>  'modules/Loans_Loans/metadata/subpanels/default.php'
    ),
    1010 =>     array (
      'from' =>  '<basepath>/modules/Loans_Loans/vardefs.php',
      'to' =>  'modules/Loans_Loans/vardefs.php'
    ),
    1011 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/Dashlets/Order_RQ_OrderDashlet/Order_RQ_OrderDashlet.meta.php',
      'to' =>  'modules/Order_RQ_Order/Dashlets/Order_RQ_OrderDashlet/Order_RQ_OrderDashlet.meta.php'
    ),
    1012 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/Dashlets/Order_RQ_OrderDashlet/Order_RQ_OrderDashlet.php',
      'to' =>  'modules/Order_RQ_Order/Dashlets/Order_RQ_OrderDashlet/Order_RQ_OrderDashlet.php'
    ),
    1013 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/Order_RQ_Order.php',
      'to' =>  'modules/Order_RQ_Order/Order_RQ_Order.php'
    ),
    1014 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/Order_RQ_Order_sugar.php',
      'to' =>  'modules/Order_RQ_Order/Order_RQ_Order_sugar.php'
    ),
    1015 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/filters/basic/basic.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/filters/basic/basic.php'
    ),
    1016 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/filters/default/default.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/filters/default/default.php'
    ),
    1017 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/menus/header/header.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/menus/header/header.php'
    ),
    1018 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/menus/quickcreate/quickcreate.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/menus/quickcreate/quickcreate.php'
    ),
    1019 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/dupecheck-list/dupecheck-list.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/dupecheck-list/dupecheck-list.php'
    ),
    1020 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/list/list.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/list/list.php'
    ),
    1021 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/massupdate/massupdate.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/massupdate/massupdate.php'
    ),
    1022 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/record/record.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/record/record.php'
    ),
    1023 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/search-list/search-list.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/search-list/search-list.php'
    ),
    1024 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/selection-list/selection-list.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/selection-list/selection-list.php'
    ),
    1025 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/subpanel-list/subpanel-list.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/subpanel-list/subpanel-list.php'
    ),
    1026 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/base/views/twitter/twitter.php',
      'to' =>  'modules/Order_RQ_Order/clients/base/views/twitter/twitter.php'
    ),
    1027 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/mobile/layouts/detail/detail.php',
      'to' =>  'modules/Order_RQ_Order/clients/mobile/layouts/detail/detail.php'
    ),
    1028 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/mobile/layouts/edit/edit.php',
      'to' =>  'modules/Order_RQ_Order/clients/mobile/layouts/edit/edit.php'
    ),
    1029 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/mobile/layouts/list/list.php',
      'to' =>  'modules/Order_RQ_Order/clients/mobile/layouts/list/list.php'
    ),
    1030 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/mobile/views/detail/detail.php',
      'to' =>  'modules/Order_RQ_Order/clients/mobile/views/detail/detail.php'
    ),
    1031 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/mobile/views/edit/edit.php',
      'to' =>  'modules/Order_RQ_Order/clients/mobile/views/edit/edit.php'
    ),
    1032 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/clients/mobile/views/list/list.php',
      'to' =>  'modules/Order_RQ_Order/clients/mobile/views/list/list.php'
    ),
    1033 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/ar_SA.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/ar_SA.lang.php'
    ),
    1034 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/bg_BG.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/bg_BG.lang.php'
    ),
    1035 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/ca_ES.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/ca_ES.lang.php'
    ),
    1036 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/cs_CZ.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/cs_CZ.lang.php'
    ),
    1037 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/da_DK.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/da_DK.lang.php'
    ),
    1038 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/de_DE.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/de_DE.lang.php'
    ),
    1039 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/el_EL.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/el_EL.lang.php'
    ),
    1040 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/en_UK.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/en_UK.lang.php'
    ),
    1041 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/en_us.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/en_us.lang.php'
    ),
    1042 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/es_ES.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/es_ES.lang.php'
    ),
    1043 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/es_LA.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/es_LA.lang.php'
    ),
    1044 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/et_EE.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/et_EE.lang.php'
    ),
    1045 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/fi_FI.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/fi_FI.lang.php'
    ),
    1046 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/fr_FR.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/fr_FR.lang.php'
    ),
    1047 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/he_IL.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/he_IL.lang.php'
    ),
    1048 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/hr_HR.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/hr_HR.lang.php'
    ),
    1049 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/hu_HU.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/hu_HU.lang.php'
    ),
    1050 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/it_it.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/it_it.lang.php'
    ),
    1051 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/ja_JP.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/ja_JP.lang.php'
    ),
    1052 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/ko_KR.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/ko_KR.lang.php'
    ),
    1053 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/lt_LT.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/lt_LT.lang.php'
    ),
    1054 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/lv_LV.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/lv_LV.lang.php'
    ),
    1055 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/nb_NO.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/nb_NO.lang.php'
    ),
    1056 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/nl_NL.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/nl_NL.lang.php'
    ),
    1057 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/pl_PL.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/pl_PL.lang.php'
    ),
    1058 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/pt_BR.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/pt_BR.lang.php'
    ),
    1059 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/pt_PT.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/pt_PT.lang.php'
    ),
    1060 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/ro_RO.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/ro_RO.lang.php'
    ),
    1061 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/ru_RU.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/ru_RU.lang.php'
    ),
    1062 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/sk_SK.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/sk_SK.lang.php'
    ),
    1063 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/sq_AL.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/sq_AL.lang.php'
    ),
    1064 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/sr_RS.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/sr_RS.lang.php'
    ),
    1065 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/sv_SE.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/sv_SE.lang.php'
    ),
    1066 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/th_TH.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/th_TH.lang.php'
    ),
    1067 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/tr_TR.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/tr_TR.lang.php'
    ),
    1068 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/uk_UA.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/uk_UA.lang.php'
    ),
    1069 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/zh_CN.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/zh_CN.lang.php'
    ),
    1070 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/language/zh_TW.lang.php',
      'to' =>  'modules/Order_RQ_Order/language/zh_TW.lang.php'
    ),
    1071 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/SearchFields.php',
      'to' =>  'modules/Order_RQ_Order/metadata/SearchFields.php'
    ),
    1072 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/dashletviewdefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/dashletviewdefs.php'
    ),
    1073 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/detailviewdefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/detailviewdefs.php'
    ),
    1074 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/editviewdefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/editviewdefs.php'
    ),
    1075 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/listviewdefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/listviewdefs.php'
    ),
    1076 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/metafiles.php',
      'to' =>  'modules/Order_RQ_Order/metadata/metafiles.php'
    ),
    1077 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/popupdefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/popupdefs.php'
    ),
    1078 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/quickcreatedefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/quickcreatedefs.php'
    ),
    1079 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/searchdefs.php',
      'to' =>  'modules/Order_RQ_Order/metadata/searchdefs.php'
    ),
    1080 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/studio.php',
      'to' =>  'modules/Order_RQ_Order/metadata/studio.php'
    ),
    1081 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/metadata/subpanels/default.php',
      'to' =>  'modules/Order_RQ_Order/metadata/subpanels/default.php'
    ),
    1082 =>     array (
      'from' =>  '<basepath>/modules/Order_RQ_Order/vardefs.php',
      'to' =>  'modules/Order_RQ_Order/vardefs.php'
    ),
    1083 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/Dashlets/Party_RQ_PartyDashlet/Party_RQ_PartyDashlet.meta.php',
      'to' =>  'modules/Party_RQ_Party/Dashlets/Party_RQ_PartyDashlet/Party_RQ_PartyDashlet.meta.php'
    ),
    1084 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/Dashlets/Party_RQ_PartyDashlet/Party_RQ_PartyDashlet.php',
      'to' =>  'modules/Party_RQ_Party/Dashlets/Party_RQ_PartyDashlet/Party_RQ_PartyDashlet.php'
    ),
    1085 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/Party_RQ_Party.php',
      'to' =>  'modules/Party_RQ_Party/Party_RQ_Party.php'
    ),
    1086 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/Party_RQ_Party_sugar.php',
      'to' =>  'modules/Party_RQ_Party/Party_RQ_Party_sugar.php'
    ),
    1087 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/filters/basic/basic.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/filters/basic/basic.php'
    ),
    1088 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/filters/default/default.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/filters/default/default.php'
    ),
    1089 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/filters/person/person.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/filters/person/person.php'
    ),
    1090 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/menus/header/header.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/menus/header/header.php'
    ),
    1091 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/menus/quickcreate/quickcreate.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/menus/quickcreate/quickcreate.php'
    ),
    1092 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/dupecheck-list/dupecheck-list.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/dupecheck-list/dupecheck-list.php'
    ),
    1093 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/list/list.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/list/list.php'
    ),
    1094 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/massupdate/massupdate.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/massupdate/massupdate.php'
    ),
    1095 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/record/record.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/record/record.php'
    ),
    1096 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/recordlist/recordlist.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/recordlist/recordlist.php'
    ),
    1097 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/search-list/search-list.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/search-list/search-list.php'
    ),
    1098 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/selection-list/selection-list.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/selection-list/selection-list.php'
    ),
    1099 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/subpanel-list/subpanel-list.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/subpanel-list/subpanel-list.php'
    ),
    1100 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/base/views/twitter/twitter.php',
      'to' =>  'modules/Party_RQ_Party/clients/base/views/twitter/twitter.php'
    ),
    1101 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/mobile/layouts/detail/detail.php',
      'to' =>  'modules/Party_RQ_Party/clients/mobile/layouts/detail/detail.php'
    ),
    1102 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/mobile/layouts/edit/edit.php',
      'to' =>  'modules/Party_RQ_Party/clients/mobile/layouts/edit/edit.php'
    ),
    1103 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/mobile/layouts/list/list.php',
      'to' =>  'modules/Party_RQ_Party/clients/mobile/layouts/list/list.php'
    ),
    1104 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/mobile/views/detail/detail.php',
      'to' =>  'modules/Party_RQ_Party/clients/mobile/views/detail/detail.php'
    ),
    1105 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/mobile/views/edit/edit.php',
      'to' =>  'modules/Party_RQ_Party/clients/mobile/views/edit/edit.php'
    ),
    1106 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/clients/mobile/views/list/list.php',
      'to' =>  'modules/Party_RQ_Party/clients/mobile/views/list/list.php'
    ),
    1107 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/ar_SA.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/ar_SA.lang.php'
    ),
    1108 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/bg_BG.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/bg_BG.lang.php'
    ),
    1109 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/ca_ES.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/ca_ES.lang.php'
    ),
    1110 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/cs_CZ.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/cs_CZ.lang.php'
    ),
    1111 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/da_DK.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/da_DK.lang.php'
    ),
    1112 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/de_DE.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/de_DE.lang.php'
    ),
    1113 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/el_EL.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/el_EL.lang.php'
    ),
    1114 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/en_UK.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/en_UK.lang.php'
    ),
    1115 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/en_us.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/en_us.lang.php'
    ),
    1116 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/es_ES.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/es_ES.lang.php'
    ),
    1117 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/es_LA.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/es_LA.lang.php'
    ),
    1118 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/et_EE.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/et_EE.lang.php'
    ),
    1119 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/fi_FI.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/fi_FI.lang.php'
    ),
    1120 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/fr_FR.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/fr_FR.lang.php'
    ),
    1121 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/he_IL.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/he_IL.lang.php'
    ),
    1122 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/hr_HR.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/hr_HR.lang.php'
    ),
    1123 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/hu_HU.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/hu_HU.lang.php'
    ),
    1124 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/it_it.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/it_it.lang.php'
    ),
    1125 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/ja_JP.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/ja_JP.lang.php'
    ),
    1126 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/ko_KR.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/ko_KR.lang.php'
    ),
    1127 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/lt_LT.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/lt_LT.lang.php'
    ),
    1128 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/lv_LV.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/lv_LV.lang.php'
    ),
    1129 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/nb_NO.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/nb_NO.lang.php'
    ),
    1130 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/nl_NL.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/nl_NL.lang.php'
    ),
    1131 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/pl_PL.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/pl_PL.lang.php'
    ),
    1132 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/pt_BR.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/pt_BR.lang.php'
    ),
    1133 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/pt_PT.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/pt_PT.lang.php'
    ),
    1134 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/ro_RO.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/ro_RO.lang.php'
    ),
    1135 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/ru_RU.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/ru_RU.lang.php'
    ),
    1136 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/sk_SK.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/sk_SK.lang.php'
    ),
    1137 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/sq_AL.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/sq_AL.lang.php'
    ),
    1138 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/sr_RS.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/sr_RS.lang.php'
    ),
    1139 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/sv_SE.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/sv_SE.lang.php'
    ),
    1140 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/th_TH.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/th_TH.lang.php'
    ),
    1141 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/tr_TR.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/tr_TR.lang.php'
    ),
    1142 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/uk_UA.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/uk_UA.lang.php'
    ),
    1143 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/zh_CN.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/zh_CN.lang.php'
    ),
    1144 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/language/zh_TW.lang.php',
      'to' =>  'modules/Party_RQ_Party/language/zh_TW.lang.php'
    ),
    1145 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/SearchFields.php',
      'to' =>  'modules/Party_RQ_Party/metadata/SearchFields.php'
    ),
    1146 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/dashletviewdefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/dashletviewdefs.php'
    ),
    1147 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/detailviewdefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/detailviewdefs.php'
    ),
    1148 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/editviewdefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/editviewdefs.php'
    ),
    1149 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/listviewdefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/listviewdefs.php'
    ),
    1150 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/metafiles.php',
      'to' =>  'modules/Party_RQ_Party/metadata/metafiles.php'
    ),
    1151 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/popupdefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/popupdefs.php'
    ),
    1152 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/quickcreatedefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/quickcreatedefs.php'
    ),
    1153 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/searchdefs.php',
      'to' =>  'modules/Party_RQ_Party/metadata/searchdefs.php'
    ),
    1154 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/studio.php',
      'to' =>  'modules/Party_RQ_Party/metadata/studio.php'
    ),
    1155 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/metadata/subpanels/default.php',
      'to' =>  'modules/Party_RQ_Party/metadata/subpanels/default.php'
    ),
    1156 =>     array (
      'from' =>  '<basepath>/modules/Party_RQ_Party/vardefs.php',
      'to' =>  'modules/Party_RQ_Party/vardefs.php'
    )
  )
);