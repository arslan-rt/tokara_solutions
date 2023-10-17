<?php
 // created: 2019-01-10 13:51:51
$layout_defs["Loans_Loans"]["subpanel_setup"]['party_rq_party_loans_loans'] = array (
  'order' => 100,
  'module' => 'Party_RQ_Party',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PARTY_RQ_PARTY_LOANS_LOANS_FROM_PARTY_RQ_PARTY_TITLE',
  'get_subpanel_data' => 'party_rq_party_loans_loans',
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
