<?php

// 'billing_account_name'
$dictionary['Quote']['fields']['billing_account_name']['is_denormalized'] = true;
$dictionary['Quote']['fields']['billing_account_name']['denormalized_field_name'] = 'denorm_billing_account_name';

// 'denorm_billing_account_name'
$dictionary['Quote']['fields']['denorm_billing_account_name']['name'] = 'denorm_billing_account_name';
$dictionary['Quote']['fields']['denorm_billing_account_name']['type'] = 'varchar';
$dictionary['Quote']['fields']['denorm_billing_account_name']['dbType'] = 'varchar';
$dictionary['Quote']['fields']['denorm_billing_account_name']['vname'] = 'LBL_BILLING_ACCOUNT_NAME';
$dictionary['Quote']['fields']['denorm_billing_account_name']['len'] = 255;
$dictionary['Quote']['fields']['denorm_billing_account_name']['comment'] = 'Name of the Company';
$dictionary['Quote']['fields']['denorm_billing_account_name']['unified_search'] = true;
$dictionary['Quote']['fields']['denorm_billing_account_name']['full_text_search'] = array (
  'enabled' => true,
  'searchable' => true,
  'boost' => 1.91,
);
$dictionary['Quote']['fields']['denorm_billing_account_name']['audited'] = true;
$dictionary['Quote']['fields']['denorm_billing_account_name']['required'] = false;
$dictionary['Quote']['fields']['denorm_billing_account_name']['importable'] = 'required';
$dictionary['Quote']['fields']['denorm_billing_account_name']['duplicate_on_record_copy'] = 'always';
$dictionary['Quote']['fields']['denorm_billing_account_name']['merge_filter'] = 'selected';
$dictionary['Quote']['fields']['denorm_billing_account_name']['denorm_from_module'] = 'Accounts';
$dictionary['Quote']['fields']['denorm_billing_account_name']['studio'] = false;
