<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits;

use DBManagerFactory;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use TimeDate;

/**
 * *** ModuleConfigTrait ***
 *
 * This trait manipulates custom configuration table.
 * It takes care of everything, including creating table, deleting table and
 * inserting/updating table records.
 *
 * @version 1.0.6
 * @since SugarCRM 8.0
 * @since PHP 7.1
 */
trait ModuleConfigTrait
{
    /**
     * @access protected
     *
     * @var array
     */
    protected $modConfigMetadata = [
        "fields"  => [
            "assigned_user_id" => [
                "name"     => "assigned_user_id",
                "type"     => "id",
                "required" => true,
                "isnull"   => false,
                "default"  => "",
            ],
            "category"         => [
                "name"     => "category",
                "type"     => "varchar",
                "required" => true,
                "isnull"   => false,
            ],
            "name"             => [
                "name"     => "name",
                "type"     => "varchar",
                "required" => true,
                "isnull"   => false,
            ],
            "date_created"     => [
                "name" => "date_created",
                "type" => "datetime",
            ],
            "date_modified"    => [
                "name" => "date_modified",
                "type" => "datetime",
            ],
            "content"          => [
                "name" => "content",
                "type" => "text",
            ],
        ],
        "indices" => [
            [
                "name"   => "config_primary_key",
                "type"   => "primary",
                "fields" => [
                    "assigned_user_id", "category", "name",
                ],
            ],
            [
                "name"   => "idx_category_name",
                "type"   => "index",
                "fields" => [
                    "category", "name",
                ],
            ],
            [
                "name"   => "ids_user_id",
                "type"   => "index",
                "fields" => [
                    "assigned_user_id",
                ],
            ],
        ],
    ];

    /**
     * Creates the custom config table.
     *
     * @return string
     */
    public function modConfigTableCreate(): string
    {
        $db = DBManagerFactory::getInstance();

        $tableName = $this->modConfigTableGetName();

        $fields  = $this->modConfigMetadata["fields"];
        $indices = $this->modConfigMetadata["indices"];

        return $db->repairTableParams($tableName, $fields, $indices);
    }

    /**
     * Creates the table if not exists and loads it into the global $dictionary variable.
     *
     * @return void
     */
    public function modConfigMetaLoad(): void
    {
        global $dictionary;

        if ($this->modConfigTableExists() === false) {
            $this->modConfigTableCreate();
        }

        $tableName = $this->modConfigTableGetName();
        $fields    = $this->modConfigMetadata["fields"];
        $indices   = $this->modConfigMetadata["indices"];

        $dictionary[$tableName] = [
            "table"   => $tableName,
            "fields"  => $fields,
            "indices" => $indices,
        ];
    }

    /**
     * Truncates the custom config table.
     *
     * @return void
     */
    public function modConfigTableTruncate(): void
    {
        $db = DBManagerFactory::getInstance();

        $db->query($db->truncateTableSQL($this->modConfigTableGetName()));
    }

    /**
     * Drops the custom config table.
     *
     * @return void
     */
    public function modConfigTableDrop(): void
    {
        $db = DBManagerFactory::getInstance();

        $db->query($db->dropTableName($this->modConfigTableGetName()));
    }

    /**
     * Inserts or updates data to the custom config table.
     *
     * <code>
     *
     * $this->configSet([
     *     "sync_settings" => [
     *         "username" => "user",
     *         "password" => "pass"
     *     ],
     * ], [
     *     "isCurrentUser" => true
     * ]); // Store configuration specific to current user
     *
     * --------------------
     *
     * $this->configSet([
     *     "logger_settings" => [
     *         "can_log"   => 1,
     *         "log_level" => "fatal"
     *     ],
     * ], [
     *     "userId" => "will_smith"
     * ]); // Store configuration specific to the user with id => will_smith
     *
     * --------------------
     *
     * $this->configSet([
     *     "sync_settings" => [
     *         "username" => "user",
     *         "password" => "pass"
     *     ],
     *     "logger_settings" => [
     *         "can_log"   => 1,
     *         "log_level" => "fatal"
     *     ],
     * ]); // Store global (non user related) configuration
     *
     * </code>
     *
     * Both `sync_settings` and `logger_settings` keys are going to be category names,
     * when doing the database insert/update.
     *
     * @param array $data Array keys will be values to be stored within the `category` column
     * @param array $options
     *      @property boolean "isCurrentUser" True to store configuration related to the current user
     *      @property string "userId"         Id of the user to store configuration for
     *
     * @return array
     *
     * @throws Exception
     * @throws QueryException
     */
    public function modConfigSet(array $data, array $options = []): array
    {
        global $dictionary;
        global $current_user;

        /** @var boolean $isCurrentUser */
        $isCurrentUser = $options["isCurrentUser"] ?? false;

        /** @var string $assignedUser */
        $assignedUser = ($isCurrentUser === true ? $current_user->id : $options["userId"]) ?? "";

        $this->modConfigMetaLoad();

        $status = [
            "status"   => "success",
            "updated"  => 0,
            "inserted" => 0,
        ];

        if (empty($data) === false) {
            $td    = TimeDate::getInstance();
            $db    = DBManagerFactory::getInstance();
            $table = $this->modConfigTableGetName();

            $fieldDefs = $dictionary[$table]["fields"];
            $now       = $td->nowDb();

            $fieldValues = [
                "assigned_user_id" => $assignedUser,
                "date_modified"    => $now,
            ];

            foreach ($data as $category => $fieldsData) {
                foreach ($fieldsData as $fieldName => $fieldValue) {
                    if (\is_array($fieldValue)) {
                        $fieldValue = \json_encode($fieldValue);
                    }

                    if ($this->modConfigCanUpdate($category, $fieldName, $assignedUser) === true) {
                        $fieldValues["name"]    = $fieldName;
                        $fieldValues["content"] = $fieldValue;

                        $updated = $db->updateParams($table, $fieldDefs, $fieldValues, [
                            "category"         => $category,
                            "name"             => $fieldName,
                            "assigned_user_id" => $assignedUser,
                        ]);

                        if ($updated === true) {
                            $status["updated"]++;
                        }
                    } else {
                        $fieldValues["category"]     = $category;
                        $fieldValues["name"]         = $fieldName;
                        $fieldValues["content"]      = $fieldValue;
                        $fieldValues["date_created"] = $now;

                        $inserted = $db->insertParams($table, $fieldDefs, $fieldValues);

                        if ($inserted === true) {
                            $status["inserted"]++;
                        }
                    }
                }
            }
        }

        return $status;
    }

    /**
     * Retrieves data from the custom config table.
     *
     * <code>
     *
     * $this->modConfigGet([
     *     "isCurrentUser" => true
     * ]); // Fetch configuration specific to the current user
     *
     * --------------------
     *
     * $this->modConfigGet([
     *     "userId" => "will_smith"
     * ]); // Fetch configuration specific to the user with id => will_smith
     *
     * --------------------
     *
     * $this->modConfigGet([
     *     "category" => "logger_settings"
     * ]); // Fetch global (non user related) configuration for logger_settings category
     *
     * </code>
     *
     * @param array $options
     *      @property boolean "isCurrentUser"   True to fetch configuration related to the current user
     *      @property string "userId"           Id of the user to fetch configuration for
     *      @property string "category"         Return data related to this category
     *      @property boolean "returnGrouped"   Return data grouped by the category column
     *
     * @return array
     *
     *      returnGrouped: true
     *          [
     *              "logger_settings => [
     *                  "can_log" => true,
     *                  "nr_logs" => 2,
     *              ],
     *              "sync_settings => [
     *                  "retry" => 3,
     *              ],
     *          ]
     *
     *      returnGrouped: false
     *          [
     *              category => "logger_settings"
     *              name     => "can_log"
     *              content  => true
     *          ],
     *          [
     *              category => "logger_settings"
     *              name     => "nr_logs"
     *              content  => 2
     *          ],
     *          [
     *              category => "sync_settings"
     *              name     => "retry"
     *              content  => 3
     *          ],
     *
     * @throws Exception
     * @throws QueryException
     */
    public function modConfigGet(array $options = []): array
    {
        global $current_user;

        if ($this->modConfigTableExists() === false) {
            return [];
        }

        $qb = DBManagerFactory::getConnection()->createQueryBuilder();

        $qb->select("*");
        $qb->from($this->modConfigTableGetName());

        /** @var boolean $isCurrentUser */
        $isCurrentUser = $options["isCurrentUser"] ?? false;

        /** @var string $assignedUser */
        $assignedUser = ($isCurrentUser === true ? $current_user->id : $options["userId"]) ?? "";

        /** @var string $category */
        $category = $options["category"];

        /** @var boolean $returnGrouped */
        $returnGrouped = $options["returnGrouped"] ?? true;

        if (empty($assignedUser) === false) {
            $qb->where($qb->expr()->eq("assigned_user_id", ":assignedUser"));
            $qb->setParameter(":assignedUser", $assignedUser);
        }

        if (\is_string($category) && empty(\trim($category)) === false) {
            $qb->where($qb->expr()->eq("category", ":category"));
            $qb->setParameter(":category", $category);
        }

        $result = $qb->execute();

        if (\is_object($result) && \method_exists($result, "fetchAllAssociative")) {
            $result = $result->fetchAllAssociative();
        }

        if ($returnGrouped === true) {
            $data = [];

            foreach ($result as $item) {
                $category = $item["category"];
                $field    = $item["name"];
                $value    = $item["content"];

                if (isset($data[$category]) === false) {
                    $data[$category] = [];
                }

                $data[$category][$field] = $value;
            }

            return $data;
        }

        return is_array($result) ? $result : [];
    }

    /**
     * Removes date from the custom config table.
     *
     * <code>
     *
     * $this->modConfigRemove(
     *     [
     *         "category" => "user-pref",
     *         "name"     => "last_state",
     *     ]
     * );
     *
     * </code>
     *
     * @param array $options
     *      @property boolean "isCurrentUser"   True to remove configuration related to the current user
     *      @property string "userId"           Id of the user to remove configuration for
     *      @property string "category"         Remove configuration related to this category
     *
     * @return array
     *
     * @throws Exception
     */
    public function modConfigRemove(array $options = []): array
    {
        global $current_user;

        if ($this->modConfigTableExists() === false) {
            return [
                "success" => false,
                "message" => "Configuration table not found.",
            ];
        }

        if (empty($options)) {
            $this->modConfigTableTruncate();

            return [
                "success" => true,
                "message" => "Configuration table fully erased.",
            ];
        }

        $qb = DBManagerFactory::getConnection()->createQueryBuilder();

        $qb->delete($this->modConfigTableGetName());

        /** @var boolean */
        $isCurrentUser = $options["isCurrentUser"] ?? false;

        /** @var string */
        $assignedUser = ($isCurrentUser === true ? $current_user->id : $options["userId"]) ?? "";

        /** @var string */
        $category = $options["category"];

        if (empty($assignedUser) === false) {
            $qb->andWhere($qb->expr()->eq("assigned_user_id", ":assignedUser"));
            $qb->setParameter(":assignedUser", $assignedUser);
        }

        if (\is_string($category) && empty(\trim($category)) === false) {
            $qb->where($qb->expr()->eq("category", ":category"));
            $qb->setParameter(":category", $category);
        }

        $affectedRows = $qb->execute();

        return [
            "success"      => true,
            "affectedRows" => $affectedRows,
        ];
    }

    /**
     *
     * Checks if the given field has been already inserted in the config table,
     * so to know if it requires an update or a clean insert.
     *
     * @access protected
     *
     * @param string $category
     * @param string $field
     * @param null|string $assignedUser
     *
     * @return bool
     *
     * @throws Exception
     * @throws QueryException
     */
    protected function modConfigCanUpdate(string $category, string $field, ?string $assignedUser = null): bool
    {
        $qb = DBManagerFactory::getConnection()->createQueryBuilder();

        $qb->select("COUNT(*) AS record_count");
        $qb->from($this->modConfigTableGetName());

        $qb->where($qb->expr()->eq("category", ":category"));
        $qb->andWhere($qb->expr()->eq("name", ":field"));
        $qb->andWhere($qb->expr()->eq("assigned_user_id", ":user"));

        $qb->setParameter(":category", $category);
        $qb->setParameter(":field", $field);
        $qb->setParameter(":user", $assignedUser);

        $result = $qb->execute();

        if (\is_object($result) && \method_exists($result, "fetchAssociative")) {
            $result = $result->fetchAssociative();
        }

        if (is_array($result) === true && $result["record_count"] > 0) {
            return true;
        }

        return false;
    }

    /**
     * Generates table name based on the namespace.
     *
     * @access protected
     *
     * @return string
     */
    protected function modConfigTableGetName(): string
    {
        $namespaceParts = explode("\\", __NAMESPACE__);

        foreach ($namespaceParts as $key => $part) {
            if ($part === "wsystems") {
                return "config_" . strtolower($namespaceParts[$key + 1]);
            }
        }

        return "";
    }

    /**
     * Checks if the config table already exists.
     *
     * @access protected
     *
     * @return bool
     */
    protected function modConfigTableExists(): bool
    {
        $db = DBManagerFactory::getInstance();

        return $db->tableExists($this->modConfigTableGetName()) === true;
    }
}
