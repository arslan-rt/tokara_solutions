<?php
$popupMeta = array (
    'moduleMain' => 'Lead',
    'varName' => 'LEAD',
    'orderBy' => 'last_name, first_name',
    'whereClauses' => array (
  'first_name' => 'leads.first_name',
  'last_name' => 'leads.last_name',
  'lead_source' => 'leads.lead_source',
  'status' => 'leads.status',
  'account_name' => 'leads.account_name',
  'assigned_user_id' => 'leads.assigned_user_id',
  'title' => 'leads.title',
  'email' => 'leads.email',
  'phone_work' => 'leads.phone_work',
  'phone_mobile' => 'leads.phone_mobile',
  'primary_address_city' => 'leads.primary_address_city',
  'primary_address_state' => 'leads.primary_address_state',
  'date_entered' => 'leads.date_entered',
  'created_by_name' => 'leads.created_by_name',
  'date_modified' => 'leads.date_modified',
  'modified_by_name' => 'leads.modified_by_name',
),
    'searchInputs' => array (
  0 => 'first_name',
  1 => 'last_name',
  2 => 'lead_source',
  3 => 'status',
  4 => 'account_name',
  5 => 'assigned_user_id',
  6 => 'title',
  7 => 'email',
  8 => 'phone_work',
  9 => 'phone_mobile',
  11 => 'primary_address_city',
  12 => 'primary_address_state',
  13 => 'date_entered',
  14 => 'created_by_name',
  15 => 'date_modified',
  16 => 'modified_by_name',
),
    'searchdefs' => array (
  'first_name' => 
  array (
    'name' => 'first_name',
    'width' => '10',
  ),
  'last_name' => 
  array (
    'name' => 'last_name',
    'width' => '10',
  ),
  'account_name' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACCOUNT_NAME',
    'width' => '10',
    'name' => 'account_name',
  ),
  'title' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TITLE',
    'width' => '10',
    'name' => 'title',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10',
  ),
  'email' => 
  array (
    'name' => 'email',
    'width' => '10',
  ),
  'phone_work' => 
  array (
    'type' => 'phone',
    'label' => 'LBL_OFFICE_PHONE',
    'width' => '10',
    'name' => 'phone_work',
  ),
  'phone_mobile' => 
  array (
    'type' => 'phone',
    'label' => 'LBL_MOBILE_PHONE',
    'width' => '10',
    'name' => 'phone_mobile',
  ),
  'lead_source' => 
  array (
    'name' => 'lead_source',
    'width' => '10',
  ),
  'primary_address_city' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'width' => '10',
    'name' => 'primary_address_city',
  ),
  'primary_address_state' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'width' => '10',
    'name' => 'primary_address_state',
  ),
  'assigned_user_id' => 
  array (
    'name' => 'assigned_user_id',
    'type' => 'enum',
    'label' => 'LBL_ASSIGNED_TO',
    'function' => 
    array (
      'name' => 'get_user_array',
      'params' => 
      array (
        0 => false,
      ),
    ),
    'width' => '10',
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10',
    'name' => 'date_entered',
  ),
  'created_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'readonly' => true,
    'label' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => '10',
    'name' => 'created_by_name',
  ),
  'date_modified' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10',
    'name' => 'date_modified',
  ),
  'modified_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'readonly' => true,
    'label' => 'LBL_MODIFIED',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10',
    'name' => 'modified_by_name',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
    'name' => 'name',
  ),
  'STATUS' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
    'name' => 'status',
  ),
  'ACCOUNT_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACCOUNT_NAME',
    'width' => 10,
    'default' => true,
    'name' => 'account_name',
  ),
  'TITLE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TITLE',
    'width' => 10,
    'default' => true,
  ),
  'PHONE_WORK' => 
  array (
    'type' => 'phone',
    'label' => 'LBL_OFFICE_PHONE',
    'width' => 10,
    'default' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'label' => 'LBL_DATE_MODIFIED',
    'width' => 10,
    'default' => true,
  ),
),
);
