<?php

class HookedEmailsFilterApi extends EmailsFilterApi
{
    public function filterList(ServiceBase $api, array $args, $acl = "list")
    {
        self::callCustomLogic("EmailsFilterApi_filterList_before", [
            "api"  => &$api,
            "args" => &$args,
            "acl"  => &$acl,
        ]);

        $parent = parent::filterList($api, $args, $acl);

        self::callCustomLogic("EmailsFilterApi_filterList_after", [
            "api"    => &$api,
            "args"   => &$args,
            "acl"    => &$acl,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function filterListSetup(ServiceBase $api, array $args, $acl = "list")
    {
        self::callCustomLogic("EmailsFilterApi_filterListSetup_before", [
            "api"  => &$api,
            "args" => &$args,
            "acl"  => &$acl,
        ]);

        $parent = parent::filterListSetup($api, $args, $acl);

        self::callCustomLogic("EmailsFilterApi_filterListSetup_after", [
            "api"    => &$api,
            "args"   => &$args,
            "acl"    => &$acl,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function getFilterListCount(ServiceBase $api, array $args)
    {
        self::callCustomLogic("EmailsFilterApi_getFilterListCount_before", [
            "api"  => &$api,
            "args" => &$args,
        ]);

        $parent = parent::getFilterListCount($api, $args);

        self::callCustomLogic("EmailsFilterApi_getFilterListCount_after", [
            "api"    => &$api,
            "args"   => &$args,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected function runQuery(ServiceBase $api, array $args, SugarQuery $q, array $options, SugarBean $seed = null)
    {
        self::callCustomLogic("EmailsFilterApi_runQuery_before", [
            "api"     => &$api,
            "args"    => &$args,
            "q"       => &$q,
            "options" => &$options,
            "seed"    => &$seed,
        ]);

        $parent = parent::runQuery($api, $args, $q, $options, $seed);

        self::callCustomLogic("EmailsFilterApi_runQuery_after", [
            "api"     => &$api,
            "args"    => &$args,
            "q"       => &$q,
            "options" => &$options,
            "seed"    => &$seed,
            "parent"  => &$parent,
        ]);

        return $parent;
    }

    protected static function callCustomLogic(string $event, array $arguments): void
    {
        global $service;

        try {
            $args         = $service->getRequest()->getArgs();
            $module       = $args["module"] ?? $args["module_list"];
            $customParams = $args["customParams"];
        } catch (\Throwable $th) {
            $module = "";
        }

        $arguments["module"]       = $module;
        $arguments["customParams"] = $customParams;

        LogicHook::initialize()->call_custom_logic("", $event, $arguments);
    }
}
