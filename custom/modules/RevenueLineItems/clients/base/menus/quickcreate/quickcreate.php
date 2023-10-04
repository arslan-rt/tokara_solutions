<?php
// created: 2022-01-20 19:32:43
$viewdefs['RevenueLineItems']['base']['menu']['quickcreate'] = array (
  'layout' => 'create',
  'label' => 'LNK_NEW_REVENUELINEITEM',
  'visible' => false,
  'icon' => 'sicon-plus',
  'related' => 
  array (
    0 => 
    array (
      'module' => 'Accounts',
      'link' => 'revenuelineitems',
    ),
    1 => 
    array (
      'module' => 'Contacts',
      'link' => 'revenuelineitems',
    ),
    2 => 
    array (
      'module' => 'Opportunities',
      'link' => 'revenuelineitems',
    ),
  ),
);