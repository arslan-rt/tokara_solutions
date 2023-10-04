<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$GLOBALS['log']->info("In pre_uninstall 0 for ops_Backups");
$bean = BeanFactory::newBean('Schedulers');
if (empty($bean)) {
  $GLOBALS['log']->error("Failed to instantiate Schedulers bean");
  return;
}
$r = $bean->db->query('DELETE FROM schedulers WHERE job="function::ops_backups_fetch_exports"');
