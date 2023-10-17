<?php
$dictionary['Account']['relationships']['party_account'] =
array(
  'lhs_module'                     => 'Accounts',
  'lhs_table'                      => 'accounts',
  'lhs_key'                        => 'id',
  'rhs_module'                     => 'Party_RQ_Party',
  'rhs_table'                      => 'party_rq_party',
  'rhs_key'                        => 'parent_id',
  'relationship_type'              => 'one-to-many',
  'relationship_role_column'       => 'parent_type',
  'relationship_role_column_value' => 'Accounts',
);
