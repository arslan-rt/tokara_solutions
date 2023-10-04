<?php

$hook_array["FilterApi_addFilter_before"][] = array(
    10,
    "Enhanced filtering for related records",
    null,
    "Sugarcrm\\Sugarcrm\\custom\\wsystems\\QualiaIntegration\\LogicHooks\\OrdersFilterListHook",
    "addFilterBefore",
);

$hook_array["FilterApi_addFilter_before"][] = array(
    10,
    "Enhanced filtering for related records",
    null,
    "Sugarcrm\\Sugarcrm\\custom\\wsystems\\QualiaIntegration\\LogicHooks\\ContactsFilterListHook",
    "addFilterBefore",
);

$hook_array["RelateApi_filterRelated_after"][] = array(
    10,
    "Handle Qualia Subpanel between Contacts/Accounts and Orders",
    null,
    "Sugarcrm\\Sugarcrm\\custom\\wsystems\\QualiaIntegration\\LogicHooks\\FilterRelatedAfterHook",
    "filterRelatedAfter",
);

$hook_array["RelateApi_filterRelatedSetup_after"][] = array(
    10,
    "Handle Qualia Subpanel between Contacts/Accounts and Orders",
    null,
    "Sugarcrm\\Sugarcrm\\custom\\wsystems\\QualiaIntegration\\LogicHooks\\FilterRelatedSetupAfterHook",
    "filterRelatedSetupAfter",
);
