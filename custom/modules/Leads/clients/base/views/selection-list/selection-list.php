<?php
// created: 2022-12-12 04:51:09
$viewdefs['Leads']['base']['view']['selection-list'] = array (
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
          'type' => 'fullname',
          'fields' => 
          array (
            0 => 'salutation',
            1 => 'first_name',
            2 => 'last_name',
          ),
          'link' => true,
          'label' => 'LBL_LIST_NAME',
          'enabled' => true,
          'default' => true,
        ),
        1 => 
        array (
          'name' => 'status',
          'label' => 'LBL_LIST_STATUS',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'account_name',
          'label' => 'LBL_LIST_ACCOUNT_NAME',
          'enabled' => true,
          'default' => true,
          'related_fields' => 
          array (
            0 => 'account_id',
            1 => 'converted',
          ),
        ),
        3 => 
        array (
          'name' => 'title',
          'label' => 'LBL_TITLE',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'phone_work',
          'label' => 'LBL_LIST_PHONE',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'date_modified',
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'email',
          'label' => 'LBL_LIST_EMAIL_ADDRESS',
          'enabled' => true,
          'default' => false,
        ),
        7 => 
        array (
          'name' => 'phone_home',
          'label' => 'LBL_HOME_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        8 => 
        array (
          'name' => 'phone_mobile',
          'label' => 'LBL_MOBILE_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        9 => 
        array (
          'name' => 'phone_other',
          'label' => 'LBL_OTHER_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        10 => 
        array (
          'name' => 'primary_address_street',
          'label' => 'LBL_PRIMARY_ADDRESS_STREET',
          'enabled' => true,
          'sortable' => false,
          'default' => false,
        ),
        11 => 
        array (
          'name' => 'primary_address_city',
          'label' => 'LBL_PRIMARY_ADDRESS_CITY',
          'enabled' => true,
          'default' => false,
        ),
        12 => 
        array (
          'name' => 'primary_address_state',
          'label' => 'LBL_PRIMARY_ADDRESS_STATE',
          'enabled' => true,
          'default' => false,
        ),
        13 => 
        array (
          'name' => 'primary_address_postalcode',
          'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
          'enabled' => true,
          'default' => false,
        ),
        14 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_LIST_ASSIGNED_USER',
          'enabled' => true,
          'default' => false,
        ),
        15 => 
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'default' => false,
          'readonly' => true,
        ),
        16 => 
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => false,
        ),
        17 => 
        array (
          'name' => 'modified_by_name',
          'label' => 'LBL_MODIFIED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'MODIFIED_USER_ID',
          'link' => true,
          'default' => false,
        ),
      ),
    ),
  ),
);