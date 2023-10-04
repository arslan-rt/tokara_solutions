<?php
// created: 2022-12-12 04:51:08
$viewdefs['Accounts']['mobile']['view']['detail'] = array (
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
          'name' => 'name',
          'displayParams' => 
          array (
            'required' => true,
            'wireless_edit_only' => true,
          ),
        ),
        1 => 'phone_office',
        2 => 
        array (
          'name' => 'phone_alternate',
          'comment' => 'An alternate phone number',
          'label' => 'LBL_PHONE_ALT',
        ),
        3 => 
        array (
          'name' => 'phone_fax',
          'comment' => 'The fax phone number of this company',
          'label' => 'LBL_FAX',
        ),
        4 => 'email',
        5 => 
        array (
          'name' => 'website',
          'displayParams' => 
          array (
            'type' => 'link',
          ),
        ),
        6 => 'billing_address_street',
        7 => 'billing_address_city',
        8 => 'billing_address_state',
        9 => 'billing_address_postalcode',
        10 => 'billing_address_country',
        11 => 'shipping_address_street',
        12 => 'shipping_address_city',
        13 => 'shipping_address_state',
        14 => 'shipping_address_postalcode',
        15 => 'shipping_address_country',
        16 => 
        array (
          'name' => 'description',
          'comment' => 'Full text of the note',
          'label' => 'LBL_DESCRIPTION',
        ),
        17 => 'tag',
        18 => 'assigned_user_name',
        19 => 'team_name',
        20 => 
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
        21 => 
        array (
          'name' => 'created_by_name',
          'readonly' => true,
          'label' => 'LBL_CREATED',
        ),
        22 => 
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
        23 => 
        array (
          'name' => 'modified_by_name',
          'readonly' => true,
          'label' => 'LBL_MODIFIED',
        ),
      ),
    ),
  ),
);