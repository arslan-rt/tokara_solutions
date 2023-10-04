<?php
$dictionary["loans_loans_party_rq_party"] = array(
    'true_relationship_type' => 'one-to-one',
    'relationships'          => array(
        'loans_loans_party_rq_party' => array(
            'lhs_module'        => 'Loans_Loans',
            'lhs_table'         => 'loans_loans',
            'lhs_key'           => 'id',
            'rhs_module'        => 'Party_RQ_Party',
            'rhs_table'         => 'party_rq_party',
            'rhs_key'           => 'id',
            'relationship_type' => 'many-to-many',
            'join_table'        => 'loans_loans_party_rq_party_c',
            'join_key_lhs'      => 'loans_loans_party_rq_partyloans_loans_ida',
            'join_key_rhs'      => 'loans_loans_party_rq_partyparty_rq_party_idb',
        ),
    ),
    'table'                  => 'loans_loans_party_rq_party_c',
    'fields'                 => array(
        'id'                                           => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'date_modified'                                => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted'                                      => array(
            'name'    => 'deleted',
            'type'    => 'bool',
            'default' => 0,
        ),
        'loans_loans_party_rq_partyloans_loans_ida'    => array(
            'name' => 'loans_loans_party_rq_partyloans_loans_ida',
            'type' => 'id',
        ),
        'loans_loans_party_rq_partyparty_rq_party_idb' => array(
            'name' => 'loans_loans_party_rq_partyparty_rq_party_idb',
            'type' => 'id',
        ),
    ),
    'indices'                => array(
        0 => array(
            'name'   => 'idx_loans_loans_party_rq_party_pk',
            'type'   => 'primary',
            'fields' => array(
                0 => 'id',
            ),
        ),
        1 => array(
            'name'   => 'idx_loans_loans_party_rq_party_ida1_deleted',
            'type'   => 'index',
            'fields' => array(
                0 => 'loans_loans_party_rq_partyloans_loans_ida',
                1 => 'deleted',
            ),
        ),
        2 => array(
            'name'   => 'idx_loans_loans_party_rq_party_idb2_deleted',
            'type'   => 'index',
            'fields' => array(
                0 => 'loans_loans_party_rq_partyparty_rq_party_idb',
                1 => 'deleted',
            ),
        ),
    ),
);
