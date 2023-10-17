<?php

$dictionary['Party_RQ_Party']['indices'][] = array(
    'name'   => 'index_rq_party_parent',
    'type'   => 'index',
    'fields' => array(
        'party_type',
        'parent_id',
    ),
);

$dictionary['Party_RQ_Party']['indices'][] = array(
    'name'   => 'index_rq_party_type_parent_id_parent_party_type',
    'type'   => 'index',
    'fields' => array(
        'party_type',
        'parent_id',
        'parent_party_type',
    ),
);
