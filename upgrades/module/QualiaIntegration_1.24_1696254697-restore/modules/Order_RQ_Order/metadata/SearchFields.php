<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
$module_name = 'Order_RQ_Order';
// created: 2019-04-01 15:16:38
$searchFields[$module_name] = array(
  'name'                      => array(
    'query_type' => 'default',
  ),
  'account_type'              => array(
    'query_type'   => 'default',
    'options'      => 'account_type_dom',
    'template_var' => 'ACCOUNT_TYPE_OPTIONS',
  ),
  'industry'                  => array(
    'query_type'   => 'default',
    'options'      => 'industry_dom',
    'template_var' => 'INDUSTRY_OPTIONS',
  ),
  'annual_revenue'            => array(
    'query_type' => 'default',
  ),
  'address_street'            => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'billing_address_street',
      1 => 'shipping_address_street',
    ),
  ),
  'address_city'              => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'billing_address_city',
      1 => 'shipping_address_city',
    ),
  ),
  'address_state'             => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'billing_address_state',
      1 => 'shipping_address_state',
    ),
  ),
  'address_postalcode'        => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'billing_address_postalcode',
      1 => 'shipping_address_postalcode',
    ),
  ),
  'address_country'           => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'billing_address_country',
      1 => 'shipping_address_country',
    ),
  ),
  'rating'                    => array(
    'query_type' => 'default',
  ),
  'phone'                     => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'phone_office',
    ),
  ),
  'email'                     => array(
    'query_type' => 'default',
    'operator'   => 'subquery',
    'subquery'   => 'SELECT eabr.bean_id FROM email_addr_bean_rel eabr JOIN email_addresses ea ON (ea.id = eabr.email_address_id) WHERE eabr.deleted=0 AND ea.email_address LIKE',
    'db_field'   => array(
      0 => 'id',
    ),
    'vname'      => 'LBL_ANY_EMAIL',
  ),
  'website'                   => array(
    'query_type' => 'default',
  ),
  'ownership'                 => array(
    'query_type' => 'default',
  ),
  'employees'                 => array(
    'query_type' => 'default',
  ),
  'ticker_symbol'             => array(
    'query_type' => 'default',
  ),
  'current_user_only'         => array(
    'query_type' => 'default',
    'db_field'   => array(
      0 => 'assigned_user_id',
    ),
    'my_items'   => true,
    'vname'      => 'LBL_CURRENT_USER_FILTER',
    'type'       => 'bool',
  ),
  'assigned_user_id'          => array(
    'query_type' => 'default',
  ),
  'favorites_only'            => array(
    'query_type' => 'format',
    'operator'   => 'subquery',
    'subquery'   => 'SELECT sugarfavorites.record_id FROM sugarfavorites
			                    WHERE sugarfavorites.deleted=0
			                        and sugarfavorites.module = \'Order_RQ_Order\'
			                        and sugarfavorites.assigned_user_id = \'{0}\'',
    'db_field'   => array(
      0 => 'id',
    ),
  ),
  'range_date_entered'        => array(
    'query_type'          => 'default',
    'enable_range_search' => true,
    'is_date_field'       => true,
  ),
  'start_range_date_entered'  => array(
    'query_type'          => 'default',
    'enable_range_search' => true,
    'is_date_field'       => true,
  ),
  'end_range_date_entered'    => array(
    'query_type'          => 'default',
    'enable_range_search' => true,
    'is_date_field'       => true,
  ),
  'range_date_modified'       => array(
    'query_type'          => 'default',
    'enable_range_search' => true,
    'is_date_field'       => true,
  ),
  'start_range_date_modified' => array(
    'query_type'          => 'default',
    'enable_range_search' => true,
    'is_date_field'       => true,
  ),
  'end_range_date_modified'   => array(
    'query_type'          => 'default',
    'enable_range_search' => true,
    'is_date_field'       => true,
  ),
);
