<?php
// created: 2022-12-12 04:51:08
$viewdefs['Calls']['base']['view']['list'] = array (
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
          'label' => 'LBL_LIST_SUBJECT',
          'enabled' => true,
          'default' => true,
          'link' => true,
          'name' => 'name',
          'related_fields' => 
          array (
            0 => 'repeat_type',
          ),
        ),
        1 => 
        array (
          'enabled' => true,
          'default' => true,
          'name' => 'status',
          'type' => 'event-status',
          'css_class' => 'full-width',
        ),
        2 => 
        array (
          'name' => 'meeting_type_c',
          'label' => 'LBL_MEETING_TYPE',
          'enabled' => true,
          'readonly' => false,
          'default' => true,
        ),
        3 => 
        array (
          'enabled' => true,
          'default' => true,
          'name' => 'direction',
        ),
        4 => 
        array (
          'name' => 'parent_name',
          'label' => 'LBL_LIST_RELATED_TO',
          'dynamic_module' => 'PARENT_TYPE',
          'id' => 'PARENT_ID',
          'link' => true,
          'enabled' => true,
          'default' => true,
          'sortable' => false,
          'ACLTag' => 'PARENT',
          'related_fields' => 
          array (
            0 => 'parent_id',
            1 => 'parent_type',
          ),
        ),
        5 => 
        array (
          'name' => 'date_start',
          'label' => 'LBL_LIST_DATE',
          'type' => 'datetimecombo-colorcoded',
          'css_class' => 'overflow-visible',
          'completed_status_value' => 'Held',
          'enabled' => true,
          'default' => true,
          'readonly' => true,
          'related_fields' => 
          array (
            0 => 'status',
          ),
        ),
        6 => 
        array (
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_LIST_ASSIGNED_USER',
          'enabled' => true,
          'default' => true,
          'sortable' => true,
        ),
        7 => 
        array (
          'name' => 'date_entered',
          'enabled' => true,
          'default' => true,
          'readonly' => true,
        ),
        8 => 
        array (
          'name' => 'date_end',
          'link' => false,
          'default' => false,
          'enabled' => true,
        ),
      ),
    ),
  ),
);