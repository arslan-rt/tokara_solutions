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
$viewdefs['Users']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'first_name' => array(),
        'last_name' => array(),
        'address_city' => array(),
        'created_by_name' => array(),
        'email' => array(),
        'tag' => array(),
        'status' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
        'department' => [],
        'title' => [],
        'address_country' => [],
        'user_name' => [],
        'customer_journey_access' => [],
    ),
);
