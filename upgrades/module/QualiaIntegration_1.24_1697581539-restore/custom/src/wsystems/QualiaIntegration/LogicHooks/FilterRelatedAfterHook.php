<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\LogicHooks;

use DBManagerFactory;
use Doctrine\DBAL\ForwardCompatibility\Result as Result;
use Doctrine\DBAL\Portability\Statement as Statement;

class FilterRelatedAfterHook
{
    public function filterRelatedAfter(string $event, array $options)
    {
        if (
            $event === "RelateApi_filterRelated_after"
            && $options["args"]["module"] === "Accounts"
            && $options["args"]["link_name"] === "order_rq_order_accounts"
        ) {
            $this->handleAccountsRoleType($options);
        }
    }

    private function handleAccountsRoleType($options)
    {
        $accountID = $options["args"]["record"];
        $records   = $options["parent"]["records"];

        if (count($records) === 0) {
            return;
        }

        $orderIDs = $this->getOrderIDs($records);
        $types    = $this->getTypes($accountID, $orderIDs);

        foreach ($records as $key => $record) {
            $roleType                                        = $types[$record["id"]];
            $options["parent"]["records"][$key]["role_type"] = $roleType;
        }
    }

    private function getOrderIDs($records)
    {
        $orderIDs = [];
        foreach ($records as $record) {
            $orderIDs[] = $record["id"];
        }
        return $orderIDs;
    }

    private function getTypes($recordID, $orderIDs)
    {
        $db    = DBManagerFactory::getInstance();
        $query = <<<SQL
SELECT
    o.id,
    p.party_type role_type
FROM
    order_rq_order o
INNER JOIN
    party_rq_party_order_rq_order_c po
ON
	o.id = po.party_rq_party_order_rq_orderorder_rq_order_idb
AND
	po.deleted = {$db->quoted("O")}
INNER JOIN
    party_rq_party p
ON
    po.party_rq_party_order_rq_orderparty_rq_party_ida = p.id
AND
	p.deleted = {$db->quoted("O")}
INNER JOIN
    accounts a
ON
	p.parent_id = a.id
AND
	a.deleted = {$db->quoted("O")}
WHERE
	a.id = ?
AND
    o.id IN (?)
AND
	o.deleted = {$db->quoted("O")}

SQL;

        $conn   = $db->getConnection();
        $params = [$recordID, $orderIDs];
        $types  = [
            \PDO::PARAM_STR,
            \Sugarcrm\Sugarcrm\Dbal\Connection::PARAM_STR_ARRAY,
        ];
        $results = $conn->executeQuery($query, $params, $types);

        $types = [];
        if ($results instanceof Statement === false && $results instanceof Result === false) {
            return $types;
        }

        $data = $results->fetchAllAssociative();
        foreach ($data as $row) {
            $partyBeanType     = preg_replace('/(?<!^)([A-Z])/', ' \\1', $row["role_type"]);
            $types[$row["id"]] = $partyBeanType;
        }

        return $types;
    }
}
