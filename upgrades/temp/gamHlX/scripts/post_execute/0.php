<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$GLOBALS['log']->info("In post_execute 0 for ops_Backups");
$sched = BeanFactory::getBean('Schedulers');
if (empty($sched)) {
  $GLOBALS['log']->fatal("Failed to instantiate Schedulers bean");
} else {
  // In case the installation failed half-way through, we have to
  // ensure there will be no duplicate scheduler records.
  $GLOBALS['log']->info("Purging all ops_Backups schedulers from the instance");
  $sched->db->query('DELETE FROM schedulers WHERE job="function::ops_backups_fetch_exports"');

  $sched->name = 'Retrieve updated backup listing from SugarCRM';
  $sched->job = 'function::ops_backups_fetch_exports';
  $sched->date_time_start = date('Y-m-d H:i:s');
  $sched->date_time_end = NULL;
  $sched->job_interval = sprintf("%d::*::*::*::*", rand(0,59));
  $sched->status = 'Active';
  $sched->created_by = '1';
  $sched->modified_user_id = '1';
  $sched->catch_up = '1';
  $sched->save();

  if ($sched->id) {
    $GLOBALS['log']->info(sprintf("Saved scheduler for ops_Backups with id: %s", $sched->id));
  } else {
    $GLOBALS['log']->fatal("Failed to add scheduler for ops_Backups");
  }
}
