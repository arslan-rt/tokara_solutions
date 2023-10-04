<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

use DBManagerFactory;

class Queries
{
    public static function insertFailedRecord($tableName, $message, $data, $id = null)
    {
        global $db;

        $sql = <<<EOQ
            INSERT INTO
                {$tableName}
            (
                id,
                order_data,
                error_message,
                date_created,
                date_modified
            )
            VALUES
                (
                    '{$id}',
                    '{$data}',
                    '{$message}',
                    NOW(),
                    NOW()
                )
            ON DUPLICATE KEY UPDATE
                order_data = '{$data}',
                error_message = '{$message}',
                date_modified = NOW()
EOQ;
        $conn = $db->getConnection();
        $exec = $conn->executeQuery($sql, array());
    }

    public static function checkIfContactIsDeleted($contactId)
    {
        global $db;

        $sql = <<<EOQ
      SELECT
        id
      FROM
        contacts
      WHERE
        deleted = 0
      AND
        id = ?
EOQ;
        $params  = [$contactId];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results !== null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * getOrderById function
     *
     * @param String $id
     * @return String|Bool
     */
    public static function getOrderById(String $id)
    {
        global $db;

        $sql = <<<EOQ
            SELECT
                id
            FROM
                order_rq_order
            WHERE
                deleted = 0
            AND
                qualia_id = ?
EOQ;
        $params  = [$id];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results !== null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $sugarId = $fetchedQuery[0]['id'];

                return $sugarId;
            }
        }

        return false;
    }

    /**
     * getOrderById function
     *
     * @param String $id
     * @return String|Bool
     */
    public static function getOrderByUnqiueHash(String $hash)
    {
        global $db;

        $sql = <<<EOQ
            SELECT
                id
            FROM
                order_rq_order
            WHERE
                deleted = 0
            AND
                qualia_unique_hash = ?
EOQ;
        $params  = [$hash];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $sugarId = $fetchedQuery[0]['id'];

                return $sugarId;
            }
        }

        return false;
    }

    /**
     * return the id of the matching party record
     *
     * @param String $typeField - field name for type
     * @param String $idField   - field name for id
     * @param String $typeValue - field value for type
     * @param String $idValue   - field value for id
     * @return String
     */
    public static function getPartyByTypeAndId($typeField, $idField, $typeValue, $idValue)
    {
        global $db;

        $sql = <<<EOQ
      SELECT
        id
      FROM
        party_rq_party
      WHERE
        {$typeField} = ?
      AND
        {$idField} = ?
      AND
        deleted = 0
EOQ;
        $params  = [$typeValue, $idValue];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $id = $fetchedQuery[0]["id"];

                return $id;
            }
        }

        return false;
    }

    public static function getAssociateParty($typeField, $typeValue, $idField, $idValue,
        $parentPartyType, $parentPartyTypeValue) {
        global $db;

        $sql = <<<EOQ
      SELECT
        id
      FROM
        party_rq_party
      WHERE
        {$typeField} = ?
      AND
        {$idField} = ?
      AND
        {$parentPartyType} = ?
      AND
        deleted = 0
EOQ;
        $params  = [$typeValue, $idValue, $parentPartyTypeValue];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $id = $fetchedQuery[0]["id"];

                return $id;
            }
        }

        return false;
    }

    /**
     * return the id of the matching record
     *
     * @param String $typeField - field name for type
     * @param String $idField   - field name for id
     * @param String $idValue   - field value for id
     * @return String
     */
    public static function getRecordIdAndDiffHashByUniqueId($module, $idField, $idValue)
    {
        global $db;

        $sql = <<<EOQ
      SELECT
        id,
        qualia_diff_hash
      FROM
        {$module}
      WHERE
        {$idField} = ?
      AND
        deleted = 0
EOQ;
        $params  = [$idValue];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $data = $fetchedQuery[0];

                return $data;
            }
        }

        $response = ["id" => false];
        return $response;
    }

    public static function getRecordIdAndDiffHashByQualiaId($module, $idField, $idValue)
    {
        global $db;

        $sql = <<<EOQ
      SELECT
        id,
        qualia_diff_hash
      FROM
        {$module}
      WHERE
        {$idField} = ?
      AND
        deleted = 0
EOQ;
        $params  = [$idValue];
        $conn    = $db->getConnection();
        $results = $conn->executeQuery($sql, $params);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $data = $fetchedQuery[0];

                return $data;
            }
        }

        $response = ["id" => false];
        return $response;
    }

    /**
     * return the parent_id of the given party
     *
     * @param string $partyID
     * @return string
     */
    public static function getParentId($partyID)
    {
        $sql = <<<EOQ
      SELECT
        parent_id
      FROM
        party_rq_party
      WHERE
        id = ?
      AND
        deleted = 0
EOQ;
        $db   = DBManagerFactory::getInstance();
        $conn = $db->getConnection();

        $results = $conn->executeQuery($sql, [$partyID]);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $id = $fetchedQuery[0]["parent_id"];

                return $id;
            }
        }

        return "";
    }

    /**
     * Get the types of parties that represent the record parent
     *
     * @param string $recordID id of the contact record
     * @return array
     */
    public static function getRecordPartyTypes(string $recordID)
    {
        global $db;

        $query = <<<EOQ
        SELECT
            DISTINCT party_type
        FROM
            party_rq_party p
        INNER JOIN
            party_rq_party_order_rq_order_c po
        ON
            p.id = po.party_rq_party_order_rq_orderparty_rq_party_ida
        WHERE
            p.parent_id = ?
        AND
            p.deleted = 0
        AND
            po.deleted = 0
EOQ;

        $conn = $db->getConnection();
        $exec = $conn->executeQuery($query, [$recordID]);

        $results = [];
        if ($exec != null) {
            $fetchedQuery = $exec->fetchAllAssociative();

            foreach ($fetchedQuery as $row) {
                $results[] = $row["party_type"];
            }
        }

        return $results;
    }

    /**
     * Get the types of parties that represent the record parent
     *
     * @param string $tableName name of the table
     * @param string $recordID id of the record
     * @param string $fieldName name of the field
     * @param string $fieldValue value of the field
     * @return array
     */
    public static function updateFieldValue(string $tableName, string $recordID, string $fieldName, string $fieldValue)
    {
        $db   = DBManagerFactory::getInstance();
        $conn = $db->getConnection();

        $query = <<<EOQ
        UPDATE
            {$tableName}
        SET
            {$fieldName} = ?
        WHERE
            deleted = 0
        AND
            id = ?
EOQ;

        $exec = $conn->executeQuery($query, [$fieldValue, $recordID]);
    }

    /**
     * return the id of the matching party record
     *
     * @param string $partyType name of the party type field
     * @param string $typeValue value of the party type field
     * @param string $idField name of the unique id field
     * @param string $idValue value of the unique id field
     * @param string $parentRoleField value of the parent's user role
     * @param string $parentRoleValue value of the parent's user role
     * @return string || false
     */
    public static function getSettlementTeamParty(string $partyType, string $typeValue,
        string $idField, string $idValue, string $parentRoleField, string $parentRoleValue) {
        $sql = <<<EOQ
      SELECT
        id
      FROM
        party_rq_party
      WHERE
        {$partyType} = ?
      AND
        {$idField} = ?
      AND
        {$parentRoleField} = ?
      AND
        deleted = 0
EOQ;

        $db      = DBManagerFactory::getInstance();
        $conn    = $db->getConnection();
        $params  = [$typeValue, $idValue, $parentRoleValue];
        $results = $conn->executeQuery($sql, $params);

        if ($results != null) {
            $fetchedQuery = $results->fetchAllAssociative();

            if (count($fetchedQuery) > 0) {
                $id = $fetchedQuery[0]["id"];

                return $id;
            }
        }

        return false;
    }
}
