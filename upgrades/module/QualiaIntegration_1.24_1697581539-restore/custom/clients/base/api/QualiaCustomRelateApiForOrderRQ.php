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

class QualiaCustomRelateApiForOrderRQ extends RelateApi
{

    public function registerApiRest()
    {
        return array(
            'filterRelatedRecords'          => array(
                'reqType'    => 'GET',
                'path'       => array('Order_RQ_Order', '?', 'link', 'order_linked_contacts'),
                'pathVars'   => array('module', 'record', '', 'link_name'),
                'jsonParams' => array('filter'),
                'method'     => 'filterRelated',
                'shortHelp'  => 'Lists related records.',
                'longHelp'   => 'include/api/help/module_record_link_link_name_filter_get_help.html',
            ),
            'getCollectionCount'            => array(
                'reqType'   => 'GET',
                'path'      => array('Order_RQ_Order', '?', 'link', 'order_linked_contacts', 'count'),
                'pathVars'  => array('module', 'record', '', 'collection_name', ''),
                'method'    => 'getCollectionCount',
                'shortHelp' => 'Counts collection records.',
                'longHelp'  => 'include/api/help/module_record_collection_collection_name_count_get_help.html',
            ),
            'filterRelatedRecordsLeanCount' => array(
                'reqType'    => 'GET',
                'minVersion' => '11.4',
                'path'       => array('Order_RQ_Order', '?', 'link', 'order_linked_contacts', 'filter', 'leancount'),
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
                'path'       => array('Order_RQ_Order', '?', 'link', 'order_linked_contacts', 'leancount'),
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

        $orderIds = $this->getRelatedContactsOfOrder($api, $args);

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
        $resultCount["record_count"] = count($orderIds["orders_id"]);

        return $resultCount;
    }

    public function filterRelated(ServiceBase $api, array $args)
    {
        $emptyResult = [
            "next_offset" => -1,
            "records"     => [],
        ];
        $linkName = $args["link_name"];

        if ($linkName !== "order_linked_contacts") {
            return parent::filterRelated($api, $args);
        }

        $api->action = 'list';

        $data            = [];
        $data['records'] = [];

        $relatedContactsOfOrder = $this->getRelatedContactsOfOrder($api, $args);

        if (empty($relatedContactsOfOrder["orders_id"]) === true) {
            return $emptyResult;
        }

        $orderIds          = array_values($relatedContactsOfOrder["orders_id"]);
        $contactPartyTypes = $relatedContactsOfOrder["party_types"];

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

        if (count($result["records"]) > 0) {
            foreach ($result["records"] as $key => $record) {
                $result['records'][$key]["role_type"] = $contactPartyTypes[$record["id"]];
            }
        }

        return $result;
    }

    public function getRelatedContactsOfOrder($api, $args)
    {
        $orderID           = $args["record"];
        $orderBean         = BeanFactory::retrieveBean(QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME, $orderID);

        if (is_null($orderBean) === true) {
            return [
                "orders_id"   => [],
                "party_types" => [],
            ];
        }

        $orderBean->load_relationship(QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL);
        $orderParties = $orderBean->{QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL}->getBeans();
        
        $relatedContactsOfOrder = [];
        list("relatedIDs" => $relatedContactsOfOrder["orders_id"],
         "relatedPartyTypes" => $relatedContactsOfOrder["party_types"]) = $this->getRelatedContactsName($orderParties);

        return $relatedContactsOfOrder;
    }

    private function getRelatedContactsName($parties)
    {
        $relatedPartyTypes = [];

        foreach ($parties as $key => $partyBean) {

            if($partyBean->parent_type === "Contacts")
                {
                    $contactId = $partyBean->parent_id;

                    $isContactDeleted = QualiaUtils\Queries::checkIfContactIsDeleted($contactId);
                    if ($isContactDeleted === true) {
                        continue;
                    }

                    $relatedIDs[] = $contactId;

                    $partyBeanType = preg_replace('/(?<!^)([A-Z])/', ' \\1', $partyBean->party_type);

                    if (array_key_exists($contactId, $relatedPartyTypes) === true) {
                        $relatedPartyTypes[$contactId] .= ", " . $partyBeanType;
                    } else {
                        $relatedPartyTypes[$contactId] = $partyBeanType;
                    }
                }
        }

        return [
            "relatedIDs"        => $relatedIDs,
            "relatedPartyTypes" => $relatedPartyTypes,
        ];
    }

    public function filterRelatedLeanCount(ServiceBase $api, array $args)
    {
        $orderIds = $this->getRelatedContactsOfOrder($api, $args);

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
