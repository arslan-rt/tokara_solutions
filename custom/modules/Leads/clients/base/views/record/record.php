<?php
// created: 2022-12-12 04:51:09
$viewdefs['Leads']['base']['view']['record'] = array (
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
          'type' => 'shareaction',
          'name' => 'share',
          'label' => 'LBL_RECORD_SHARE_BUTTON',
          'acl_action' => 'view',
        ),
        2 => 
        array (
          'type' => 'pdfaction',
          'name' => 'download-pdf',
          'label' => 'LBL_PDF_VIEW',
          'action' => 'download',
          'acl_action' => 'view',
        ),
        3 => 
        array (
          'type' => 'pdfaction',
          'name' => 'email-pdf',
          'label' => 'LBL_PDF_EMAIL',
          'action' => 'email',
          'acl_action' => 'view',
        ),
        4 => 
        array (
          'type' => 'divider',
        ),
        5 => 
        array (
          'type' => 'convertbutton',
          'name' => 'lead_convert_button',
          'label' => 'LBL_CONVERT_BUTTON_LABEL',
          'acl_action' => 'edit',
        ),
        6 => 
        array (
          'type' => 'manage-subscription',
          'name' => 'manage_subscription_button',
          'label' => 'LBL_MANAGE_SUBSCRIPTIONS',
          'acl_action' => 'view',
        ),
        7 => 
        array (
          'type' => 'vcard',
          'name' => 'vcard_button',
          'label' => 'LBL_VCARD_DOWNLOAD',
          'acl_action' => 'view',
        ),
        8 => 
        array (
          'type' => 'divider',
        ),
        9 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:find_duplicates_button:click',
          'name' => 'find_duplicates_button',
          'label' => 'LBL_DUP_MERGE',
          'acl_action' => 'edit',
        ),
        10 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:duplicate_button:click',
          'name' => 'duplicate_button',
          'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
          'acl_module' => 'Leads',
          'acl_action' => 'create',
        ),
        11 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:historical_summary_button:click',
          'name' => 'historical_summary_button',
          'label' => 'LBL_HISTORICAL_SUMMARY',
          'acl_action' => 'view',
        ),
        12 => 
        array (
          'type' => 'rowaction',
          'event' => 'button:audit_button:click',
          'name' => 'audit_button',
          'label' => 'LNK_VIEW_CHANGE_LOG',
          'acl_action' => 'view',
        ),
        13 => 
        array (
          'type' => 'divider',
        ),
        14 => 
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
      'header' => true,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'picture',
          'type' => 'hint-contacts-photo',
          'size' => 'large',
          'dismiss_label' => true,
          'white_list' => true,
          'related_fields' => 
          array (
            0 => 'hint_contact_pic',
          ),
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
        2 => 
        array (
          'type' => 'favorite',
        ),
        3 => 
        array (
          'type' => 'follow',
          'readonly' => true,
        ),
        4 => 
        array (
          'name' => 'converted',
          'type' => 'badge',
          'dismiss_label' => true,
          'readonly' => true,
          'related_fields' => 
          array (
            0 => 'account_id',
            1 => 'account_name',
            2 => 'contact_id',
            3 => 'contact_name',
            4 => 'opportunity_id',
            5 => 'opportunity_name',
            6 => 'converted_opp_name',
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
        0 => 
        array (
          'name' => 'account_name',
        ),
        1 => 
        array (
        ),
        2 => 'title',
        3 => 'department',
        4 => 
        array (
          'name' => 'status',
          'type' => 'status',
        ),
        5 => 
        array (
          'name' => 'assigned_user_name',
        ),
        6 => 'phone_work',
        7 => 'phone_fax',
        8 => 
        array (
          'name' => 'phone_mobile',
        ),
        9 => 
        array (
        ),
        10 => 
        array (
          'name' => 'email',
          'licenseDependency' => 
          array (
            'HINT' => 
            array (
              'type' => 'hint-email',
            ),
          ),
        ),
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
          'name' => 'description',
          'span' => 12,
        ),
        15 => 
        array (
          'name' => 'tag',
          'span' => 12,
        ),
        16 => 'market_score',
      ),
    ),
    2 => 
    array (
      'newTab' => false,
      'panelDefault' => 'expanded',
      'name' => 'LBL_RECORDVIEW_PANEL3',
      'label' => 'LBL_RECORDVIEW_PANEL3',
      'columns' => 2,
      'placeholders' => 1,
      'fields' => 
      array (
        0 => 'lead_source',
        1 => 'lead_source_description',
        2 => 
        array (
          'name' => 'refered_by',
          'comment' => 'Identifies who refered the lead',
          'label' => 'LBL_REFERED_BY',
        ),
        3 => 
        array (
        ),
      ),
    ),
    3 => 
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
        2 => 'hint_education',
        3 => 
        array (
          'name' => 'hint_education_2',
          'parent_key' => 'hint_education',
        ),
        4 => 'hint_job_2',
        5 => 'hint_account_size',
        6 => 'hint_account_industry',
        7 => 'hint_account_location',
        8 => 
        array (
          'name' => 'hint_account_description',
          'account_key' => 'description',
        ),
        9 => 'hint_account_founded_year',
        10 => 
        array (
          'name' => 'hint_industry_tags',
          'account_key' => 'hint_account_industry_tags',
        ),
        11 => 'hint_account_naics_code_lbl',
        12 => 
        array (
          'name' => 'hint_account_sic_code_label',
          'account_key' => 'sic_code',
        ),
        13 => 'hint_account_fiscal_year_end',
        14 => 
        array (
          'name' => 'hint_account_annual_revenue',
          'account_key' => 'annual_revenue',
        ),
        15 => 
        array (
          'name' => 'hint_facebook',
          'type' => 'stage2_url',
        ),
        16 => 
        array (
          'name' => 'hint_twitter',
          'type' => 'stage2_url',
        ),
        17 => 
        array (
          'name' => 'hint_account_facebook_handle',
          'type' => 'stage2_url',
        ),
        18 => 
        array (
          'name' => 'hint_account_twitter_handle',
          'type' => 'stage2_url',
          'account_key' => 'twitter',
        ),
        19 => 
        array (
          'name' => 'phone_other',
          'type' => 'phone',
        ),
        20 => 
        array (
          'name' => 'hint_photo',
          'type' => 'stage2_image',
          'size' => 'large',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
        ),
        21 => 
        array (
          'name' => 'hint_account_logo',
          'type' => 'stage2_image',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
        ),
        22 => 
        array (
          'name' => 'hint_account_website',
          'type' => 'stage2_url',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
        ),
        23 => 
        array (
          'name' => 'geocode_status',
          'licenseFilter' => 
          array (
            0 => 'MAPS',
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
        0 => 'hint_education',
        1 => 
        array (
          'name' => 'hint_education_2',
          'parent_key' => 'hint_education',
        ),
        2 => 'hint_job_2',
        3 => 'hint_account_size',
        4 => 'hint_account_industry',
        5 => 'hint_account_location',
        6 => 
        array (
          'name' => 'hint_account_description',
          'account_key' => 'description',
        ),
        7 => 'hint_account_founded_year',
        8 => 
        array (
          'name' => 'hint_industry_tags',
          'account_key' => 'hint_account_industry_tags',
        ),
        9 => 'hint_account_naics_code_lbl',
        10 => 
        array (
          'name' => 'hint_account_sic_code_label',
          'account_key' => 'sic_code',
        ),
        11 => 'hint_account_fiscal_year_end',
        12 => 
        array (
          'name' => 'hint_account_annual_revenue',
          'account_key' => 'annual_revenue',
        ),
        13 => 
        array (
          'name' => 'hint_facebook',
          'type' => 'stage2_url',
        ),
        14 => 
        array (
          'name' => 'hint_twitter',
          'type' => 'stage2_url',
        ),
        15 => 
        array (
          'name' => 'hint_account_facebook_handle',
          'type' => 'stage2_url',
        ),
        16 => 
        array (
          'name' => 'hint_account_twitter_handle',
          'type' => 'stage2_url',
          'account_key' => 'twitter',
        ),
        17 => 
        array (
          'name' => 'phone_other',
          'type' => 'phone',
        ),
        18 => 
        array (
          'name' => 'hint_photo',
          'type' => 'stage2_image',
          'size' => 'large',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
        ),
        19 => 
        array (
          'name' => 'hint_account_logo',
          'type' => 'stage2_image',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
        ),
        20 => 
        array (
          'name' => 'hint_account_website',
          'type' => 'stage2_url',
          'readonly' => true,
          'dismiss_label' => true,
          'white_list' => true,
        ),
      ),
      'licenseFilter' => 
      array (
        0 => 'HINT',
      ),
    ),
    5 => 
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
    6 => 
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