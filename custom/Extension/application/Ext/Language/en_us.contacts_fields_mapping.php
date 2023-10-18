<?php

$app_list_strings['contacts_fields_mapping'] = array(
    'id' => 'qualia_id',
    'firstName' => 'first_name',
    'lastName' => 'last_name',
    'jobTitle' => 'title',
    'cellPhone' => 'phone_mobile',
    'email' => 'email1',
    'dateOfBirth' => 'birthdate',
    'nationalLicenseID' => 'national_license_id',
    'stateLicenseIDs' => [
      'id' => 'state_license_id',
      'state' => 'state_license_state'
    ],
    'currentAddress' => [
      'address1:address2' =>  'primary_address_street',
      'zipcode' => 'primary_address_postalcode',
      'city' => 'primary_address_city',
      'state' => 'primary_address_state',
      'county' => 'primary_address_country'
    ],
    'forwardingAddress' => [
      'address1' => 'alt_address_street',
      'address2' => 'alt_address_street_2',
      'zipcode' => 'alt_address_postalcode',
      'city' => 'alt_address_city',
      'state' => 'alt_address_state',
      'county' => 'alt_address_country'
    ]
  );
  