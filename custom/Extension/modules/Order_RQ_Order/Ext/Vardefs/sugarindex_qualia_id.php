<?php

$dictionary['Order_RQ_Order']['indices'][] = array(
    'name'   => 'index_qualia_id_index',
    'type'   => 'index',
    'fields' => array(
        'qualia_id',
    ),
);

$dictionary['Order_RQ_Order']['indices'][] = array(
    'name'   => 'index_order_number_import_index',
    'type'   => 'index',
    'fields' => array(
        'order_number',
    ),
);
