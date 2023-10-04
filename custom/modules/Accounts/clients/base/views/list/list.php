<?php
// created: 2022-03-15 04:12:20
$viewdefs['Accounts']['base']['view']['list'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'name',
          'link' => true,
          'label' => 'LBL_LIST_ACCOUNT_NAME',
          'enabled' => true,
          'default' => true,
          'width' => 'xlarge',
        ),
        1 => 
        array (
          'name' => 'billing_address_street',
          'label' => 'LBL_BILLING_ADDRESS_STREET',
          'enabled' => true,
          'sortable' => false,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'billing_address_city',
          'label' => 'LBL_LIST_CITY',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'billing_address_state',
          'label' => 'LBL_BILLING_ADDRESS_STATE',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'phone_office',
          'label' => 'LBL_LIST_PHONE',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_LIST_ASSIGNED_USER',
          'id' => 'ASSIGNED_USER_ID',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'date_modified',
          'enabled' => true,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'date_entered',
          'type' => 'datetime',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'default' => true,
          'readonly' => true,
        ),
        8 => 
        array (
          'name' => 'phone_alternate',
          'label' => 'LBL_PHONE_ALT',
          'enabled' => true,
          'default' => false,
        ),
        9 => 
        array (
          'name' => 'phone_fax',
          'label' => 'LBL_FAX',
          'enabled' => true,
          'default' => false,
        ),
        10 => 
        array (
          'name' => 'email',
          'label' => 'LBL_EMAIL_ADDRESS',
          'enabled' => true,
          'default' => false,
        ),
        11 => 
        array (
          'name' => 'billing_address_postalcode',
          'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
          'enabled' => true,
          'default' => false,
        ),
        12 => 
        array (
          'name' => 'billing_address_country',
          'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
          'enabled' => true,
          'default' => false,
        ),
        13 => 
        array (
          'name' => 'tag',
          'label' => 'LBL_TAGS',
          'enabled' => true,
          'default' => false,
        ),
        14 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
          'default' => false,
        ),
        15 => 
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => false,
        ),
        16 => 
        array (
          'name' => 'modified_by_name',
          'label' => 'LBL_MODIFIED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'MODIFIED_USER_ID',
          'link' => true,
          'default' => false,
        ),
        17 => 
        array (
          'name' => 'is_escalated',
          'label' => 'LBL_ESCALATED',
          'badge_label' => 'LBL_ESCALATED',
          'warning_level' => 'important',
          'type' => 'badge',
          'enabled' => true,
          'default' => false,
        ),
      ),
    ),
  ),
);