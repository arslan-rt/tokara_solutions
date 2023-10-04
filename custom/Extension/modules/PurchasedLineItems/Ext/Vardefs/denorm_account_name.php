<?php

// 'account_name'
$dictionary['PurchasedLineItem']['fields']['account_name']['is_denormalized'] = true;
$dictionary['PurchasedLineItem']['fields']['account_name']['denormalized_field_name'] = 'denorm_account_name';

// 'denorm_account_name'
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['name'] = 'denorm_account_name';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['type'] = 'varchar';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['dbType'] = 'varchar';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['vname'] = 'LBL_ACCOUNT';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['len'] = 255;
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['comment'] = 'Name of the Company';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['unified_search'] = true;
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['full_text_search'] = array (
  'enabled' => true,
  'searchable' => true,
  'boost' => 1.91,
);
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['audited'] = true;
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['required'] = false;
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['importable'] = 'required';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['duplicate_on_record_copy'] = 'always';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['merge_filter'] = 'selected';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['denorm_from_module'] = 'Accounts';
$dictionary['PurchasedLineItem']['fields']['denorm_account_name']['studio'] = false;
