<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

require_once 'clients/base/api/RelateApi.php';

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class QualiaCustomRelateApiForContacts extends RelateApi
{
    public function registerApiRest()
    {
        return array(
            'filterRelatedRecords'          => array(
                'reqType'    => 'GET',
                'path'       => array('Contacts', '?', 'link', 'contact_linked_orders'),
                'pathVars'   => array('module', 'record', '', 'link_name'),
                'jsonParams' => array('filter'),
                'method'     => 'filterRelated',
                'shortHelp'  => 'Lists related records.',
                'longHelp'   => 'include/api/help/module_record_link_link_name_filter_get_help.html',
            ),
            'getCollectionCount'            => array(
                'reqType'   => 'GET',
                'path'      => array('Contacts', '?', 'link', 'contact_linked_orders', 'count'),
                'pathVars'  => array('module', 'record', '', 'collection_name', ''),
                'method'    => 'getCollectionCount',
                'shortHelp' => 'Counts collection records.',
                'longHelp'  => 'include/api/help/module_record_collection_collection_name_count_get_help.html',
            ),
            'filterRelatedRecordsLeanCount' => array(
                'reqType'    => 'GET',
                'minVersion' => '11.4',
                'path'       => array('Contacts', '?', 'link', 'contact_linked_orders', 'filter', 'leancount'),
                'pathVars'   => array('module', 'record', '', 'link_name', '', ''),
                'jsonParams' => array('filter'),
                'method'     => 'filterRelatedLeanCount',
                'shortHelp'  => 'Gets the "lean" count of filtered related items. ' .
                'The count should always be in the range: 0..max_num. ' .
                'The response has a boolean flag "has_more" that defines if there are more rows, ' .
                'than max_num parameter value.',
                'longHelp'   => 'include/api/help/module_record_link_link_name_filter_get_help.html',
            ),
            'listRelatedRecordsLeanCount'   => array(
                'reqType'    => 'GET',
                'minVersion' => '11.4',
                'path'       => array('Contacts', '?', 'link', 'contact_linked_orders', 'leancount'),
                'pathVars'   => array('module', 'record', '', 'link_name', ''),
                'jsonParams' => array('filter'),
                'method'     => 'filterRelatedLeanCount',
                'shortHelp'  => 'Gets the "lean" count of related items.' .
                'The count should always be in the range: 0..max_num. ' .
                'The response has a boolean flag "has_more" that defines if there are more rows, ' .
                'than max_num parameter value.',
                'longHelp'   => 'include/api/help/module_record_link_link_name_filter_get_help.html',
            ),
        );
    }

    /**
     * API endpoint
     *
     * @param ServiceBase $api
     * @param array $args
     *
     * @return array
     * @throws SugarApiExceptionError
     * @throws SugarApiExceptionInvalidParameter
     * @throws SugarApiExceptionMissingParameter
     * @throws SugarApiExceptionNotAuthorized
     * @throws SugarApiExceptionNotFound
     */
    public function getCollectionCount(ServiceBase $api, array $args)
    {
        $api->action = 'list';

        $data            = [];
        $data['records'] = [];

        $relatedOrdersOfContact = $this->getRelatedOrdersOfContact($api, $args);

        $orderIds = array_keys($relatedOrdersOfContact["orders_id"]);

        $record = BeanFactory::retrieveBean($args['module'], $args['record']);

        if (empty($record)) {
            throw new SugarApiExceptionNotFound(
                sprintf(
                    'Could not find parent record %s in module: %s',
                    $args['record'],
                    $args['module']
                )
            );
        }

        // Load the relationship.
        $linkName = $args['collection_name'];

        if (!$record->load_relationship($linkName)) {
            // The relationship did not load.
            throw new SugarApiExceptionNotFound('Could not find a relationship named: ' . $args['link_name']);
        }
        $linkModuleName = $record->$linkName->getRelatedModuleName();
        $linkSeed       = BeanFactory::newBean($linkModuleName);
        if (!$linkSeed->ACLAccess('list')) {
            throw new SugarApiExceptionNotAuthorized('No access to list records for module: ' . $linkModuleName);
        }

        $options = $this->parseArguments($api, $args, $linkSeed);

        // If they don't have fields selected we need to include any link fields
        // for this relationship
        if (empty($args['fields']) && is_array($linkSeed->field_defs)) {
            $relatedLinkName           = $record->$linkName->getRelatedModuleLinkName();
            $options['linkDataFields'] = array();
            foreach ($linkSeed->field_defs as $field => $def) {
                if (empty($def['rname_link']) || empty($def['link'])) {
                    continue;
                }
                if ($def['link'] != $relatedLinkName) {
                    continue;
                }
                // It's a match
                $options['linkDataFields'][] = $field;
                $options['select'][]         = $field;
            }
        }

        // In case the view parameter is set, reflect those fields in the
        // fields argument as well so formatBean only takes those fields
        // into account instead of every bean property.
        if (!empty($args['view'])) {
            $args['fields'] = $options['select'];
        } elseif (!empty($args['fields'])) {
            $args['fields'] = $this->normalizeFields($args['fields'], $options['displayParams']);
        }

        $q = self::getQueryObject($linkSeed, $options);
        // Some relationships want the role column ignored
        if (!empty($args['ignore_role'])) {
            $ignoreRole = true;
        } else {
            $ignoreRole = false;
        }

        $q->setJoinOn(array('baseBeanId' => $record->id));

        $q->where()->in("id", array_values($orderIds));

        if (!isset($args['filter']) || !is_array($args['filter'])) {
            $args['filter'] = array();
        }
        self::addFilters($args['filter'], $q->where(), $q);

        if (!sizeof($q->order_by)) {
            self::addOrderBy($q, $this->defaultOrderBy);
        }

        list($args, $q, $options, $linkSeed) = array($args, $q, $options, $linkSeed);

        $result = $this->runQuery($api, $args, $q, $options, $linkSeed);

        $resultCount                 = [];
        $resultCount["record_count"] = count($orderIds);

        return $resultCount;
    }

    public function filterRelated(ServiceBase $api, array $args)
    {
        $linkName = $args["link_name"];

        if ($linkName !== "contact_linked_orders") {
            return parent::filterRelated($api, $args);
        }

        $emptyResult = [
            "next_offset" => -1,
            "records"     => [],
        ];

        $api->action = 'list';

        $data            = [];
        $data['records'] = [];

        $relatedOrdersOfContact = $this->getRelatedOrdersOfContact($api, $args);

        if ($relatedOrdersOfContact === false || count($relatedOrdersOfContact["orders_id"]) < 1) {
            return $emptyResult;
        }

        $orderIds = array_keys($relatedOrdersOfContact["orders_id"]);

        if ($orderIds === false) {
            return $emptyResult;
        }

        $record = BeanFactory::retrieveBean($args['module'], $args['record']);

        if (empty($record)) {
            throw new SugarApiExceptionNotFound(
                sprintf(
                    'Could not find parent record %s in module: %s',
                    $args['record'],
                    $args['module']
                )
            );
        }

        // Load the relationship.
        $linkName = $args['link_name'];

        if (!$record->load_relationship($linkName)) {
            // The relationship did not load.
            throw new SugarApiExceptionNotFound('Could not find a relationship named: ' . $args['link_name']);
        }
        $linkModuleName = $record->$linkName->getRelatedModuleName();
        $linkSeed       = BeanFactory::newBean($linkModuleName);
        if (!$linkSeed->ACLAccess('list')) {
            throw new SugarApiExceptionNotAuthorized('No access to list records for module: ' . $linkModuleName);
        }

        $options = $this->parseArguments($api, $args, $linkSeed);

        // If they don't have fields selected we need to include any link fields
        // for this relationship
        if (empty($args['fields']) && is_array($linkSeed->field_defs)) {
            $relatedLinkName           = $record->$linkName->getRelatedModuleLinkName();
            $options['linkDataFields'] = array();
            foreach ($linkSeed->field_defs as $field => $def) {
                if (empty($def['rname_link']) || empty($def['link'])) {
                    continue;
                }
                if ($def['link'] != $relatedLinkName) {
                    continue;
                }
                // It's a match
                $options['linkDataFields'][] = $field;
                $options['select'][]         = $field;
            }
        }

        // In case the view parameter is set, reflect those fields in the
        // fields argument as well so formatBean only takes those fields
        // into account instead of every bean property.
        if (!empty($args['view'])) {
            $args['fields'] = $options['select'];
        } elseif (!empty($args['fields'])) {
            $args['fields'] = $this->normalizeFields($args['fields'], $options['displayParams']);
        }

        $q = self::getQueryObject($linkSeed, $options);
        // Some relationships want the role column ignored
        if (!empty($args['ignore_role'])) {
            $ignoreRole = true;
        } else {
            $ignoreRole = false;
        }

        $q->setJoinOn(array('baseBeanId' => $record->id));

        if (is_null($orderIds) === true) {
            $orderIds = [];
        }

        $q->where()->in("id", array_values($orderIds));

        if (!isset($args['filter']) || !is_array($args['filter'])) {
            $args['filter'] = array();
        }
        self::addFilters($args['filter'], $q->where(), $q);

        if (!sizeof($q->order_by)) {
            self::addOrderBy($q, $this->defaultOrderBy);
        }

        list($args, $q, $options, $linkSeed) = array($args, $q, $options, $linkSeed);

        $result = $this->runQuery($api, $args, $q, $options, $linkSeed);

        //add order types
        $contactPartyTypes = $relatedOrdersOfContact["party_types"];
        $relatedOrders = $relatedOrdersOfContact["orders_id"];

        if (count($result["records"]) > 0) {
            foreach ($result["records"] as $key => $record) {
                $roleType                             = $this->constructOrderType($relatedOrders, $contactPartyTypes, $record["id"]);
                $result['records'][$key]["role_type"] = $roleType;
            }
        }

        return $result;
    }

    public function getRelatedOrdersOfContact($api, $args)
    {
        $contactId = $args["record"];

        $contactPartyIds = $this->getContactParty($contactId);

        if (count($contactPartyIds) < 1) {
            return false;
        }

        $orderIds   = [];
        $partyTypes = [];
        $currentOrderIds = [];

        foreach ($contactPartyIds as $key => $partyId) {
            $partyBean = BeanFactory::retrieveBean(QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME, $partyId, array('disable_row_level_security' => true));
            
            if($partyBean->party_type !== "Associates"){
                $partyBean->load_relationship(QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL);

                $linkedOrdersDirectly = $partyBean->{QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL}->get();

                if(count($linkedOrdersDirectly) > 0){
                    list("orders_id" => $currentOrderIds,
                    "party_types"    => $currentPartyTypes) = $this->getDirectlyLinkedOrders($orderIds, $partyTypes, $linkedOrdersDirectly, $partyBean, null);
                }
            } else {
                list("orders_id" => $currentOrderIds,
                "party_types"    => $currentPartyTypes) = $this->getOrdersIdFromParties($partyId);
            }
            
            if (count($currentOrderIds) > 0) {
                $orderIds = array_merge($orderIds, $currentOrderIds);
                $partyTypes = array_merge($partyTypes, $currentPartyTypes);
            }
        }

        if (count($orderIds) < 1) {
            return [
                "orders_id"   => [],
                "party_types" => [],
            ];
        }

        return [
            "orders_id"   => $orderIds,
            "party_types" => $partyTypes,
        ];
    }

    private function getDirectlyLinkedOrders(array $orderIds, array $partyTypes, array $linkedOrderIds, SugarBean $partyBean)
    {
        $partyBeanType = preg_replace('/(?<!^)([A-Z])/', ' \\1', $partyBean->party_type);
        $partyId       = $partyBean->id;

        foreach ($linkedOrderIds as $linkedOrderId) {
            if (array_key_exists($linkedOrderId, $orderIds) === false) {
                $orderIds[$linkedOrderId]   = [];
                $orderIds[$linkedOrderId][] = $partyId;
            } else {
                $orderIds[$linkedOrderId][] = $partyId;
                $orderIds[$linkedOrderId]   = array_unique($orderIds[$linkedOrderId]);
            }

            $partyTypes[$partyId] = $partyBeanType;
        }

        return [
            "orders_id"   => $orderIds,
            "party_types" => $partyTypes,
        ];
    }

    /**
     *
     * [orderId1] => [partyId1, partyId2...],
     * [orderId2] => [partyId1, partyId2...]
     *
     * @param String $partiesId
     * @return array
     */
    private function getOrdersIdFromParties(string $partiesId): array
    {
        $query = <<<EOQ
      SELECT DISTINCT
        party_rq_party_order_rq_orderorder_rq_order_idb as order_id,
        party_rq_party_order_rq_orderparty_rq_party_ida as party_id
      FROM
        party_rq_party_order_rq_order_c
      WHERE
        party_rq_party_order_rq_orderparty_rq_party_ida = ?
      AND
        deleted = 0
EOQ;

        $db         = DBManagerFactory::getInstance();
        $this->conn = $db->getConnection();

        $params   = [];
        $params[] = $partiesId;

        $exec = $this->conn->executeQuery($query, $params);

        if ($exec instanceof \Doctrine\DBAL\Portability\Statement === false
            && $exec instanceof \Doctrine\DBAL\ForwardCompatibility\Result === false) {
            $logger = LoggerManager::getLogger();
            $logger->fatal("Qualia getOrderIdFromParties failed");
            return [];
        }

        $results = $exec->fetchAllAssociative();
        $response = [
            "order_id" => [],
            "party_types" => [],
        ];

        foreach ($results as $row) {
            $orderId = $row["order_id"];
            $partyId = $row["party_id"];
            $partyBeanType = $this->getParentPartyType($partyId);
            $partyType = preg_replace('/(?<!^)([A-Z])/', ' \\1', $partyBeanType);

            if (array_key_exists($orderId, $response["order_id"])) {
                $response["orders_id"][$orderId][] = $partyId;
                $response["orders_id"][$orderId]   = array_unique($response[$orderId]);
            } else {
                $response["orders_id"][$orderId][] = $partyId;
            }

            $response["party_types"][$partyId] = $partyType;
        }
        return $response;
    }

    private function getParentPartyType($partyId) 
    {
        global $db;

        $query = <<<EOQ
      SELECT
        party_type
      FROM
        party_rq_party
      WHERE
        id = ?
      AND
        deleted = 0
EOQ;
        $conn = $db->getConnection();
        $exec = $conn->executeQuery($query, array($partyId));

        if ($exec != null) {
            $fetchedQuery = $exec->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                return $fetchedQuery[0]["party_type"];
            }
        }

        return [];
    }

    /**
     * Get the id of the party that represent the contact function
     *
     * @param String $contactId id of the contact record
     * @return array
     */
    private function getContactParty($contactId)
    {
        global $db;

        $query = <<<EOQ
      SELECT
        id
      FROM
        party_rq_party
      WHERE
        parent_id = ?
      AND
        parent_type = 'Contacts'
      AND
        deleted = 0
EOQ;

        $conn = $db->getConnection();
        $exec = $conn->executeQuery($query, array($contactId));

        if ($exec != null) {
            $fetchedQuery = $exec->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $ids = [];
                foreach ($fetchedQuery as $key => $value) {
                    $ids[] = $value["id"];

                }
                return $ids;
            }
        }

        return [];
    }

    public function constructOrderType($relatedOrders, $partyType, $orderId)
    {
        $allParties = [];
        $partyIds   = $relatedOrders[$orderId];

        foreach ($partyIds as $key => $value) {
            $allParties[] = $partyType[$value];
        }

        $allParties = array_unique($allParties);

        if (count($allParties) < 1) {
            return [];
        }

        return $allParties;
    }

    public function filterRelatedLeanCount(ServiceBase $api, array $args)
    {
        $resultCount                 = [];
        $resultCount["record_count"] = 0;

        if (isset($args['max_num'])) {
            $args['max_num'] = (int) $args['max_num'];
        }

        if (!isset($args['max_num'])
            || $args['max_num'] <= 0) {
            throw new SugarApiExceptionMissingParameter('max_num parameter is missing or invalid');
        }

        $api->action    = 'list';
        $args['fields'] = 'id';
        $args['view']   = '';

        $relatedOrdersOfContact = $this->getRelatedOrdersOfContact($api, $args);

        if(empty($relatedOrdersOfContact)){
            return [];
        }
        $orderIds = array_keys($relatedOrdersOfContact["orders_id"]);

        $record = BeanFactory::retrieveBean($args['module'], $args['record']);

        if (empty($record)) {
            throw new SugarApiExceptionNotFound(
                sprintf(
                    'Could not find parent record %s in module: %s',
                    $args['record'],
                    $args['module']
                )
            );
        }

        // Load the relationship.
        $linkName = $args['link_name'];

        if (!$record->load_relationship($linkName)) {
            // The relationship did not load.
            throw new SugarApiExceptionNotFound('Could not find a relationship named: ' . $args['link_name']);
        }
        $linkModuleName = $record->$linkName->getRelatedModuleName();
        $linkSeed       = BeanFactory::newBean($linkModuleName);
        if (!$linkSeed->ACLAccess('list')) {
            throw new SugarApiExceptionNotAuthorized('No access to list records for module: ' . $linkModuleName);
        }

        $options = $this->parseArguments($api, $args, $linkSeed);

        // If they don't have fields selected we need to include any link fields
        // for this relationship
        if (empty($args['fields']) && is_array($linkSeed->field_defs)) {
            $relatedLinkName           = $record->$linkName->getRelatedModuleLinkName();
            $options['linkDataFields'] = array();
            foreach ($linkSeed->field_defs as $field => $def) {
                if (empty($def['rname_link']) || empty($def['link'])) {
                    continue;
                }
                if ($def['link'] != $relatedLinkName) {
                    continue;
                }
                // It's a match
                $options['linkDataFields'][] = $field;
                $options['select'][]         = $field;
            }
        }

        // In case the view parameter is set, reflect those fields in the
        // fields argument as well so formatBean only takes those fields
        // into account instead of every bean property.
        if (!empty($args['view'])) {
            $args['fields'] = $options['select'];
        } elseif (!empty($args['fields'])) {
            $args['fields'] = $this->normalizeFields($args['fields'], $options['displayParams']);
        }

        $q = self::getQueryObject($linkSeed, $options);
        // Some relationships want the role column ignored
        if (!empty($args['ignore_role'])) {
            $ignoreRole = true;
        } else {
            $ignoreRole = false;
        }

        $q->setJoinOn(array('baseBeanId' => $record->id));

        $q->where()->in("id", array_values($orderIds));

        if (!isset($args['filter']) || !is_array($args['filter'])) {
            $args['filter'] = array();
        }
        self::addFilters($args['filter'], $q->where(), $q);

        if (!sizeof($q->order_by)) {
            self::addOrderBy($q, $this->defaultOrderBy);
        }

        list($args, $q, $options, $linkSeed) = array($args, $q, $options, $linkSeed);

        $result = $this->runQuery($api, $args, $q, $options, $linkSeed);

        $resultCount                 = [];
        $resultCount["record_count"] = count($result["records"]);
        $resultCount["has_more"]     = $resultCount["record_count"] > $args['max_num'];

        return $resultCount;
    }
}
