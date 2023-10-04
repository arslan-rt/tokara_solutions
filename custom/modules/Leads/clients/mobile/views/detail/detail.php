<?php
// created: 2022-12-12 04:51:09
$viewdefs['Leads']['mobile']['view']['detail'] = array (
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
        0 => 'full_name',
        1 => 'account_name',
        2 => 'title',
        3 => 'status',
        4 => 
        array (
          'name' => 'last_interaction_date_c',
          'label' => 'LBL_LAST_INTERACTION_DATE',
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
        9 => 
        array (
          'name' => 'lead_source',
          'comment' => 'Lead source (ex: Web, print)',
          'label' => 'LBL_LEAD_SOURCE',
        ),
        10 => 
        array (
          'name' => 'lead_source_description',
          'comment' => 'Description of the lead source',
          'label' => 'LBL_LEAD_SOURCE_DESCRIPTION',
        ),
        11 => 'primary_address_street',
        12 => 'primary_address_city',
        13 => 'primary_address_state',
        14 => 'primary_address_postalcode',
        15 => 'primary_address_country',
        16 => 'alt_address_street',
        17 => 'alt_address_city',
        18 => 'alt_address_state',
        19 => 'alt_address_postalcode',
        20 => 'alt_address_country',
        21 => 'tag',
        22 => 'assigned_user_name',
        23 => 'team_name',
        24 => 
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
      ),
    ),
  ),
);