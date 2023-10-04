<?php
// Copyright 2017 SugarCRM Inc.

$manifest = array (
    'acceptable_sugar_versions' =>
        array (
            'regex_matches' => array('^(.*?)\\.(.*?)\\.(.*?)$'),
        ),
    'acceptable_sugar_flavors' =>
        array (
            'PRO',
            'ENT',
            'CORP',
            'ULT',
        ),
    'readme' => '',
    'key' => 'ops',
    'author' => 'SugarCRM',
    'description' => 'A set of modules providing additional functionality for SugarCloud.',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'Ops-Modules',
    'published_date' => '2019-03-14 10:35:00',
    'type' => 'module',
    'version' => '2.1.1',
    'remove_tables' => 'prompt',
);

$installdefs = array (
    'id' => 'ops-modules',
    'administration' => array(
        array(
            'from' => '<basepath>/Files/custom/Extension/modules/Administration/Ext/Administration/ops_modules.php',
            'to_module' => 'Administration'
        )
    ),
    'beans' => array (
        array (
            'module' => 'ops_Backups',
            'class' => 'ops_Backups',
            'path' => 'modules/ops_Backups/ops_Backups.php',
            'tab' => true,
        ),
    ),
    'language' => array (
        array (
            'from' => '<basepath>/Files/custom/Extension/application/Ext/Language/en_us.ops_modules.php',
            'to_module' => 'application',
            'language' => 'en_us',
        ),
        array(
            'from' => '<basepath>/Files/custom/Extension/modules/Schedulers/Ext/Language/en_us.ops_backups.php',
            'to_module' => 'Schedulers',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/Files/custom/Extension/modules/Administration/Ext/Language/en_us.ops_modules.php',
            'to_module' => 'Administration',
            'language' => 'en_us'
        )
    ),
    'scheduledefs' => array(
        array(
            'from' => '<basepath>/Files/custom/Extension/modules/Schedulers/Ext/ScheduledTasks/ops_backups_fetch_exports.php',
            'to_module' => 'Schedulers'
        ),
    ),
    'copy' => array(
        array (
            'from' => '<basepath>/Files/modules/ops_Backups',
            'to' => 'modules/ops_Backups',
        ),
    ),
    'post_execute' => array (
        '<basepath>/scripts/post_execute/0.php',
    ),
    'pre_uninstall' => array (
        '<basepath>/scripts/pre_uninstall/0.php',
    ),
);
