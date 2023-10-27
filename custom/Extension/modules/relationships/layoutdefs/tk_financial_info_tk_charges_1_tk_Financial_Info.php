<?php
 // created: 2023-10-23 12:36:42
$layout_defs["tk_Financial_Info"]["subpanel_setup"]['tk_financial_info_tk_charges_1'] = array (
  'order' => 100,
  'module' => 'tk_Charges',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_TK_FINANCIAL_INFO_TK_CHARGES_1_FROM_TK_CHARGES_TITLE',
  'get_subpanel_data' => 'tk_financial_info_tk_charges_1',
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
