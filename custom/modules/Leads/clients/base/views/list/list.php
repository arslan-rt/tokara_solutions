<?php
// created: 2022-12-12 04:51:09
$viewdefs['Leads']['base']['view']['list'] = array (
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
          'type' => 'status',
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
          'name' => 'phone_work',
          'label' => 'LBL_LIST_PHONE',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'email',
          'label' => 'LBL_LIST_EMAIL_ADDRESS',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_LIST_ASSIGNED_USER',
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
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'default' => true,
          'readonly' => true,
        ),
        8 => 
        array (
          'name' => 'title',
          'label' => 'LBL_TITLE',
          'enabled' => true,
          'default' => false,
        ),
        9 => 
        array (
          'name' => 'department',
          'label' => 'LBL_DEPARTMENT',
          'enabled' => true,
          'default' => false,
        ),
        10 => 
        array (
          'name' => 'last_interaction_date_c',
          'label' => 'LBL_LAST_INTERACTION_DATE',
          'enabled' => true,
          'default' => false,
        ),
        11 => 
        array (
          'name' => 'lead_source',
          'label' => 'LBL_LEAD_SOURCE',
          'enabled' => true,
          'default' => false,
        ),
        12 => 
        array (
          'name' => 'phone_home',
          'label' => 'LBL_HOME_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        13 => 
        array (
          'name' => 'phone_mobile',
          'label' => 'LBL_MOBILE_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        14 => 
        array (
          'name' => 'phone_other',
          'label' => 'LBL_OTHER_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        15 => 
        array (
          'name' => 'phone_fax',
          'label' => 'LBL_FAX_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        16 => 
        array (
          'name' => 'do_not_call',
          'label' => 'LBL_DO_NOT_CALL',
          'enabled' => true,
          'default' => false,
        ),
        17 => 
        array (
          'name' => 'primary_address_street',
          'label' => 'LBL_PRIMARY_ADDRESS_STREET',
          'enabled' => true,
          'sortable' => false,
          'default' => false,
        ),
        18 => 
        array (
          'name' => 'primary_address_city',
          'label' => 'LBL_PRIMARY_ADDRESS_CITY',
          'enabled' => true,
          'default' => false,
        ),
        19 => 
        array (
          'name' => 'primary_address_state',
          'label' => 'LBL_PRIMARY_ADDRESS_STATE',
          'enabled' => true,
          'default' => false,
        ),
        20 => 
        array (
          'name' => 'primary_address_postalcode',
          'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
          'enabled' => true,
          'default' => false,
        ),
        21 => 
        array (
          'name' => 'primary_address_country',
          'label' => 'LBL_PRIMARY_ADDRESS_COUNTRY',
          'enabled' => true,
          'default' => false,
        ),
        22 => 
        array (
          'name' => 'converted_opp_name',
          'label' => 'LBL_CONVERTED_OPPORTUNITY_NAME',
          'enabled' => true,
          'related_fields' => 
          array (
            0 => 'opportunity_id',
          ),
          'id' => 'OPPORTUNITY_ID',
          'link' => true,
          'sortable' => false,
          'default' => false,
        ),
        23 => 
        array (
          'name' => 'distance',
          'label' => 'Distance',
          'enabled' => true,
          'readonly' => true,
          'default' => false,
        ),
        24 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
          'default' => false,
        ),
        25 => 
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => false,
        ),
        26 => 
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