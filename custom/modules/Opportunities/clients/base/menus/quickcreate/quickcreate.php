<?php
// created: 2022-01-20 19:32:43
$viewdefs['Opportunities']['base']['menu']['quickcreate'] = array (
  'layout' => 'create',
  'label' => 'LNK_NEW_OPPORTUNITY',
  'visible' => false,
  'icon' => 'sicon-plus',
  'related' => 
  array (
    0 => 
    array (
      'module' => 'Accounts',
      'link' => 'opportunities',
    ),
    1 => 
    array (
      'module' => 'Contacts',
      'link' => 'opportunities',
    ),
  ),
);