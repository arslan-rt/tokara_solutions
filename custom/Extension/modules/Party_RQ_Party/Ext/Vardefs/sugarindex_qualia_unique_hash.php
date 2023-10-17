<?php

$dictionary['Party_RQ_Party']['indices'][] = array(
    'name'   => 'qualia_unique_hash',
    'type'   => 'index',
    'fields' => array(
        'qualia_unique_hash',
    ),
);

$dictionary["Party_RQ_Party"]["indices"][] = array(
    "name"   => "index_qualia_unique_hash_deleted_index",
    "type"   => "index",
    "fields" => array(
        "qualia_unique_hash",
        "deleted",
    ),
);

$dictionary["Party_RQ_Party"]["indices"][] = array(
    "name"   => "index_qualia_id_index",
    "type"   => "index",
    "fields" => array(
        "qualia_id",
    ),
);

$dictionary["Party_RQ_Party"]["indices"][] = array(
    "name"   => "index_qualia_id_deleted_index",
    "type"   => "index",
    "fields" => array(
        "qualia_id",
        "deleted",
    ),
);

$dictionary["Party_RQ_Party"]["indices"][] = array(
    "name"   => "index_qualia_id_party_type_deleted_index",
    "type"   => "index",
    "fields" => array(
        "qualia_id",
        "party_type",
        "deleted",
    ),
);
