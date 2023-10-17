<?php
$dictionary['Loans_Loans']['relationships']['party_loans_loans'] =
array(
    'lhs_module'                     => 'Loans_Loans',
    'lhs_table'                      => 'loans_loans',
    'lhs_key'                        => 'id',
    'rhs_module'                     => 'Party_RQ_Party',
    'rhs_table'                      => 'party_rq_party',
    'rhs_key'                        => 'parent_id',
    'relationship_type'              => 'one-to-many',
    'relationship_role_column'       => 'parent_type',
    'relationship_role_column_value' => 'Loans_Loans',
);
