<?php
// created: 2019-01-10 13:51:34
$dictionary["order_rq_order_accounts"] = array(
    'true_relationship_type' => 'one-to-many',
    'relationships'          => array(
        'order_rq_order_accounts' => array(
            'lhs_module'        => 'Accounts',
            'lhs_table'         => 'accounts',
            'lhs_key'           => 'id',
            'rhs_module'        => 'Order_RQ_Order',
            'rhs_table'         => 'order_rq_order',
            'rhs_key'           => 'id',
            'relationship_type' => 'many-to-many',
            'join_table'        => 'order_rq_order_accounts_c',
            'join_key_lhs'      => 'order_rq_order_accountsaccounts_ida',
            'join_key_rhs'      => 'order_rq_order_accountsorder_rq_order_idb',
        ),
    ),
    'table'                  => 'order_rq_order_accounts_c',
    'fields'                 => array(
        'id'                                        => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'date_modified'                             => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted'                                   => array(
            'name'    => 'deleted',
            'type'    => 'bool',
            'default' => 0,
        ),
        'order_rq_order_accountsaccounts_ida'       => array(
            'name' => 'order_rq_order_accountsaccounts_ida',
            'type' => 'id',
        ),
        'order_rq_order_accountsorder_rq_order_idb' => array(
            'name' => 'order_rq_order_accountsorder_rq_order_idb',
            'type' => 'id',
        ),
    ),
    'indices'                => array(
        0 => array(
            'name'   => 'idx_order_rq_order_accounts_pk',
            'type'   => 'primary',
            'fields' => array(
                0 => 'id',
            ),
        ),
        1 => array(
            'name'   => 'idx_order_rq_order_accounts_ida1_deleted',
            'type'   => 'index',
            'fields' => array(
                0 => 'order_rq_order_accountsaccounts_ida',
                1 => 'deleted',
            ),
        ),
        2 => array(
            'name'   => 'idx_order_rq_order_accounts_idb2_deleted',
            'type'   => 'index',
            'fields' => array(
                0 => 'order_rq_order_accountsorder_rq_order_idb',
                1 => 'deleted',
            ),
        ),
        3 => array(
            'name'   => 'order_rq_order_accounts_alt',
            'type'   => 'alternate_key',
            'fields' => array(
                0 => 'order_rq_order_accountsorder_rq_order_idb',
            ),
        ),
    ),
);
