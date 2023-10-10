<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
class QualiaCredsApi extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            //POST
            'SaveAutherizationCreds' => array(
                //request type
                'reqType' => 'POST',
                //endpoint path
                'path' => array(
                    'AutherizationCreds',
                    'Save'
                ),
                //endpoint variables
                'pathVars' => array(
                    '',
                    ''
                ),
                //method to call
                'method' => 'SaveAutherizationCreds',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'It will get data from the fields and save them into the config file',
                //long help to be displayed in the help documentation
                'longHelp' => 'custom/modules/Home/clients/base/api/help/QualiaCredsApi_help.html'
            ),
            'ReteriveAutherizationCreds' => array(
                //request type
                'reqType' => 'GET',
                //endpoint path
                'path' => array(
                    'AutherizationCreds',
                    'Reterive'
                ),
                //endpoint variables
                'pathVars' => array(
                    '',
                    ''
                ),
                //method to call
                'method' => 'ReteriveAutherizationCreds',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'It will get data from the fields and save them into the config file',
                //long help to be displayed in the help documentation
                'longHelp' => 'custom/modules/Home/clients/base/api/help/QualiaCredsApi_help.html'
            )
        );
    }
    /**
     * Method to be used for my IndustrySegmentFocus/Save endpoint
     */
    public function SaveAutherizationCreds($api, $args)
    {
    	//get values from args
        $configuratorObj = new Configurator();
        $configuratorObj->loadConfig();
        foreach ($args["DBfields"] as $key => $dbFields) {
            if ($dbFields["name"] != "empty")
                $configuratorObj->config['additional_js_config']['autherization_creds'][$dbFields["name"]] = $args["data"][$dbFields["name"]];
        }
        //save values in config
        $configuratorObj->config['additional_js_config']['autherization_creds'] = $configuratorObj->config['additional_js_config']['autherization_creds'];
        $configuratorObj->handleOverride();
        /*Repair to take changed affect*/
        $repair = new RepairAndClear();
        $repair->repairAndClearAll(array('clearAll'), array(translate('LBL_ALL_MODULES')), true, false,'');
        return $args;
    }
    /**
     * Method to be used for my IndustrySegmentFocus/Reterive endpoint
     */
    public function ReteriveAutherizationCreds($api, $args)
    {
    	 //get values from config
        $configuratorObj = new Configurator();
        $configuratorObj->loadConfig();
        $autherization_creds = $configuratorObj->config['additional_js_config']['autherization_creds'];
        return $autherization_creds;
    }
}
