<?php
// created: 2022-12-12 04:51:09
$viewdefs['Leads']['base']['view']['recorddashlet'] = array (
  'buttons' => 
  array (
    0 => 
    array (
      'type' => 'button',
      'name' => 'cancel_button',
      'label' => 'LBL_CANCEL_BUTTON_LABEL',
      'css_class' => 'btn-invisible btn-link',
      'showOn' => 'edit',
      'events' => 
      array (
        'click' => 'button:cancel_button:click',
      ),
    ),
    1 => 
    array (
      'type' => 'rowaction',
      'event' => 'button:save_button:click',
      'name' => 'save_button',
      'label' => 'LBL_SAVE_BUTTON_LABEL',
      'css_class' => 'btn btn-primary',
      'showOn' => 'edit',
      'acl_action' => 'edit',
    ),
    2 => 
    array (
      'type' => 'actiondropdown',
      'name' => 'main_dropdown',
      'primary' => true,
      'showOn' => 'view',
      'buttons' => 
      array (
        0 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:edit_button:click',
          'name' => 'edit_button',
          'label' => 'LBL_EDIT_BUTTON_LABEL',
          'acl_action' => 'edit',
        ),
      ),
    ),
    3 => 
    array (
      'name' => 'sidebar_toggle',
      'type' => 'sidebartoggle',
    ),
  ),
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'header' => true,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'picture',
          'type' => 'avatar',
          'size' => 'large',
          'dismiss_label' => true,
        ),
        1 => 
        array (
          'name' => 'name',
          'type' => 'fullname',
          'label' => 'LBL_NAME',
          'dismiss_label' => true,
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'salutation',
              'type' => 'enum',
              'enum_width' => 'auto',
              'searchBarThreshold' => 7,
            ),
            1 => 'first_name',
            2 => 'last_name',
          ),
        ),
      ),
    ),
    1 => 
    array (
      'name' => 'panel_body',
      'label' => 'LBL_RECORD_BODY',
      'columns' => 2,
      'labels' => true,
      'placeholders' => true,
      'newTab' => true,
      'panelDefault' => 'expanded',
      'fields' => 
      array (
        0 => 'account_name',
        1 => 'title',
        2 => 
        array (
          'name' => 'status',
          'type' => 'status',
        ),
        3 => 
        array (
          'name' => 'assigned_user_name',
        ),
        4 => 'lead_source',
        5 => 'lead_source_description',
        6 => 'phone_work',
        7 => 'phone_fax',
        8 => 'phone_mobile',
        9 => 'do_not_call',
        10 => 'email',
        11 => 
        array (
          'name' => 'website',
        ),
        12 => 
        array (
          'name' => 'last_interaction_date_c',
          'label' => 'LBL_LAST_INTERACTION_DATE',
        ),
        13 => 
        array (
        ),
        14 => 
        array (
          'name' => 'tag',
          'span' => 12,
        ),
      ),
    ),
    2 => 
    array (
      'name' => 'panel_hidden',
      'label' => 'LBL_RECORD_SHOWMORE',
      'hide' => true,
      'columns' => 2,
      'labels' => true,
      'placeholders' => true,
      'newTab' => true,
      'panelDefault' => 'expanded',
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'primary_address',
          'type' => 'fieldset',
          'css_class' => 'address',
          'label' => 'LBL_PRIMARY_ADDRESS',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'primary_address_street',
              'css_class' => 'address_street',
              'placeholder' => 'LBL_PRIMARY_ADDRESS_STREET',
            ),
            1 => 
            array (
              'name' => 'primary_address_city',
              'css_class' => 'address_city',
              'placeholder' => 'LBL_PRIMARY_ADDRESS_CITY',
            ),
            2 => 
            array (
              'name' => 'primary_address_state',
              'css_class' => 'address_state',
              'placeholder' => 'LBL_PRIMARY_ADDRESS_STATE',
            ),
            3 => 
            array (
              'name' => 'primary_address_postalcode',
              'css_class' => 'address_zip',
              'placeholder' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
            ),
            4 => 
            array (
              'name' => 'primary_address_country',
              'css_class' => 'address_country',
              'placeholder' => 'LBL_PRIMARY_ADDRESS_COUNTRY',
            ),
          ),
        ),
        1 => 
        array (
          'name' => 'alt_address',
          'type' => 'fieldset',
          'css_class' => 'address',
          'label' => 'LBL_ALT_ADDRESS',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'alt_address_street',
              'css_class' => 'address_street',
              'placeholder' => 'LBL_ALT_ADDRESS_STREET',
            ),
            1 => 
            array (
              'name' => 'alt_address_city',
              'css_class' => 'address_city',
              'placeholder' => 'LBL_ALT_ADDRESS_CITY',
            ),
            2 => 
            array (
              'name' => 'alt_address_state',
              'css_class' => 'address_state',
              'placeholder' => 'LBL_ALT_ADDRESS_STATE',
            ),
            3 => 
            array (
              'name' => 'alt_address_postalcode',
              'css_class' => 'address_zip',
              'placeholder' => 'LBL_ALT_ADDRESS_POSTALCODE',
            ),
            4 => 
            array (
              'name' => 'alt_address_country',
              'css_class' => 'address_country',
              'placeholder' => 'LBL_ALT_ADDRESS_COUNTRY',
            ),
            5 => 
            array (
              'name' => 'copy',
              'label' => 'NTC_COPY_PRIMARY_ADDRESS',
              'type' => 'copy',
              'mapping' => 
              array (
                'primary_address_street' => 'alt_address_street',
                'primary_address_city' => 'alt_address_city',
                'primary_address_state' => 'alt_address_state',
                'primary_address_postalcode' => 'alt_address_postalcode',
                'primary_address_country' => 'alt_address_country',
              ),
            ),
          ),
        ),
      ),
    ),
    3 => 
    array (
      'newTab' => false,
      'panelDefault' => 'collapsed',
      'name' => 'LBL_RECORDVIEW_PANEL2',
      'label' => 'LBL_RECORDVIEW_PANEL2',
      'columns' => 2,
      'placeholders' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'wmaps_balloon_c',
          'studio' => 'visible',
          'label' => 'LBL_WMAPS_BALLOON',
        ),
        1 => 
        array (
          'name' => 'gc_latitude_c',
          'readonly' => true,
          'label' => 'LBL_GC_LATITUDE',
        ),
        2 => 
        array (
          'name' => 'gc_date_c',
          'label' => 'LBL_GC_DATE',
        ),
        3 => 
        array (
          'name' => 'gc_longitude_c',
          'readonly' => true,
          'label' => 'LBL_GC_LONGITUDE',
        ),
        4 => 
        array (
          'name' => 'gc_status_c',
          'studio' => 'visible',
          'label' => 'LBL_GC_STATUS',
        ),
        5 => 
        array (
          'name' => 'gc_status_detail_c',
          'label' => 'LBL_GC_STATUS_DETAIL',
        ),
      ),
    ),
    4 => 
    array (
      'newTab' => true,
      'panelDefault' => 'expanded',
      'name' => 'LBL_RECORDVIEW_PANEL1',
      'label' => 'LBL_RECORDVIEW_PANEL1',
      'columns' => 2,
      'placeholders' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'date_entered_by',
          'readonly' => true,
          'inline' => true,
          'type' => 'fieldset',
          'label' => 'LBL_DATE_ENTERED',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'date_entered',
            ),
            1 => 
            array (
              'type' => 'label',
              'default_value' => 'LBL_BY',
            ),
            2 => 
            array (
              'name' => 'created_by_name',
            ),
          ),
        ),
        1 => 
        array (
          'name' => 'date_modified_by',
          'readonly' => true,
          'inline' => true,
          'type' => 'fieldset',
          'label' => 'LBL_DATE_MODIFIED',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'date_modified',
            ),
            1 => 
            array (
              'type' => 'label',
              'default_value' => 'LBL_BY',
            ),
            2 => 
            array (
              'name' => 'modified_by_name',
            ),
          ),
        ),
        2 => 
        array (
          'name' => 'team_name',
        ),
        3 => 
        array (
        ),
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'useTabs' => true,
  ),
);