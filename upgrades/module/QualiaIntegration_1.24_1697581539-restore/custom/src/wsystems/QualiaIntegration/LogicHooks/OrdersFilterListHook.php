<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\LogicHooks;

use DBManagerFactory;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils\QualiaGlobalVariables;
use Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits\ModuleConfigTrait;

class OrdersFilterListHook
{
    use ModuleConfigTrait;

    public function addFilterBefore($field, $filter, $where = null, $q = null)
    {
        $module = $filter["module"];

        if ($module !== QualiaGlobalVariables::ORDER_MODULE_NAME) {
            return;
        }

        $field         = $filter["field"];
        $allowedFields = [
            QualiaGlobalVariables::PARTY_LISTING_AGENT_SALES_REPS_REL_NAME,
            QualiaGlobalVariables::PARTY_SELLING_AGENT_SALES_REPS_REL_NAME,
            QualiaGlobalVariables::PARTY_LISTING_AGENT_CREDIT_REPS_REL_NAME,
            QualiaGlobalVariables::PARTY_SELLING_AGENT_CREDIT_REPS_REL_NAME,
            QualiaGlobalVariables::PARTY_ESCROW_CLOSER_REL_NAME,
            QualiaGlobalVariables::PARTY_TITLE_OFFICER_REL_NAME,
            QualiaGlobalVariables::PARTY_MARKETER_REL_NAME,
        ];

        if (in_array($field, $allowedFields) === false) {
            return;
        }

        if (isset($filter["filter"]) === false || count($filter["filter"]) < 1) {
            return;
        }

        $filters = $filter["filter"];

        foreach ($filters as $key => $filterValue) {
            $contactIDs = $filterValue;

            $relatedIDs = $this->getRelatedOrders($field, $contactIDs);

            $filter["field"]        = "id";
            $filter["filter"][$key] = $relatedIDs;
        }
    }

    private function getRelatedOrders($field, $contactIDs): array
    {
        $roles = $this->getRelatedRoles($field);

        $db   = DBManagerFactory::getInstance();
        $conn = $db->getConnection();

        $query    = $this->getSalesRepsQuery();
        $params[] = $contactIDs;
        $types[]  = \Sugarcrm\Sugarcrm\Dbal\Connection::PARAM_STR_ARRAY;

        $params[] = $roles;
        $types[]  = \Sugarcrm\Sugarcrm\Dbal\Connection::PARAM_STR_ARRAY;
        $results  = $conn->executeQuery($query, $params, $types);

        if ($results instanceof \Doctrine\DBAL\Portability\Statement === false
            && $results instanceof \Doctrine\DBAL\ForwardCompatibility\Result === false) {
            return [];
        }

        $fetchedQuery = $results->fetchAllAssociative();

        $response = [];
        foreach ($fetchedQuery as $row) {
            $response[] = $row["id"];
        }

        return $response;
    }

    private function getRelatedRoles($field): array
    {
        switch ($field) {
            case QualiaGlobalVariables::PARTY_LISTING_AGENT_SALES_REPS_REL_NAME:
                $roleKey = "listing_agent_sales_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_SELLING_AGENT_SALES_REPS_REL_NAME:
                $roleKey = "selling_agent_sales_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_LISTING_AGENT_CREDIT_REPS_REL_NAME:
                $roleKey = "listing_agent_credit_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_SELLING_AGENT_CREDIT_REPS_REL_NAME:
                $roleKey = "selling_agent_credit_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_ESCROW_CLOSER_REL_NAME:
                $roleKey = "escrow_closer_config";
                break;
            case QualiaGlobalVariables::PARTY_TITLE_OFFICER_REL_NAME:
                $roleKey = "title_officer_config";
                break;
            case QualiaGlobalVariables::PARTY_MARKETER_REL_NAME:
                $roleKey = "marketer_config";
                break;
            default:
                return [];
        }

        $settlementTeamRolesConfig = $this->modConfigGet();
        $settlementTeamRoles       = $settlementTeamRolesConfig["qualia-admin-panel"];
        $selectedRoleValues        = $settlementTeamRoles[$roleKey];
        $roles                     = explode(",", $selectedRoleValues);
        $response                  = [];

        foreach ($roles as $role) {
            $response[] = trim($role);
        }

        return $response;
    }

    private function getSalesRepsQuery()
    {
        $query = <<<EOQ
        SELECT
            DISTINCT o.id
        FROM
            order_rq_order o
        INNER JOIN
            party_rq_party_order_rq_order_c po
        ON
            o.id = po.party_rq_party_order_rq_orderorder_rq_order_idb
        INNER JOIN
            party_rq_party p
        ON
            p.id = po.party_rq_party_order_rq_orderparty_rq_party_ida
        INNER JOIN
            contacts c
        ON
            c.id = p.parent_id
        WHERE
            c.id IN (?)
        AND
            p.qualia_parent_role IN (?)
        AND
            p.deleted = 0
        AND
            o.deleted = 0
        AND
            po.deleted = 0
EOQ;

        return $query;
    }

}
