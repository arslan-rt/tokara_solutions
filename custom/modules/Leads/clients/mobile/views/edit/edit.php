<?php
// created: 2022-12-12 04:51:09
$viewdefs['Leads']['mobile']['view']['edit'] = array (
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
          'name' => 'first_name',
          'customCode' => '{html_options name="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          'displayParams' => 
          array (
            'wireless_edit_only' => true,
          ),
        ),
        1 => 
        array (
          'name' => 'last_name',
          'displayParams' => 
          array (
            'wireless_edit_only' => true,
          ),
        ),
        2 => 'account_name',
        3 => 'title',
        4 => 'status',
        5 => 
        array (
          'readonly' => false,
          'name' => 'last_interaction_date_c',
          'label' => 'LBL_LAST_INTERACTION_DATE',
        ),
        6 => 'phone_work',
        7 => 
        array (
          'name' => 'phone_fax',
          'comment' => 'Contact fax number',
          'label' => 'LBL_FAX_PHONE',
        ),
        8 => 'phone_mobile',
        9 => 'email',
        10 => 
        array (
          'name' => 'lead_source',
          'comment' => 'Lead source (ex: Web, print)',
          'label' => 'LBL_LEAD_SOURCE',
        ),
        11 => 
        array (
          'name' => 'lead_source_description',
          'comment' => 'Description of the lead source',
          'label' => 'LBL_LEAD_SOURCE_DESCRIPTION',
        ),
        12 => 'primary_address_street',
        13 => 'primary_address_city',
        14 => 'primary_address_state',
        15 => 'primary_address_postalcode',
        16 => 'primary_address_country',
        17 => 
        array (
          'name' => 'alt_address_street',
          'comment' => 'Street address for alternate address',
          'label' => 'LBL_ALT_ADDRESS_STREET',
        ),
        18 => 
        array (
          'name' => 'alt_address_city',
          'comment' => 'City for alternate address',
          'label' => 'LBL_ALT_ADDRESS_CITY',
        ),
        19 => 
        array (
          'name' => 'alt_address_state',
          'comment' => 'State for alternate address',
          'label' => 'LBL_ALT_ADDRESS_STATE',
        ),
        20 => 
        array (
          'name' => 'alt_address_postalcode',
          'comment' => 'Postal code for alternate address',
          'label' => 'LBL_ALT_ADDRESS_POSTALCODE',
        ),
        21 => 
        array (
          'name' => 'alt_address_country',
          'comment' => 'Country for alternate address',
          'label' => 'LBL_ALT_ADDRESS_COUNTRY',
        ),
        22 => 'tag',
        23 => 'assigned_user_name',
        24 => 'team_name',
      ),
    ),
  ),
);