<?php

use Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits;

/**
 * *** QualiaConfigApi ***
 *
 * This class manipulates custom configuration table, specific to the current package.
 *
 * @version 1.0.0
 * @since SugarCRM 8.0
 * @since PHP 7.1
 */
class QualiaConfigApi extends SugarApi
{
    use Traits\ModuleConfigTrait;

    public function registerApiRest()
    {
        return [
            "SettingsSet" => [
                "reqType"   => "POST",
                "path"      => ["QualiaIntegration", "settings", "set"],
                "pathVars"  => ["", "", ""],
                "method"    => "settingsSet",
                "shortHelp" => "Saves settings within custom config table.",
                "longHelp"  => "",
            ],

            "SettingsGet" => [
                "reqType"   => "GET",
                "path"      => ["QualiaIntegration", "settings", "get"],
                "pathVars"  => ["", "", ""],
                "method"    => "settingsGet",
                "shortHelp" => "Retrieves settings from the custom config table.",
                "longHelp"  => "",
            ],
        ];
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     *
     * @return array
     */
    public function settingsSet(ServiceBase $api, array $args): array
    {
        return $this->modConfigSet($args["data"]);
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     *
     * @return array
     */
    public function settingsGet(ServiceBase $api, array $args): array
    {
        return $this->modConfigGet();
    }
}
