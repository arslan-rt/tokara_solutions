<?php

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\ProcessOrders;

class QualiaApi extends SugarApi
{
    public function registerApiRest()
    {
        return [
            "QualiaApi" => [
                "reqType"   => "POST",
                "path"      => ["QualiaIntegration", "process"],
                "pathVars"  => ["", "", ""],
                "method"    => "process",
                "shortHelp" => "Process the Qualia data",
                "longHelp"  => "",
            ],
        ];
    }

    /**
     * process function
     *
     * Process data from Qualia
     *
     * @param ServiceBase $api
     * @param array $args
     * @return void
     */
    public function process(ServiceBase $api, array $args)
    {
        if (array_key_exists("qualiaData", $args) === false) {
            return false;
        }

        $qualiaData = $args["qualiaData"];

        $processOrders = new ProcessOrders();
        $status        = $processOrders->run($qualiaData);

        return $status;
    }
}
