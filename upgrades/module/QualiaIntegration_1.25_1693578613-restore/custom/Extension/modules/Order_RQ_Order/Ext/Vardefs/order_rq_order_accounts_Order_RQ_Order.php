<?php
// created: 2019-01-10 13:51:34
$dictionary["Order_RQ_Order"]["fields"]["order_rq_order_accounts"] = array(
  'name'         => 'order_rq_order_accounts',
  'type'         => 'link',
  'relationship' => 'order_rq_order_accounts',
  'source'       => 'non-db',
  'module'       => 'Accounts',
  'bean_name'    => 'Account',
  'side'         => 'right',
  'vname'        => 'LBL_ORDER_RQ_ORDER_ACCOUNTS_FROM_ORDER_RQ_ORDER_TITLE',
  'id_name'      => 'order_rq_order_accountsaccounts_ida',
  'link-type'    => 'one',
);
$dictionary["Order_RQ_Order"]["fields"]["order_rq_order_accounts_name"] = array(
  'name'    => 'order_rq_order_accounts_name',
  'type'    => 'relate',
  'source'  => 'non-db',
  'vname'   => 'LBL_ORDER_RQ_ORDER_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'save'    => true,
  'id_name' => 'order_rq_order_accountsaccounts_ida',
  'link'    => 'order_rq_order_accounts',
  'table'   => 'accounts',
  'module'  => 'Accounts',
  'rname'   => 'name',
);
$dictionary["Order_RQ_Order"]["fields"]["order_rq_order_accountsaccounts_ida"] = array(
  'name'            => 'order_rq_order_accountsaccounts_ida',
  'type'            => 'id',
  'source'          => 'non-db',
  'vname'           => 'LBL_ORDER_RQ_ORDER_ACCOUNTS_FROM_ORDER_RQ_ORDER_TITLE_ID',
  'id_name'         => 'order_rq_order_accountsaccounts_ida',
  'link'            => 'order_rq_order_accounts',
  'table'           => 'accounts',
  'module'          => 'Accounts',
  'rname'           => 'id',
  'reportable'      => false,
  'side'            => 'right',
  'massupdate'      => false,
  'duplicate_merge' => 'disabled',
  'hideacl'         => true,
);
