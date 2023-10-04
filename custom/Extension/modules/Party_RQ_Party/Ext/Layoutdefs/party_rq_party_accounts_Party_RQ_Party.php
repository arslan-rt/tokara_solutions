<?php
 // created: 2019-01-10 13:51:51
$layout_defs["Party_RQ_Party"]["subpanel_setup"]['party_rq_party_accounts'] = array (
  'order' => 100,
  'module' => 'Accounts',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PARTY_RQ_PARTY_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'get_subpanel_data' => 'party_rq_party_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
