<?php

$app_list_strings['acc_fields_mapping'] = array(
  'id' => 'qualia_id',
  'name' => 'name',
  // 'email' => 'email1',
  'nationalLicenseID' => 'national_license_id',
  'type' => 'account_type',
  'phone' => ['phone_office', 'phone_alternate'],
  'stateLicenseIDs' => [
    'id' => 'state_license_id',
    'state' => 'state_license_state'
  ],
  'primaryAddress' => [
      'address1' => 'billing_address_street',
      'address2' => 'billing_address_street_2',
      'zipcode' => 'billing_address_postalcode',
      'city' => 'billing_address_city',
      'state' => 'billing_address_state',
      'county' => 'billing_address_country',
  ],
  'mailingAddress' => [
      'address1' => 'shipping_address_street',
      'address2' => 'shipping_address_street_2',
      'zipcode' => 'shipping_address_postalcode',
      'city' => 'shipping_address_city',
      'state' => 'shipping_address_state',
      'county' => 'shipping_address_country',
  ],
);