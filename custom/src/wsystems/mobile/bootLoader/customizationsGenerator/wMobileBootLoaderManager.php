<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once "custom/src/wsystems/mobile/bootLoader/customizationsGenerator/MobileAutoLoader.php";

class wMobileBootLoaderManager
{
    private $sugarComponents        = "custom/clients/mobile";
    private $sugarExtensions        = "custom/src/wsystems/mobile";
    private $customizationsFile     = "custom/src/wsystems/mobile/bootLoader/customizationsLoader/wMobileCustomizations.js";
    private $customizationsFileHash = "custom/src/wsystems/mobile/bootLoader/customizationsGenerator/wMobileCustomizationsHash.php";
    private $widgetsPath            = "custom/src/wsystems/mobile/widgets";
    private $bootloaderPath         = "custom/src/wsystems/mobile/bootLoader/customizationsLoader/bootLoader.js";
    private $mobileFieldsPath       = "custom/clients/mobile/fields";
    private $mobileLayoutsPath      = "custom/clients/mobile/layouts";
    private $mobileViewsPath        = "custom/clients/mobile/views";
    private $mobileDashletsPath     = "custom/clients/mobile/dashlets";

    public function createCustomizationsFile()
    {
        $payloadData          = "";
        $bootloaderData       = $this->getBootLoaderContent();
        $requireData          = $this->getRequire();
        $componentsDataHeader = "
(function(app){
    SUGAR.mobile = {
        widgets: {},
        views: {},
        fields: {},
        layouts: {},
        dashlets: {},
        extensions: {},
        styles: {},
    };
    app.mobile = {
        widgets: {},
        views: {},
        fields: {},
        layouts: {},
        dashlets: {},
        styles: {},
    };
";
        $componentsDataBody   = "";
        $componentsDataFooter = "
})(SUGAR.App);
";
        $componentsDataBody = $this->getCustomFiles($this->mobileFieldsPath, $componentsDataBody, "fields");
        $componentsDataBody = $this->getCustomFiles($this->mobileLayoutsPath, $componentsDataBody, "layouts");
        $componentsDataBody = $this->getCustomFiles($this->mobileViewsPath, $componentsDataBody, "views");
        $componentsDataBody = $this->getCustomFiles($this->widgetsPath, $componentsDataBody, "widgets");
        $componentsDataBody = $this->getCustomFiles($this->mobileDashletsPath, $componentsDataBody, "dashlets");
        $payloadData        = $componentsDataHeader . $componentsDataBody . $componentsDataFooter . $bootloaderData . $requireData;

        MobileAutoLoader::put($this->customizationsFile, $payloadData);

        $this->createHashFile();
    }

    private function createHashFile()
    {
        $customizationsHash = hash_file("md5", $this->customizationsFile);
        MobileAutoLoader::put($this->customizationsFileHash, "<?php
class wMobileCustomizationsHash
{
    public static function getCustomizationsHash()
    {
        return \"${customizationsHash}\";
    }
}");
    }

    private function getRequire()
    {
        global $app_list_strings;

        $requireDataHeader = "
(function(modules) {
    let _modules = new Map();
    let _requireSpecific = function(modData) {
        let _module = {};
        _module.exports = {};

        modData.functionName(_module, _require);

        _modules.set(_module.name, _module.exports);
    };

    let _require = window.require = function(name) {
        var moduleData = _modules.get(name);

        if (!moduleData) {
            for (const module of modules) {
                if (module.requireName === name) {
                    _requireSpecific(module);
		    moduleData = _modules.get(name);
                }
            }
        }

        return moduleData;
    }

    for (const module of modules) {
        _requireSpecific(module);
    }
})(
";
        $requireDataBody   = $this->getRequireFilesContent();
        $requireDataFooter = "
);
    SUGAR.customizationTools.mobileButtonsManager.handleViewChange();
    SUGAR.customizationTools.wMobileBootLoader.loadManagers();
    SUGAR.customizationTools.wMobileBootLoader.applyExtensions(SUGAR.mobile.extensions);
    SUGAR.customizationTools.wMobileBootLoader.loadMobileCustomizations();
    SUGAR.customizationTools.wMobileBootLoader.wMobileRouteHandler.reloadLoginView();
    SUGAR.customizationTools.wMapsFilteringDistancesList = [
";
        if (isset($app_list_strings['wMaps_filtering_distances_list'])) {
            $list = $app_list_strings['wMaps_filtering_distances_list'];

            foreach ($list as $key => $value) {
                $requireDataFooter = $requireDataFooter . $key . ",";
            }
        }

        $requireDataFooter = substr($requireDataFooter, 0, -1) . "];";

        return $requireDataHeader . $requireDataBody . $requireDataFooter;
    }

    private function getRequireFilesContent()
    {
        $components = MobileAutoLoader::getDirFiles($this->sugarComponents, false, false, true);
        $extensions = MobileAutoLoader::getDirFiles($this->sugarExtensions, false, false, true);

        $filesPaths       = array_merge($extensions, $components);
        $requireFilesData = "[]";

        if ($filesPaths && safeCount($filesPaths) > 0) {
            $requireFilesData = "[";
            foreach ($filesPaths as $fileIndex => $filePath) {
                if (strpos($filePath, ".js") > -1 && strpos($filePath, "bootLoader.js") === false && strpos($filePath, "wMobileCustomizations.js") === false
                ) {
                    $fileContent = sugar_file_get_contents($filePath);
                    $requireName = substr($filePath, strpos($filePath, 'src'), strpos($filePath, '.') - strpos($filePath, 'src'));

                    $currentRequireFile = "{'requireName': '" . $requireName . "'" .
                        ", 'functionName': function(module, require) {
    module.name = '" . $requireName . "';
" . $fileContent . "
    }
},
";
                    $requireFilesData = $requireFilesData . $currentRequireFile;
                }
            }

            $requireFilesData = substr($requireFilesData, 0, -1);
            $requireFilesData = $requireFilesData . "]";
        }

        return $requireFilesData;
    }

    private function getBootLoaderContent()
    {
        $bootLoaderContent = sugar_file_get_contents($this->bootloaderPath);

        return $bootLoaderContent;
    }

    private function getCustomFiles($initialPath, $componentsDataBody, $entityType)
    {
        $foldersPaths      = MobileAutoLoader::getDirFiles($initialPath, true);
        $phpExtension      = "php";
        $jsExtension       = "js";
        $templateExtension = "hbs";
        $cssExtension      = "css";

        foreach ($foldersPaths as $folderIndex => $folderPath) {
            $entityName         = array_pop(explode('/', $folderPath));
            $filesPaths         = MobileAutoLoader::getDirFiles($folderPath, false);
            $componentsDataBody = $componentsDataBody .
                "   SUGAR.mobile." . $entityType . "[\"" . $entityName . "\"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };
";

            foreach ($filesPaths as $fileIndex => $filePath) {
                $fullFileName  = array_pop(explode('/', $filePath));
                $fileName      = substr($fullFileName, 0, strripos($fullFileName, '.'));
                $fileExtension = array_pop(explode('.', $filePath));
                $entityData    = "";
                $fileContent   = sugar_file_get_contents($filePath);

                if ($fileExtension === $templateExtension) {
                    $entityData = "
    SUGAR.mobile." . $entityType . "[\"" . $entityName . "\"][\"templates\"][\"" . $fileName . "\"] = " . json_encode($fileContent) . ";";
                } elseif ($fileExtension === $jsExtension) {
                    $entityData = "
    SUGAR.mobile." . $entityType . "[\"" . $entityName . "\"][\"controller\"] = " . $fileContent . ";";
                } elseif ($fileExtension === $phpExtension) {
                    include $filePath;
                    $metaCode   = $viewdefs['mobile'][substr($entityType, 0, strlen($entityType) - 1)][$fileName];
                    $entityData = "
    SUGAR.mobile." . $entityType . "[\"" . $entityName . "\"][\"meta\"] = " . json_encode($metaCode) . ";";
                } elseif ($fileExtension === $cssExtension) {
                    $entityData = "
    SUGAR.mobile." . $entityType . "[\"" . $entityName . "\"][\"styles\"][\"" . $fileName . "\"] = " . json_encode($fileContent) . ";";
                }
                $componentsDataBody = $componentsDataBody . $entityData;
            }
        }

        return $componentsDataBody;
    }
}
