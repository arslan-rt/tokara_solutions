<?php
// created: 2022-12-12 04:51:09
$viewdefs['Contacts']['mobile']['view']['detail'] = array (
  'templateMeta' => 
  array (
    'maxColumns' => '1',
    'widths' => 
    array (
      0 => 
      array (
        'label' => '10',
        'field' => '30',
      ),
    ),
    'useTabs' => false,
  ),
  'panels' => 
  array (
    0 => 
    array (
      'label' => 'LBL_PANEL_DEFAULT',
      'newTab' => false,
      'panelDefault' => 'expanded',
      'name' => 'LBL_PANEL_DEFAULT',
      'columns' => '1',
      'placeholders' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'readonly' => false,
          'name' => 'contact_type_c',
          'label' => 'LBL_CONTACT_TYPE',
        ),
        1 => 'full_name',
        2 => 'account_name',
        3 => 'title',
        4 => 
        array (
          'name' => 'do_not_call',
          'comment' => 'An indicator of whether contact can be called',
          'label' => 'LBL_DO_NOT_CALL',
        ),
        5 => 'phone_work',
        6 => 
        array (
          'name' => 'phone_fax',
          'comment' => 'Contact fax number',
          'label' => 'LBL_FAX_PHONE',
        ),
        7 => 'phone_mobile',
        8 => 'email',
        9 => 'primary_address_street',
        10 => 'primary_address_city',
        11 => 'primary_address_state',
        12 => 'primary_address_postalcode',
        13 => 'primary_address_country',
        14 => 'alt_address_street',
        15 => 'alt_address_city',
        16 => 'alt_address_state',
        17 => 'alt_address_postalcode',
        18 => 'alt_address_country',
        19 => 
        array (
          'name' => 'description',
          'comment' => 'Full text of the note',
          'label' => 'LBL_DESCRIPTION',
        ),
        20 => 'tag',
        21 => 'assigned_user_name',
        22 => 'team_name',
        23 => 
        array (
          'name' => 'date_entered',
          'comment' => 'Date record created',
          'studio' => 
          array (
            'portaleditview' => false,
          ),
          'readonly' => true,
          'label' => 'LBL_DATE_ENTERED',
        ),
        24 => 
        array (
          'name' => 'created_by_name',
          'readonly' => true,
          'label' => 'LBL_CREATED',
        ),
        25 => 
        array (
          'name' => 'date_modified',
          'comment' => 'Date record last modified',
          'studio' => 
          array (
            'portaleditview' => false,
          ),
          'readonly' => true,
          'label' => 'LBL_DATE_MODIFIED',
        ),
        26 => 
        array (
          'name' => 'modified_by_name',
          'readonly' => true,
          'label' => 'LBL_MODIFIED',
        ),
      ),
    ),
  ),
);