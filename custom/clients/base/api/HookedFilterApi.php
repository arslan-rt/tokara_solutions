<?php

class HookedFilterApi extends FilterApi
{
    public function filterListSetup(ServiceBase $api, array $args, $acl = "list")
    {
        self::callCustomLogic("FilterApi_filterListSetup_before", [
            "api"  => &$api,
            "args" => &$args,
            "acl"  => &$acl,
        ]);

        $parent = parent::filterListSetup($api, $args, $acl);

        self::callCustomLogic("FilterApi_filterListSetup_after", [
            "api"    => &$api,
            "args"   => &$args,
            "acl"    => &$acl,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function filterList(ServiceBase $api, array $args, $acl = "list")
    {
        self::callCustomLogic("FilterApi_filterList_before", [
            "api"  => &$api,
            "args" => &$args,
            "acl"  => &$acl,
        ]);

        $parent = parent::filterList($api, $args, $acl);

        self::callCustomLogic("FilterApi_filterList_after", [
            "api"    => &$api,
            "args"   => &$args,
            "acl"    => &$acl,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    public function getFilterListCount(ServiceBase $api, array $args)
    {
        self::callCustomLogic("FilterApi_getFilterListCount_before", [
            "api"  => &$api,
            "args" => &$args,
        ]);

        $parent = parent::getFilterListCount($api, $args);

        self::callCustomLogic("FilterApi_getFilterListCount_after", [
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
            $module       = $args["module"] ?? $args["module_list"];
            $customParams = $args["customParams"];
        } catch (\Throwable $th) {
            $module = "";
        }

        $arguments["module"]       = $module;
        $arguments["customParams"] = $customParams;

        LogicHook::initialize()->call_custom_logic("", $event, $arguments);
    }

    protected function parseArguments(ServiceBase $api, array $args, SugarBean $seed = null)
    {
        self::callCustomLogic("FilterApi_parseArguments_before", [
            "api"  => &$api,
            "args" => &$args,
            "bean" => &$seed,
        ]);

        $parent = parent::parseArguments($api, $args, $seed);

        self::callCustomLogic("FilterApi_parseArguments_after", [
            "api"    => &$api,
            "args"   => &$args,
            "bean"   => &$seed,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected function getOrderByFromArgs(array $args, SugarBean $seed = null)
    {
        self::callCustomLogic("FilterApi_getOrderByFromArgs_before", [
            "args" => &$args,
            "bean" => &$seed,
        ]);

        $parent = parent::getOrderByFromArgs($args, $seed);

        self::callCustomLogic("FilterApi_getOrderByFromArgs_after", [
            "args"   => &$args,
            "bean"   => &$seed,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected static function getQueryObject(SugarBean $seed, array $options)
    {
        self::callCustomLogic("FilterApi_getQueryObject_before", [
            "seed"    => &$seed,
            "options" => &$options,
        ]);

        $parent = parent::getQueryObject($seed, $options);

        self::callCustomLogic("FilterApi_getQueryObject_after", [
            "seed"    => &$seed,
            "options" => &$options,
            "parent"  => &$parent,
        ]);

        return $parent;
    }

    protected function runQuery(ServiceBase $api, array $args, SugarQuery $q, array $options, SugarBean $seed = null)
    {
        self::callCustomLogic("FilterApi_runQuery_before", [
            "api"     => &$api,
            "args"    => &$args,
            "q"       => &$q,
            "options" => &$options,
            "seed"    => &$seed,
        ]);

        $parent = parent::runQuery($api, $args, $q, $options, $seed);

        self::callCustomLogic("FilterApi_runQuery_after", [
            "api"     => &$api,
            "args"    => &$args,
            "q"       => &$q,
            "options" => &$options,
            "seed"    => &$seed,
            "parent"  => &$parent,
        ]);

        return $parent;
    }

    protected static function verifyField(SugarQuery $q, $field)
    {
        self::callCustomLogic("FilterApi_verifyField_before", [
            "q"     => &$q,
            "field" => &$field,
        ]);

        $parent = parent::verifyField($q, $field);

        self::callCustomLogic("FilterApi_verifyField_after", [
            "q"      => &$q,
            "field"  => &$field,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected static function addFilters(array $filterDefs, SugarQuery_Builder_Where $where, SugarQuery $q)
    {
        self::callCustomLogic("FilterApi_addFilters_before", [
            "filterDefs" => &$filterDefs,
            "where"      => &$where,
            "q"          => &$q,
        ]);

        $parent = parent::addFilters($filterDefs, $where, $q);

        self::callCustomLogic("FilterApi_addFilters_after", [
            "filterDefs" => &$filterDefs,
            "where"      => &$where,
            "q"          => &$q,
            "parent"     => &$parent,
        ]);

        return $parent;
    }

    protected static function addFilter($field, $filter, SugarQuery_Builder_Where $where, SugarQuery $q)
    {
        self::callCustomLogic("FilterApi_addFilter_before", [
            "field"  => &$field,
            "filter" => &$filter,
            "where"  => &$where,
            "q"      => &$q,
        ]);

        $parent = parent::addFilter($field, $filter, $where, $q);

        self::callCustomLogic("FilterApi_addFilter_after", [
            "field"  => &$field,
            "filter" => &$filter,
            "where"  => &$where,
            "q"      => &$q,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected static function addOwnerFilter(SugarQuery $q, SugarQuery_Builder_Where $where, $link)
    {
        self::callCustomLogic("FilterApi_addOwnerFilter_before", [
            "q"     => &$q,
            "where" => &$where,
            "link"  => &$link,
        ]);

        $parent = parent::addOwnerFilter($q, $where, $link);

        self::callCustomLogic("FilterApi_addOwnerFilter_after", [
            "q"      => &$q,
            "where"  => &$where,
            "link"   => &$link,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected static function addFollowFilter(
        SugarQuery $q,
        SugarQuery_Builder_Where $where,
        $filter,
        $joinType = "LEFT"
    ) {
        self::callCustomLogic("FilterApi_addFollowFilter_before", [
            "q"        => &$q,
            "where"    => &$where,
            "filter"   => &$filter,
            "joinType" => &$joinType,
        ]);

        $parent = parent::addFollowFilter($q, $where, $filter, $joinType);

        self::callCustomLogic("FilterApi_addFollowFilter_after", [
            "q"        => &$q,
            "where"    => &$where,
            "filter"   => &$filter,
            "joinType" => &$joinType,
            "parent"   => &$parent,
        ]);

        return $parent;
    }

    protected static function addCreatorFilter(SugarQuery $q, SugarQuery_Builder_Where $where, $link)
    {
        self::callCustomLogic("FilterApi_addCreatorFilter_before", [
            "q"     => &$q,
            "where" => &$where,
            "link"  => &$link,
        ]);

        $parent = parent::addCreatorFilter($q, $where, $link);

        self::callCustomLogic("FilterApi_addCreatorFilter_after", [
            "q"      => &$q,
            "where"  => &$where,
            "link"   => &$link,
            "parent" => &$parent,
        ]);

        return $parent;
    }

    protected static function addFavoriteFilter(
        SugarQuery $q,
        SugarQuery_Builder_Where $where,
        $link,
        $joinType = "LEFT"
    ) {
        self::callCustomLogic("FilterApi_addFavoriteFilter_before", [
            "q"        => &$q,
            "where"    => &$where,
            "link"     => &$link,
            "joinType" => &$joinType,
        ]);

        $parent = parent::addFavoriteFilter($q, $where, $link, $joinType);

        self::callCustomLogic("FilterApi_addFavoriteFilter_after", [
            "q"        => &$q,
            "where"    => &$where,
            "link"     => &$link,
            "joinType" => &$joinType,
            "parent"   => &$parent,
        ]);

        return $parent;
    }

    protected static function addTrackerFilter(SugarQuery $q, SugarQuery_Builder_Where $where, $interval)
    {
        self::callCustomLogic("FilterApi_addTrackerFilter_before", [
            "q"        => &$q,
            "where"    => &$where,
            "interval" => &$interval,
        ]);

        $parent = parent::addTrackerFilter($q, $where, $interval);

        self::callCustomLogic("FilterApi_addTrackerFilter_after", [
            "q"        => &$q,
            "where"    => &$where,
            "interval" => &$interval,
            "parent"   => &$parent,
        ]);

        return $parent;
    }
}
