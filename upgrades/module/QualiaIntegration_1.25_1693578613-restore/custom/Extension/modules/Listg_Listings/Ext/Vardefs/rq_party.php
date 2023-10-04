<?php
$dictionary['Listg_Listings']['relationships']['party_listg_listings'] =
array(
    'lhs_module'                     => 'Listg_Listings',
    'lhs_table'                      => 'listg_listings',
    'lhs_key'                        => 'id',
    'rhs_module'                     => 'Party_RQ_Party',
    'rhs_table'                      => 'party_rq_party',
    'rhs_key'                        => 'parent_id',
    'relationship_type'              => 'one-to-many',
    'relationship_role_column'       => 'parent_type',
    'relationship_role_column_value' => 'Listg_Listings',
);
