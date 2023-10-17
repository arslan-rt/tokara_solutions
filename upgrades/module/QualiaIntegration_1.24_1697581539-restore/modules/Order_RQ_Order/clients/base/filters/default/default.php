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

$module_name                                             = 'Order_RQ_Order';
$_module_name                                            = 'order_rq_order';
$viewdefs['Order_RQ_Order']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields'         => array(
        'name'                      => array(
        ),
        'assigned_user_name'        => array(
        ),
        'order_status'              => array(
        ),
        'order_number'              => array(
        ),
        'listing_agent_sales_reps'  => array(
        ),
        'selling_agent_sales_reps'  => array(
        ),
        'listing_agent_credit_reps' => array(
        ),
        'selling_agent_credit_reps' => array(
        ),
        'escrow_closer'             => array(
        ),
        'title_officer'             => array(
        ),
        'marketer'                  => array(
        ),
        'transaction_type'          => array(
        ),
        'opened_date_for_order_c'   => array(
        ),
        'purchase_price'            => array(
        ),
        'date_entered'              => array(
        ),
        'created_by_name'           => array(
        ),
        'modified_by_name'          => array(
        ),
        'date_modified'             => array(
        ),
        '$owner'                    => array(
            'predefined_filter' => true,
            'vname'             => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite'                 => array(
            'predefined_filter' => true,
            'vname'             => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
