<?php
$dictionary['Contact']['relationships']['party_contact'] =
array(
    'lhs_module'                     => 'Contacts',
    'lhs_table'                      => 'contacts',
    'lhs_key'                        => 'id',
    'rhs_module'                     => 'Party_RQ_Party',
    'rhs_table'                      => 'party_rq_party',
    'rhs_key'                        => 'parent_id',
    'relationship_type'              => 'one-to-many',
    'relationship_role_column'       => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
);
