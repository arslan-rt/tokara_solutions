<?php

class HookedRelateApi extends RelateApi
{
    public function filterRelatedSetup(ServiceBase $api, array $args)
    {
        self::callCustomLogic("RelateApi_filterRelatedSetup_before", [
            "api"  => &$api,
            "args" => &$args,
        ]);

        $parent = parent::filterRelatedSetup($api, $args);

        self::callCustomLogic("RelateApi_filterRelatedSetup_after", [
            "api"    => &$api,
            "args"   => &$args,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function filterRelated(ServiceBase $api, array $args)
    {
        self::callCustomLogic("RelateApi_filterRelated_before", [
            "api"  => &$api,
            "args" => &$args,
        ]);

        $parent = parent::filterRelated($api, $args);

        self::callCustomLogic("RelateApi_filterRelated_after", [
            "api"    => &$api,
            "args"   => &$args,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function filterRelatedCount(ServiceBase $api, array $args)
    {
        self::callCustomLogic("RelateApi_filterRelatedCount_before", [
            "api"  => &$api,
            "args" => &$args,
        ]);

        $parent = parent::filterRelatedCount($api, $args);

        self::callCustomLogic("RelateApi_filterRelatedCount_after", [
            "api"    => &$api,
            "args"   => &$args,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function filterRelatedLeanCount(ServiceBase $api, array $args)
    {
        self::callCustomLogic("RelateApi_filterRelatedLeanCount_before", [
            "api"  => &$api,
            "args" => &$args,
        ]);

        $parent = parent::filterRelatedLeanCount($api, $args);

        self::callCustomLogic("RelateApi_filterRelatedLeanCount_after", [
            "api"    => &$api,
            "args"   => &$args,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected static function callCustomLogic(string $event, array $arguments): void
    {
        global $service;

        try {
            $args         = $service->getRequest()->getArgs();
            $module       = $args["module"];
            $customParams = $args["customParams"];
        } catch (\Throwable $th) {
            $module = "";
        }

        $arguments["module"]       = $module;
        $arguments["customParams"] = $customParams;

        LogicHook::initialize()->call_custom_logic("", $event, $arguments);
    }
}
