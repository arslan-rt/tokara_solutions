<?php
$module_name            = 'Order_RQ_Order';
$_module_name           = 'order_rq_order';
$viewdefs[$module_name] =
array(
    'base' => array(
        'view' => array(
            'list' => array(
                'panels' => array(
                    0 => array(
                        'label'  => 'LBL_PANEL_DEFAULT',
                        'fields' => array(
                            0 => array(
                                'name'    => 'name',
                                'label'   => 'LBL_NAME',
                                'link'    => true,
                                'default' => true,
                                'enabled' => true,
                            ),
                            1 => array(
                                'name'    => 'order_status',
                                'label'   => 'LBL_ORDER_STATUS',
                                'enabled' => true,
                                'default' => true,
                            ),
                            3 => array(
                                'name'    => 'opened_date_for_order_c',
                                'label'   => 'Opened Date',
                                'enabled' => true,
                                'default' => false,
                            ),
                            4 => array(
                                'name'    => 'estimated_closing',
                                'enabled' => true,
                                'default' => true,
                            ),
                            5 => array(
                                'name'            => 'purchase_price',
                                'label'           => 'LBL_PURCHASE_PRICE',
                                'enabled'         => true,
                                'related_fields'  => array(
                                    0 => 'currency_id',
                                    1 => 'base_rate',
                                ),
                                'currency_format' => true,
                                'default'         => true,
                            ),
                            6 => array(
                                'name'    => 'assigned_user_name',
                                'label'   => 'LBL_ASSIGNED_TO_NAME',
                                'default' => false,
                                'enabled' => true,
                            ),
                            7 => array(
                                'name'    => 'date_entered',
                                'enabled' => true,
                                'default' => true,
                            ),
                            8 => array(
                                'name'    => 'date_modified',
                                'enabled' => true,
                                'default' => true,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
