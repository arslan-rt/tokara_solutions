<?php
// created: 2022-12-12 04:51:09
$viewdefs['Contacts']['base']['view']['list'] = array (
  'panels' => 
  array (
    0 => 
    array (
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
          'name' => 'title',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'contact_type_c',
          'label' => 'LBL_CONTACT_TYPE',
          'enabled' => true,
          'readonly' => false,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'contacts_contacts_1_name',
          'label' => 'LBL_CONTACTS_CONTACTS_1_NAME_FIELD_TITLE',
          'enabled' => true,
          'id' => 'CONTACTS_CONTACTS_1CONTACTS_IDA',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'account_name',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'email',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'phone_mobile',
          'enabled' => true,
          'default' => true,
          'selected' => false,
        ),
        7 => 
        array (
          'name' => 'phone_work',
          'enabled' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'phone_other',
          'enabled' => true,
          'default' => true,
          'selected' => false,
        ),
        9 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_LIST_ASSIGNED_USER',
          'id' => 'ASSIGNED_USER_ID',
          'enabled' => true,
          'default' => true,
        ),
        10 => 
        array (
          'name' => 'date_modified',
          'enabled' => true,
          'default' => true,
        ),
        11 => 
        array (
          'name' => 'date_entered',
          'enabled' => true,
          'default' => true,
          'readonly' => true,
        ),
        12 => 
        array (
          'name' => 'first_name',
          'label' => 'LBL_FIRST_NAME',
          'enabled' => true,
          'default' => false,
        ),
        13 => 
        array (
          'name' => 'last_name',
          'label' => 'LBL_LAST_NAME',
          'enabled' => true,
          'default' => false,
        ),
        14 => 
        array (
          'name' => 'do_not_call',
          'label' => 'LBL_DO_NOT_CALL',
          'enabled' => true,
          'default' => false,
        ),
        15 => 
        array (
          'name' => 'phone_home',
          'label' => 'LBL_HOME_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        16 => 
        array (
          'name' => 'phone_fax',
          'label' => 'LBL_FAX_PHONE',
          'enabled' => true,
          'default' => false,
        ),
        17 => 
        array (
          'name' => 'tag',
          'label' => 'LBL_TAGS',
          'enabled' => true,
          'default' => false,
        ),
        18 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
          'default' => false,
        ),
        19 => 
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => false,
        ),
        20 => 
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