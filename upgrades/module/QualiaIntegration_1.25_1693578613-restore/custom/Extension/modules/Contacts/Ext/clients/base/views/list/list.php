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

$viewdefs['Contacts']['base']['view']['list'] = array(
    'panels' => array(
        0 => array(
            'label'  => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name'    => 'name',
                    'type'    => 'fullname',
                    'fields'  => array(
                        'salutation',
                        'first_name',
                        'last_name',
                    ),
                    'link'    => true,
                    'label'   => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'    => 'account_name',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'    => 'email',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'    => 'phone_mobile',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'    => 'title',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'    => 'assigned_user_name',
                    'label'   => 'LBL_LIST_ASSIGNED_USER',
                    'id'      => 'ASSIGNED_USER_ID',
                    'enabled' => true,
                    'default' => false,
                ),
                array(
                    'name'    => 'date_modified',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'     => 'date_entered',
                    'enabled'  => true,
                    'default'  => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
