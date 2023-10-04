<?php

if (!defined("sugarEntry") || !sugarEntry) {
    die("Not A Valid Entry Point");
}

class AddwEnhancedScheduledReportsJobClass
{
    public function handle($event, $arguments)
    {
        SugarAutoloader::addDirectory("custom/include/SugarQueue/jobs/");
        SugarAutoLoader::autoload("WsystemsSugarJobSendScheduledReport");
    }
}
