<?php
// created: 2019-01-10 13:51:39
$dictionary["listg_listings_order_rq_order"] = array(
    'true_relationship_type' => 'one-to-many',
    'relationships'          => array(
        'listg_listings_order_rq_order' => array(
            'lhs_module'        => 'Order_RQ_Order',
            'lhs_table'         => 'order_rq_order',
            'lhs_key'           => 'id',
            'rhs_module'        => 'Listg_Listings',
            'rhs_table'         => 'listg_listings',
            'rhs_key'           => 'id',
            'relationship_type' => 'many-to-many',
            'join_table'        => 'listg_listings_order_rq_order_c',
            'join_key_lhs'      => 'listg_listings_order_rq_orderorder_rq_order_ida',
            'join_key_rhs'      => 'listg_listings_order_rq_orderlistg_listings_idb',
        ),
    ),
    'table'                  => 'listg_listings_order_rq_order_c',
    'fields'                 => array(
        'id'                                              => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'date_modified'                                   => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted'                                         => array(
            'name'    => 'deleted',
            'type'    => 'bool',
            'default' => 0,
        ),
        'listg_listings_order_rq_orderorder_rq_order_ida' => array(
            'name' => 'listg_listings_order_rq_orderorder_rq_order_ida',
            'type' => 'id',
        ),
        'listg_listings_order_rq_orderlistg_listings_idb' => array(
            'name' => 'listg_listings_order_rq_orderlistg_listings_idb',
            'type' => 'id',
        ),
    ),
    'indices'                => array(
        0 => array(
            'name'   => 'idx_listg_listings_order_rq_order_pk',
            'type'   => 'primary',
            'fields' => array(
                0 => 'id',
            ),
        ),
        1 => array(
            'name'   => 'idx_listg_listings_order_rq_order_ida1_deleted',
            'type'   => 'index',
            'fields' => array(
                0 => 'listg_listings_order_rq_orderorder_rq_order_ida',
                1 => 'deleted',
            ),
        ),
        2 => array(
            'name'   => 'idx_listg_listings_order_rq_order_idb2_deleted',
            'type'   => 'index',
            'fields' => array(
                0 => 'listg_listings_order_rq_orderlistg_listings_idb',
                1 => 'deleted',
            ),
        ),
        3 => array(
            'name'   => 'listg_listings_order_rq_order_alt',
            'type'   => 'alternate_key',
            'fields' => array(
                0 => 'listg_listings_order_rq_orderlistg_listings_idb',
            ),
        ),
    ),
);
