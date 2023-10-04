<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */

// use Sugarcrm\Sugarcrm\custom\inc\wsystems\ramquestIntegration\Utils\RamQuestGlobalVariables;
// use Sugarcrm\Sugarcrm\custom\inc\wsystems\ramquestIntegration\Utils\Traits\RqReports;

require_once 'modules/Order_RQ_Order/Order_RQ_Order_sugar.php';
class Order_RQ_Order extends Order_RQ_Order_sugar
{
    // use RqReports\RamQuestReportVisibility;

    const QUERY_FIELDS_POSITION = 0;
    const BLACK_LIST_FIELDS     = [
        "account_referral_list",
        "account_seller_attorney_list",
        "account_buyer_attorney_list",
        "contact_buyer_attorney_list",
        "contact_seller_attorney_list",
        "contact_referral_name",
        "buyer_list",
        "seller_list",
    ];

    // protected function getQueryFields(SugarQuery $query, array $fields = array(), array $options = array())
    // {
    //     // $QUERY_FIELDS_POSITION = 0;
    //     // $initialFieldDefs      = $this->fields_def;

    //     $resp = parent::getQueryFields($query, $fields, $options);

    //     if (count($resp) < 1 || count($resp[self::QUERY_FIELDS_POSITION]) < 1) {
    //         return $resp;
    //     }

    //     $resp = $this->removeBrokenFieldsFromSelect(self::BLACK_LIST_FIELDS, $resp);

    //     return $resp;
    // }

    // private function removeBrokenFieldsFromSelect(array $brokenFields, $list)
    // {

    //     if (count($brokenFields) < 1) {
    //         return $list;
    //     }

    //     foreach ($brokenFields as $brokenField) {
    //         $list = $this->removeBrokenField($brokenField, $list);
    //     }

    //     return $list;
    // }

    // private function removeBrokenField(string $brokenField, $list)
    // {
    //     if (array_key_exists($brokenField, $list[self::QUERY_FIELDS_POSITION]) === true) {
    //         unset($list[self::QUERY_FIELDS_POSITION][$brokenField]);
    //     }

    //     return $list;

    // }

    // public function addVisibilityFrom(&$query, $options = null)
    // {
    //     $visibility = $this->loadVisibility()->addVisibilityFrom($query, $options);

    //     if (array_key_exists(RamQuestGlobalVariables::REPORT_GLOBAL_REPORT_REQUEST_CACHE, $GLOBALS) === false) {
    //         return $visibility;
    //     }

    //     $cachedValues = $GLOBALS[RamQuestGlobalVariables::REPORT_GLOBAL_REPORT_REQUEST_CACHE];

    //     // foreach ($cachedValues as $customTableAlis => $customTargetField) {
    //     //     if ($customTargetField !== false && $customTableAlis !== false) {
    //     //         $query .= $this->getJoinForRqReport($customTargetField, $customTableAlis);
    //     //     }
    //     // }

    //     $query = $this->handleJoinQueryRq($query, $cachedValues);

    //     // unset($GLOBALS[RamQuestGlobalVariables::REPORT_GLOBAL_REPORT_REQUEST_CACHE]);

    //     return $visibility;
    // }
}
