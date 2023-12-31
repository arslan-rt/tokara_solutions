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
 $_module_name = 'order_rq_order';
  $searchdefs[$module_name] = array(
					'templateMeta' => array(
							'maxColumns' => '3',
  							'maxColumnsBasic' => '4',
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
						'basic_search' => array(
						 	'name',
							array('name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'),
							array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
							),
						'advanced_search' => array(
							'name',
							array('name' => 'address_street', 'label' =>'LBL_ANY_ADDRESS', 'type' => 'name'),
							array('name' => 'phone', 'label' =>'LBL_ANY_PHONE', 'type' => 'name'),
							'website',
							array('name' => 'address_city', 'label' =>'LBL_CITY', 'type' => 'name'),
							array('name' => 'email', 'label' =>'LBL_ANY_EMAIL', 'type' => 'name'),
							'annual_revenue',
							array('name' => 'address_state', 'label' =>'LBL_STATE', 'type' => 'name'),
							'employees',
							'industry',
							array('name' => 'address_postalcode', 'label' =>'LBL_POSTAL_CODE', 'type' => 'name'),
							'ticker_symbol',
							$_module_name . '_type',
							array('name' => 'address_country', 'label' =>'LBL_COUNTRY', 'type' => 'name'),
							'rating',
							array('name' => 'assigned_user_id', 'type' => 'enum', 'label' => 'LBL_ASSIGNED_TO', 'function' => array('name' => 'get_user_array', 'params' => array(false))),
							'ownership',
							array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
						),
					),
 			   );
