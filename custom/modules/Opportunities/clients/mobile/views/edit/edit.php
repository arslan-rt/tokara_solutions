<?php
// created: 2023-06-21 04:11:07
$viewdefs['Opportunities']['mobile']['view']['edit'] = array (
  'templateMeta' => 
  array (
    'maxColumns' => '1',
    'widths' => 
    array (
      0 => 
      array (
        'label' => '10',
        'field' => '30',
      ),
    ),
  ),
  'panels' => 
  array (
    0 => 
    array (
      'label' => 'LBL_PANEL_DEFAULT',
      'name' => 'LBL_PANEL_DEFAULT',
      'columns' => '1',
      'placeholders' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'name',
          'displayParams' => 
          array (
            'required' => true,
            'wireless_edit_only' => true,
          ),
        ),
        1 => 'amount',
        2 => 'account_name',
        3 => 
        array (
          'name' => 'date_closed',
        ),
        4 => 
        array (
          'name' => 'sales_stage',
        ),
        5 => 'tag',
        6 => 'assigned_user_name',
        7 => 'team_name',
        8 => 
        array (
          'name' => 'sales_status',
          'readonly' => true,
          'studio' => true,
          'label' => 'LBL_SALES_STATUS',
        ),
        9 => 
        array (
          'name' => 'service_start_date',
          'comment' => 'Service start date field.',
          'related_fields' => 
          array (
          ),
          'label' => 'LBL_SERVICE_START_DATE',
        ),
        10 => 
        array (
          'name' => 'renewal_parent_name',
          'label' => 'LBL_RENEWAL_PARENT',
        ),
        11 => 'forecasted_likely',
        12 => 'commit_stage',
        13 => 'lost',
      ),
    ),
  ),
);