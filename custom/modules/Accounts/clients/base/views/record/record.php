<?php
// created: 2022-12-12 04:51:08
$viewdefs['Accounts']['base']['view']['record'] = array (
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
        1 => 
        array (
          'type' => 'escalate-action',
          'event' => 'button:escalate_button:click',
          'name' => 'escalate_button',
          'label' => 'LBL_ESCALATE_BUTTON_LABEL',
          'acl_action' => 'create',
        ),
        2 => 
        array (
          'type' => 'shareaction',
          'name' => 'share',
          'label' => 'LBL_RECORD_SHARE_BUTTON',
          'acl_action' => 'view',
        ),
        3 => 
        array (
          'type' => 'pdfaction',
          'name' => 'download-pdf',
          'label' => 'LBL_PDF_VIEW',
          'action' => 'download',
          'acl_action' => 'view',
        ),
        4 => 
        array (
          'type' => 'pdfaction',
          'name' => 'email-pdf',
          'label' => 'LBL_PDF_EMAIL',
          'action' => 'email',
          'acl_action' => 'view',
        ),
        5 => 
        array (
          'type' => 'divider',
        ),
        6 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:find_duplicates_button:click',
          'name' => 'find_duplicates_button',
          'label' => 'LBL_DUP_MERGE',
          'acl_action' => 'edit',
        ),
        7 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:duplicate_button:click',
          'name' => 'duplicate_button',
          'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
          'acl_module' => 'Accounts',
          'acl_action' => 'create',
        ),
        8 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:historical_summary_button:click',
          'name' => 'historical_summary_button',
          'label' => 'LBL_HISTORICAL_SUMMARY',
          'acl_action' => 'view',
        ),
        9 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:audit_button:click',
          'name' => 'audit_button',
          'label' => 'LNK_VIEW_CHANGE_LOG',
          'acl_action' => 'view',
        ),
        10 => 
        array (
          'type' => 'divider',
        ),
        11 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:delete_button:click',
          'name' => 'delete_button',
          'label' => 'LBL_DELETE_BUTTON_LABEL',
          'acl_action' => 'delete',
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
      'label' => 'LBL_PANEL_HEADER',
      'header' => true,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'picture',
          'type' => 'avatar',
          'size' => 'large',
          'dismiss_label' => true,
          'readonly' => true,
          'white_list' => true,
          'licenseDependency' => 
          array (
            'HINT' => 
            array (
              'name' => 'hint_account_pic',
              'type' => 'hint-accounts-logo',
            ),
          ),
        ),
        1 => 
        array (
          'name' => 'name',
          'type' => 'name',
          'licenseDependency' => 
          array (
            'HINT' => 
            array (
              'type' => 'hint-accounts-search-dropdown',
            ),
          ),
        ),
        2 => 
        array (
          'name' => 'favorite',
          'label' => 'LBL_FAVORITE',
          'type' => 'favorite',
          'dismiss_label' => true,
        ),
        3 => 
        array (
          'name' => 'follow',
          'label' => 'LBL_FOLLOW',
          'type' => 'follow',
          'readonly' => true,
          'dismiss_label' => true,
        ),
        4 => 
        array (
          'name' => 'is_escalated',
          'type' => 'badge',
          'badge_label' => 'LBL_ESCALATED',
          'warning_level' => 'important',
          'dismiss_label' => true,
        ),
      ),
    ),
    1 => 
    array (
      'name' => 'panel_body',
      'label' => 'LBL_RECORD_BODY',
      'columns' => 2,
      'placeholders' => true,
      'newTab' => true,
      'panelDefault' => 'expanded',
      'fields' => 
      array (
        0 => 'phone_office',
        1 => 'phone_fax',
        2 => 
        array (
          'name' => 'phone_alternate',
          'label' => 'LBL_PHONE_ALT',
        ),
        3 => 
        array (
        ),
        4 => 
        array (
          'name' => 'billing_address',
          'type' => 'fieldset',
          'css_class' => 'address',
          'label' => 'LBL_BILLING_ADDRESS',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'billing_address_street',
              'css_class' => 'address_street',
              'placeholder' => 'LBL_BILLING_ADDRESS_STREET',
            ),
            1 => 
            array (
              'name' => 'billing_address_city',
              'css_class' => 'address_city',
              'placeholder' => 'LBL_BILLING_ADDRESS_CITY',
            ),
            2 => 
            array (
              'name' => 'billing_address_state',
              'css_class' => 'address_state',
              'placeholder' => 'LBL_BILLING_ADDRESS_STATE',
            ),
            3 => 
            array (
              'name' => 'billing_address_postalcode',
              'css_class' => 'address_zip',
              'placeholder' => 'LBL_BILLING_ADDRESS_POSTALCODE',
            ),
            4 => 
            array (
              'name' => 'billing_address_country',
              'css_class' => 'address_country',
              'placeholder' => 'LBL_BILLING_ADDRESS_COUNTRY',
            ),
          ),
        ),
        5 => 
        array (
          'name' => 'shipping_address',
          'type' => 'fieldset',
          'css_class' => 'address',
          'label' => 'LBL_SHIPPING_ADDRESS',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'shipping_address_street',
              'css_class' => 'address_street',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_STREET',
            ),
            1 => 
            array (
              'name' => 'shipping_address_city',
              'css_class' => 'address_city',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_CITY',
            ),
            2 => 
            array (
              'name' => 'shipping_address_state',
              'css_class' => 'address_state',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_STATE',
            ),
            3 => 
            array (
              'name' => 'shipping_address_postalcode',
              'css_class' => 'address_zip',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_POSTALCODE',
            ),
            4 => 
            array (
              'name' => 'shipping_address_country',
              'css_class' => 'address_country',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_COUNTRY',
            ),
            5 => 
            array (
              'name' => 'copy',
              'label' => 'NTC_COPY_BILLING_ADDRESS',
              'type' => 'copy',
              'mapping' => 
              array (
                'billing_address_street' => 'shipping_address_street',
                'billing_address_city' => 'shipping_address_city',
                'billing_address_state' => 'shipping_address_state',
                'billing_address_postalcode' => 'shipping_address_postalcode',
                'billing_address_country' => 'shipping_address_country',
              ),
            ),
          ),
        ),
        6 => 'email',
        7 => 
        array (
          'name' => 'website',
        ),
        8 => 
        array (
          'name' => 'description',
          'span' => 12,
        ),
        9 => 
        array (
          'name' => 'tag',
          'span' => 12,
        ),
      ),
    ),
    2 => 
    array (
      'newTab' => false,
      'panelDefault' => 'collapsed',
      'name' => 'LBL_RECORDVIEW_PANEL1',
      'label' => 'LBL_RECORDVIEW_PANEL1',
      'columns' => 2,
      'placeholders' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'party_types',
          'readonly' => false,
          'label' => 'LBL_PARTY_TYPES',
        ),
        1 => 
        array (
        ),
        2 => 
        array (
          'name' => 'national_license_id',
          'readonly' => true,
          'label' => 'LBL_NATIONAL_LICENSE_ID',
        ),
        3 => 
        array (
        ),
        4 => 
        array (
          'name' => 'state_license_id',
          'readonly' => true,
          'label' => 'LBL_STATE_LICENSE_ID',
        ),
        5 => 
        array (
          'name' => 'state_license_state',
          'readonly' => true,
          'label' => 'LBL_STATE_LICENSE_STATE',
        ),
        6 => 
        array (
          'name' => 'geocode_status',
          'licenseFilter' => 
          array (
            0 => 'MAPS',
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
        6 => 'hint_account_size',
        7 => 'hint_account_industry',
        8 => 'hint_account_location',
        9 => 'hint_account_founded_year',
        10 => 'hint_account_industry_tags',
        11 => 'hint_account_naics_code_lbl',
        12 => 'hint_account_fiscal_year_end',
        13 => 
        array (
          'name' => 'hint_account_facebook_handle',
          'type' => 'stage2_url',
        ),
        14 => 
        array (
          'name' => 'hint_account_logo',
          'type' => 'stage2_image',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
          'fields' => 
          array (
            0 => 'hint_account_pic',
          ),
        ),
      ),
    ),
    4 => 
    array (
      'name' => 'panel_hint',
      'label' => 'LBL_HINT_PANEL',
      'columns' => 2,
      'labels' => true,
      'labelsOnTop' => true,
      'placeholders' => true,
      'fields' => 
      array (
        0 => 'hint_account_size',
        1 => 'hint_account_industry',
        2 => 'hint_account_location',
        3 => 'hint_account_founded_year',
        4 => 'hint_account_industry_tags',
        5 => 'hint_account_naics_code_lbl',
        6 => 'hint_account_fiscal_year_end',
        7 => 
        array (
          'name' => 'hint_account_facebook_handle',
          'type' => 'stage2_url',
        ),
        8 => 
        array (
          'name' => 'hint_account_logo',
          'type' => 'stage2_image',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
          'fields' => 
          array (
            0 => 'hint_account_pic',
          ),
        ),
      ),
      'licenseFilter' => 
      array (
        0 => 'HINT',
      ),
    ),
    5 => 
    array (
      'newTab' => true,
      'panelDefault' => 'expanded',
      'name' => 'LBL_RECORDVIEW_PANEL3',
      'label' => 'LBL_RECORDVIEW_PANEL3',
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
          'name' => 'assigned_user_name',
        ),
        3 => 
        array (
          'name' => 'team_name',
        ),
        4 => 
        array (
          'name' => 'qualia_id',
          'readonly' => true,
          'studio' => 
          array (
            'recordview' => true,
            'wirelessdetailview' => true,
            'listview' => true,
            'wirelesseditview' => true,
            'wirelesslistview' => true,
            'wireless_basic_search' => true,
            'wireless_advanced_search' => true,
            'portallistview' => true,
            'portalrecordview' => true,
            'portaleditview' => true,
          ),
          'label' => 'LBL_QUALIA_ID',
        ),
        5 => 
        array (
          'name' => 'qualia_diff_hash',
          'label' => 'Qualia Diff Id',
          'readonly' => true,
        ),
        6 => 
        array (
          'name' => 'qualia_unique_hash',
          'label' => 'Qualia Unique Id',
          'readonly' => true,
        ),
        7 => 
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