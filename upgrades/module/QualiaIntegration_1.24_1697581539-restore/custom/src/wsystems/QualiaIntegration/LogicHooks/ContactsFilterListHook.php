<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\LogicHooks;

use DBManagerFactory;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils\QualiaGlobalVariables;
use Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits\ModuleConfigTrait;

class ContactsFilterListHook
{
    use ModuleConfigTrait;

    public function addFilterBefore($field, $filter, $where = null, $q = null)
    {
        $field  = $filter["field"];
        $module = $filter["module"];

        $allowedOpperatorsFields = [
            QualiaGlobalVariables::ORDER_FILTER_MASK_FOR_CONTACTS_NAME,
            "\$and",
        ];

        if (in_array($field, $allowedOpperatorsFields) === false || $module !== QualiaGlobalVariables::CONTACT_MODULE_NAME) {
            return;
        }

        // open contacts drawer for one of the party types on Order list view
        if (array_key_exists("filter", $filter) && isset($filter["filter"]["\$equals"])) {
            $fieldName  = $filter["filter"]["\$equals"];
            $relatedIDs = $this->getRelatedContacts($fieldName);

            unset($filter["filter"]["\$equals"]);
            $filter["field"]          = "id";
            $filter["filter"]["\$in"] = $relatedIDs;

            return;
        }

        $filters = $filter["filter"];

        // type contacts name for one of the party types on Order list view
        foreach ($filters as $filterKey => $filterValue) {

            foreach ($filterValue as $key => $value) {

                if ($key !== QualiaGlobalVariables::ORDER_FILTER_MASK_FOR_CONTACTS_NAME) {
                    continue;
                }

                $relatedIDs = $this->getRelatedContacts($value);

                unset($filter["filter"][$filterKey][$key]);
                $filter["filter"][$filterKey]["id"] = ["\$in" => $relatedIDs];
            }
        }
    }

    private function getRelatedContacts($fieldName): array
    {
        $roles = $this->getRelatedRoles($fieldName);

        $db   = DBManagerFactory::getInstance();
        $conn = $db->getConnection();

        $query    = $this->getFilterQuery();
        $params[] = $roles;
        $types[]  = \Sugarcrm\Sugarcrm\Dbal\Connection::PARAM_STR_ARRAY;

        $results = $conn->executeQuery($query, $params, $types);

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

    private function getRelatedRoles($fieldName): array
    {
        switch ($fieldName) {
            case QualiaGlobalVariables::PARTY_LISTING_AGENT_SALES_REPS:
                $roleKey = "listing_agent_sales_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_SELLING_AGENT_SALES_REPS:
                $roleKey = "selling_agent_sales_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_LISTING_AGENT_CREDIT_REPS:
                $roleKey = "listing_agent_credit_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_SELLING_AGENT_CREDIT_REPS:
                $roleKey = "selling_agent_credit_reps_config";
                break;
            case QualiaGlobalVariables::PARTY_ESCROW_CLOSER:
                $roleKey = "escrow_closer_config";
                break;
            case QualiaGlobalVariables::PARTY_TITLE_OFFICER:
                $roleKey = "title_officer_config";
                break;
            case QualiaGlobalVariables::PARTY_MARKETER:
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

    private function getFilterQuery()
    {
        $query = <<<EOQ
        SELECT
            c.id
        FROM
            contacts c
        INNER JOIN
            party_rq_party p
        ON
            c.id = p.parent_id
        INNER JOIN
            party_rq_party_order_rq_order_c po
        ON
            p.id = po.party_rq_party_order_rq_orderparty_rq_party_ida
        INNER JOIN
            order_rq_order o
        ON
            o.id = po.party_rq_party_order_rq_orderorder_rq_order_idb
        WHERE
            p.qualia_parent_role IN (?)
        AND
            c.deleted = 0
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
