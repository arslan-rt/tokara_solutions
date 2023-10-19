<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class QualiaPartiesCollectionData extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            'getRQPartiesData' => array(
                'reqType'   => 'POST',
                'path'      => array('GetRQPartiesData'),
                'pathVars'  => array(''),
                'method'    => 'getRQPartiesData',
                'shortHelp' =>
                'Get the RQ Parties data needed in order to build the UI',
                'longHelp'  => '',
            ),
        );
    }

    public function getRQPartiesData(ServiceBase $api, array $args)
    {
        $this->relatedAssociates = [];
        $orderId                 = $args["orderId"];
        $orderBean               = BeanFactory::retrieveBean("Order_RQ_Order", $orderId);
        $partiesIdsToIgnore      = [];
        $rqPartiesData           = [];

        if ($orderBean instanceof SugarBean === true) {
            $orderBean->load_relationship("party_rq_party_order_rq_order");
            $orderParties = $orderBean->party_rq_party_order_rq_order->getBeans();
            $orderParties = $this->removeLinkedAssociates($orderParties);

            $rqPartiesData = $this->getRelatedPartiesData($orderParties, $partiesIdsToIgnore, true, $orderBean->id, $orderBean);
        }
        return $rqPartiesData;
    }

    /**
     * We don't need to check the associates parties
     */
    private function removeLinkedAssociates($orderParties)
    {
        foreach ($orderParties as $key => $beanValue) {
            if ($beanValue->party_type === "Associates") {
                $this->relatedAssociates[] = $beanValue->id;
                unset($orderParties[$key]);
            }
        }

        return $orderParties;
    }

    /**
     * iterate over all the order parties and parties children to get them
     * also we will delete those parties that haven't the child valid(it was deleted) function
     *
     * @param Array $orderParties           - all the parties
     * @param Array $partiesIdsToIgnore     - parties that should be ignored in this process
     * @param boolean $isRelatedToOrder     - check if is a main party
     * @param String $partyParentId         - id of the order[redundant maybe removed in the future*]
     * @param SugarBean $orderBean
     * @return void
     */
    private function getRelatedPartiesData($orderParties, $partiesIdsToIgnore, $isRelatedToOrder = false, $partyParentId, $orderBean)
    {
        $displayPriority = [];
        $rqPartiesData   = [];

        foreach ($orderParties as $partyBean) {
            if (!in_array($partyBean->id, $partiesIdsToIgnore)) {
                $rqPartyData                         = [];
                $rqPartyData[$partyBean->party_type] = $this->getBeanData($partyBean, $isRelatedToOrder, $partyParentId);

                $partyBean->load_relationship("party_rq_party_party_rq_party");
                $parties = $partyBean->party_rq_party_party_rq_party->getBeans();

                $parties = $this->removeUnwantedAssociates($parties);

                array_push($partiesIdsToIgnore, $partyBean->id);

                $partyParentId   = $partyBean->parent_id;
                $partyParentType = $partyBean->parent_type;

                $partyChild = BeanFactory::retrieveBean($partyParentType, $partyParentId, array('disable_row_level_security' => true));

                $recordOfPartyIsDeleted = false;
                if ($partyChild instanceof SugarBean === false) {
                    $recordOfPartyIsDeleted = true;
                }

                $rqPartyData["partyType"]          = $partyBean->party_type;
                $rqPartyData["displayPriority"]    = 1;
                $rqPartyData["partyRecordDeleted"] = $recordOfPartyIsDeleted;
                $rqPartyData["partyName"]          = $partyBean->name;
                $rqPartyData["isPrimary"]          = $partyBean->is_primary;

                if (array_key_exists($partyBean->party_type, $displayPriority)) {
                    $rqPartyData["displayPriority"] = $displayPriority[$partyBean->party_type];
                }

                $rqPartyData["relatedParties"] = $this->getRelatedPartiesData($parties, $partiesIdsToIgnore, false, $partyBean->id, $orderBean);

                array_push($rqPartiesData, $rqPartyData);
            }
        }

        return $rqPartiesData;
    }

    /**
     * Some Accounts have linked associates only for some of the orders
     * We need to ensure that only the asscoiates linked to this order is displayed
     */
    private function removeUnwantedAssociates($parties)
    {
        foreach ($parties as $key => $party) {
            if ($party->party_type === "Associates" && in_array($party->id, $this->relatedAssociates) === false) {
                unset($parties[$key]);
            }
        }
        return $parties;
    }

    private function getBeanData($bean, $isRelatedToOrder, $partyParentId)
    {
        $sugarBean     = BeanFactory::retrieveBean($bean->parent_type, $bean->parent_id);
        $sugarBeanData = [];

        foreach ($bean->field_defs as $fieldName => $fieldDef) {
            if (gettype($bean->{$fieldName}) !== "array" && gettype($bean->{$fieldName}) !== "object") {
                $sugarBeanData[$fieldName] = $bean->{$fieldName};
            }
        }

        $sugarBeanData["id"]                = $bean->parent_id;
        $sugarBeanData["partyId"]           = $bean->id;
        $sugarBeanData["partyLink"]         = "party_rq_party_party_rq_party";
        $sugarBeanData["partyParentModule"] = "Party_RQ_Party";
        $sugarBeanData["partyParentId"]     = $partyParentId;
        $sugarBeanData["name"]              = $sugarBean->name;
        $sugarBeanData["isPrimary"]         = $bean->is_primary;

        if ($isRelatedToOrder) {
            $sugarBeanData["partyLink"]         = "party_rq_party_order_rq_order";
            $sugarBeanData["partyParentModule"] = "Order_RQ_Order";
        }

        if ($sugarBean->full_name) {
            $sugarBeanData["name"] = $sugarBean->full_name;
        }

        return $sugarBeanData;
    }
}
