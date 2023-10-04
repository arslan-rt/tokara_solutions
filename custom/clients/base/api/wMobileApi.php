<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once "custom/src/wsystems/mobile/bootLoader/customizationsGenerator/MobileAutoLoader.php";
require_once "custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileCustomizationsHash.php";

class wMobileApi extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            'wMobileForSugarCRMPing' => array(
                'reqType'         => 'GET',
                'path'            => array('wMobileForSugarCRMPing'),
                'pathVars'        => array(''),
                'method'          => 'getHash',
                'shortHelp'       => 'This API extends the Mobile Application functionality',
                'longHelp'        => '',
                'noLoginRequired' => true,
            ),
        );
    }

    public function getHash($api, $args)
    {
        $customizationsHash = wMobileCustomizationsHash::getCustomizationsHash();

        return $customizationsHash;
    }
}
