<?php
// created: 2022-01-21 17:16:23
$viewdefs['Contacts']['base']['filter']['default'] = array (
  'default_filter' => 'all_records',
  'quicksearch_field' => 
  array (
    0 => 
    array (
      0 => 'first_name',
      1 => 'last_name',
    ),
    1 => 'email',
    2 => 'phone_work',
    3 => 'phone_mobile',
    4 => 'phone_other',
    5 => 'assistant_phone',
  ),
  'quicksearch_priority' => 2,
  'fields' => 
  array (
    'first_name' => 
    array (
    ),
    'last_name' => 
    array (
    ),
    'title' => 
    array (
    ),
    'account_name' => 
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
        4 => 'assistant_phone',
      ),
      'type' => 'phone',
      'vname' => 'LBL_PHONE',
    ),
    'email' => 
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
    'tag' => 
    array (
    ),
    'team_name' => 
    array (
    ),
    '$owner' => 
    array (
      'predefined_filter' => true,
      'vname' => 'LBL_CURRENT_USER_FILTER',
    ),
    'assigned_user_name' => 
    array (
    ),
    '$favorite' => 
    array (
      'predefined_filter' => true,
      'vname' => 'LBL_FAVORITES_FILTER',
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