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
$object_name = 'Order_RQ_Order';
$_module_name = 'order_rq_order';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => $_module_name.'.name',
						'whereClauses' => 
							array('name' => $_module_name.'.name', 
									'billing_address_city' => $_module_name.'.billing_address_city',
									'phone_office' => $_module_name.'.phone_office'),
						'searchInputs' =>
							array('name', 
								  'billing_address_city',
								  'phone_office',
								  'industry'
								  
							),
						);
