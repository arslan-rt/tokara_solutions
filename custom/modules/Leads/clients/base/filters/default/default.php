<?php
// created: 2021-11-18 19:00:41
$viewdefs['Leads']['base']['filter']['default'] = array (
  'default_filter' => 'all_records',
  'fields' => 
  array (
    'first_name' => 
    array (
    ),
    'last_name' => 
    array (
    ),
    'email' => 
    array (
    ),
    'account_name' => 
    array (
    ),
    'title' => 
    array (
    ),
    'lead_source' => 
    array (
    ),
    'do_not_call' => 
    array (
    ),
    'phone' => 
    array (
      'dbFields' => 
      array (
        0 => 'phone_mobile',
        1 => 'phone_work',
        2 => 'phone_other',
        3 => 'phone_fax',
        4 => 'phone_home',
      ),
      'type' => 'phone',
      'vname' => 'LBL_PHONE',
    ),
    'assistant' => 
    array (
    ),
    'address_street' => 
    array (
      'dbFields' => 
      array (
        0 => 'primary_address_street',
        1 => 'alt_address_street',
      ),
      'vname' => 'LBL_STREET',
      'type' => 'text',
    ),
    'address_city' => 
    array (
      'dbFields' => 
      array (
        0 => 'primary_address_city',
        1 => 'alt_address_city',
      ),
      'vname' => 'LBL_CITY',
      'type' => 'text',
    ),
    'address_state' => 
    array (
      'dbFields' => 
      array (
        0 => 'primary_address_state',
        1 => 'alt_address_state',
      ),
      'vname' => 'LBL_STATE',
      'type' => 'text',
    ),
    'address_postalcode' => 
    array (
      'dbFields' => 
      array (
        0 => 'primary_address_postalcode',
        1 => 'alt_address_postalcode',
      ),
      'vname' => 'LBL_POSTAL_CODE',
      'type' => 'text',
    ),
    'address_country' => 
    array (
      'dbFields' => 
      array (
        0 => 'primary_address_country',
        1 => 'alt_address_country',
      ),
      'vname' => 'LBL_COUNTRY',
      'type' => 'text',
    ),
    'last_interaction_date_c' => 
    array (
    ),
    'status' => 
    array (
    ),
    'tag' => 
    array (
    ),
    'assigned_user_name' => 
    array (
    ),
    '$owner' => 
    array (
      'predefined_filter' => true,
      'vname' => 'LBL_CURRENT_USER_FILTER',
    ),
    '$favorite' => 
    array (
      'predefined_filter' => true,
      'vname' => 'LBL_FAVORITES_FILTER',
    ),
    'team_name' => 
    array (
    ),
    'date_entered' => 
    array (
    ),
    'created_by_name' => 
    array (
    ),
    'date_modified' => 
    array (
    ),
    'modified_by_name' => 
    array (
    ),
  ),
);