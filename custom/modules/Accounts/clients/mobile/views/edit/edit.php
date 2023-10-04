<?php
// created: 2022-12-12 04:51:08
$viewdefs['Accounts']['mobile']['view']['edit'] = array (
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
        11 => 
        array (
          'name' => 'shipping_address_street',
          'comment' => 'The street address used for for shipping purposes',
          'label' => 'LBL_SHIPPING_ADDRESS_STREET',
        ),
        12 => 
        array (
          'name' => 'shipping_address_city',
          'comment' => 'The city used for the shipping address',
          'label' => 'LBL_SHIPPING_ADDRESS_CITY',
        ),
        13 => 
        array (
          'name' => 'shipping_address_state',
          'comment' => 'The state used for the shipping address',
          'label' => 'LBL_SHIPPING_ADDRESS_STATE',
        ),
        14 => 
        array (
          'name' => 'shipping_address_postalcode',
          'comment' => 'The zip code used for the shipping address',
          'label' => 'LBL_SHIPPING_ADDRESS_POSTALCODE',
        ),
        15 => 
        array (
          'name' => 'shipping_address_country',
          'comment' => 'The country used for the shipping address',
          'label' => 'LBL_SHIPPING_ADDRESS_COUNTRY',
        ),
        16 => 
        array (
          'name' => 'description',
          'comment' => 'Full text of the note',
          'label' => 'LBL_DESCRIPTION',
        ),
        17 => 'tag',
        18 => 'assigned_user_name',
        19 => 'team_name',
      ),
    ),
  ),
);