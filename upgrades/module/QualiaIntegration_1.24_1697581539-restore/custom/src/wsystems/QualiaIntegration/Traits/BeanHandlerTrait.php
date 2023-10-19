<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\Traits;

use Link2;
use Exception;
use SugarBean;
use SugarQuery;
use BeanFactory;
use DynamicField;
use EmailAddress;
use LoggerManager;
use VardefManager;
use SugarException;
use SugarSystemInfo;
use DBManagerFactory;
use ReflectionException;
use SugarMath_Exception;
use SugarQueryException;
use SugarApiExceptionNotFound;
use Doctrine\DBAL\Query\QueryException;
use Sugarcrm\Sugarcrm\Audit\EventRepository;
use Sugarcrm\Sugarcrm\Audit\FieldChangeList;
use Sugarcrm\Sugarcrm\ProcessManager\Registry;
use Sugarcrm\Sugarcrm\DependencyInjection\Container;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use InvalidArgumentException as GlobalInvalidArgumentException;
use function explode;
use function is_bool;
use function in_array;
use function is_array;
use function is_string;
use function is_numeric;
use function class_exists;
use function array_key_exists;

/**
 * *** BeanHandlerTrait ***
 *
 * This trait provides additional features when working with Sugar beans,
 * features like retrieving records by criteria (custom fields, cache, database),
 * working with relationships (get/add/remove), working with fields (values, relationship fields).
 *
 * @version 1.1.4
 * @since SugarCRM 8.0
 * @since PHP 7.1
 */
trait BeanHandlerTrait
{
    /**
     * Saves a specific Sugar bean.
     *
     * The save action can be done either by performing hard-save, and choosing to trigger or not hooks/
     * workflows, or just update bean fields (this will be automatically done by Sugar via SQL).
     *
     * Very important though is that as long as the logic hooks are not triggered,
     * the Elasticsearch will not index the saved bean, as there is an built-in after_save hook,
     * that deals with bean indexing.
     *
     * <code>
     *
     * $this->beanSave($account, [
     *     "method"                 => "sugar",
     *     "triggerLogicHooks"      => false,
     *     "triggerLegacyWorkflows" => false,
     *     "updateModifiedFields"   => false
     *     "notifyUser"             => true
     * ]);
     *
     * --------------------
     *
     * $this->beanSave($contact, [
     *     "method"                 => "sql",
     *     "updateCalculatedFields" => true,
     *     "triggerAudit"           => true,
     * ]);
     *
     * --------------------
     *
     * $this->beanSave($lead);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param array $options
     *      @property string "method"                  `sugar` to perform hard-save / `sql` to only update bean fields
     *      @property boolean "triggerLogicHooks"      True to let logic hooks/BPM processes be triggered
     *      @property boolean "triggerLegacyWorkflows" True to let workflows be triggered
     *      @property boolean "triggerAudit"           True to populate audit table
     *      @property boolean "updateModifiedFields"   True to allow updating `date_modified` and `modified_by` fields
     *      @property boolean "updateCalculatedFields" True to update calculated fields based on their formulas
     *      @property boolean "notifyUser"             True to notify the record assignee via email
     *      @property boolean "clearFromCache"         True to clear bean from cache so the next fetch will be from db
     *      @property boolean "restoreDataChanges"     True to restore data changes to previous state if it isn't empty
     *
     * @return void
     *
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function beanSave(SugarBean &$bean, array $options = []): void
    {
        $method = $options["method"] ?? "sugar";
        $method = \strtolower($method);

        $triggerLogicHooks      = $options["triggerLogicHooks"] ?? true;
        $triggerLegacyWorkflows = $options["triggerLegacyWorkflows"] ?? true;
        $triggerAudit           = $options["triggerAudit"] ?? true;
        $updateModifiedFields   = $options["updateModifiedFields"] ?? true;
        $updateCalculatedFields = $options["updateCalculatedFields"] ?? true;
        $notifyUser             = $options["notifyUser"] ?? false;
        $clearFromCache         = $options["clearFromCache"] ?? false;
        $restoreDataChanges     = $options["restoreDataChanges"] ?? false;

        switch ($method) {
            case "sugar":
                // Fix trigger PMSE for each bean, when it is about a batch of beans.
                $this->beanFixPMSE();

                /**
                 * If the save is coming from a logic hook then dataChanges will be altered during save and
                 * the BPMs will not correctly detect the changes since it's logic is relayed on $dataChanges.
                 */
                if ($restoreDataChanges === true) {
                    $cachedFlags = $this->beanCacheAttrs(
                        $bean,
                        "processed",
                        "update_date_modified",
                        "update_modified_by",
                        "dataChanges"
                    );
                    //resetting dataChanges can be done always if it is set / not empty
                    if(empty($cachedFlags["dataChanges"])) {
                        unset($cachedFlags["dataChanges"]);
                    }
                } else {
                    // Cache bean attributes so to restore their state later
                    $cachedFlags = $this->beanCacheAttrs(
                        $bean,
                        "processed",
                        "update_date_modified",
                        "update_modified_by"
                    );
                }

                // Cache `disable_workflow` flag used to know if to trigger or not legacy workflows
                $disableWorkflow = $_SESSION["disable_workflow"];

                if ($triggerLogicHooks === true) {
                    $bean->processed = null;

                    // Legacy workflows will be triggered by default.
                    // If we want to cancel them, warn the user about it.
                    if ($triggerLegacyWorkflows === false) {
                        $_SESSION["disable_workflow"] = true;

                        LoggerManager::getLogger()->warn(
                            "Legacy workflows have been disabled for {$bean->module_dir} - {$bean->id} record."
                        );
                    }
                } else {
                    $bean->processed = true;
                }

                $bean->update_date_modified = $updateModifiedFields;
                $bean->update_modified_by   = $updateModifiedFields;

                $bean->save($notifyUser);

                // Restore bean attributes to their initial state
                $this->beanRestoreAttrs($bean, $cachedFlags);

                // Restore `disable_workflow` flag to its initial state
                if ($disableWorkflow !== $_SESSION["disable_workflow"]) {
                    $_SESSION["disable_workflow"] = $disableWorkflow;
                }

                break;

            case "sql":
                $isUpdate = $bean->isUpdate();

                $bean->update_date_modified = $updateModifiedFields;
                $bean->update_modified_by   = $updateModifiedFields;

                if ($triggerAudit === true) {
                    $this->beanAuditCommit($bean);
                }

                $bean->fixUpFormatting();
                $bean->setModifiedUser();
                $bean->setModifiedDate();

                if ($updateCalculatedFields === true) {
                    $bean->updateCalculatedFields();
                }

                if ($isUpdate === true) {
                    $bean->db->update($bean);
                } else {
                    $bean->setCreateData($isUpdate);
                    $bean->setDefaultTeam();
                    $bean->assigned_user_id = $bean->created_by;

                    $inserted = $bean->db->insert($bean);

                    if ($inserted === true) {
                        //Now that the record has been saved, we don't want to insert again on further saves
                        $bean->new_with_id = false;
                    }
                }

                /**
                 * Execute this logic after the bean has been created,
                 * because then calling `save` method for custom fields,
                 * Sugar is looking if the current bean has the id defined.
                 *
                 * The bean id is automatically generated within the `setCreateData` method if necessary.
                 */
                if ($bean->custom_fields instanceof DynamicField === true) {
                    $bean->custom_fields->bean = $bean;
                    $bean->custom_fields->save($isUpdate);
                }

                if ($bean->hasEmails() === true) {
                    $this->beanEmailAddressGetInstance($bean)->save($bean->id, $bean->module_dir);
                }

                break;
        }

        /**
         * Ensure the recently saved bean is cleared from cache.
         * The goal is to always use the updated version of the bean,
         * and removing it from cache will ensure the bean will be retrieved from db next time,
         * which means it will be up to date and it will have the proper values.
         */
        if ($clearFromCache === true) {
            $this->beanCacheRemove($bean->getModuleName(), $bean->id);
        }
    }

    /**
     * Checks if the bean has calculated fields defined.
     *
     * <code>
     *
     * $this->beanHasCalculatedFields($task);
     *
     * </code>
     *
     * @param SugarBean $bean
     *
     * @return bool
     */
    public function beanHasCalculatedFields(SugarBean $bean): bool
    {
        return empty($bean->getFieldDefinitions("calculated", [true, "true"])) === false;
    }

    /**
     * Checks if the bean has a specific custom field defined.
     *
     * <code>
     *
     * $this->beanIsCustomField($account, "contact_id_c");
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $fieldName
     *
     * @return bool
     */
    public function beanIsCustomField(SugarBean $bean, string $fieldName): bool
    {
        $fieldDef = $bean->getFieldDefinition($fieldName);

        return empty($fieldDef) === false && $fieldDef["source"] === "custom_fields";
    }

    /**
     * Checks if the module has custom fields defined.
     *
     * <code>
     *
     * $this->beanModuleHasCustomFields("Accounts");
     *
     * </code>
     *
     * @param string $module
     *
     * @return bool
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function beanModuleHasCustomFields(string $module): bool
    {
        global $dictionary;

        $bean   = $this->beanCreate($module);
        $object = $bean->getObjectName();

        VardefManager::loadVardef($module, $object, true);

        return boolval($dictionary[$object]["custom_fields"]) === true;
    }

    /**
     * Checks if the field is defined on the bean metadata.
     *
     * <code>
     *
     * $this->beanHasField($account, "sic_code");
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $fieldName
     *
     * @return bool
     */
    public function beanHasField(SugarBean $bean, string $fieldName): bool
    {
        $fieldDef = $bean->getFieldDefinition($fieldName);

        return is_array($fieldDef) === true && empty($fieldDef) === false;
    }

    /**
     * Checks if the bean field value is different than the database value.
     * This is mostly used within the after_save hooks to figure out if a field has been changed upon the save action.
     *
     * <code>
     *
     * $this->beanFieldChanged($contact, "first_name");
     *
     * --------------------
     *
     * $this->beanFieldChanged($lead, "first_name", [
     *     "stateChanges" => [
     *          "first_name" => [
     *             "before" => "John",
     *             "after" => "Johnny",
     *         ]
     *     ]
     * ]);
     *
     * --------------------
     *
     *  $this->beanFieldChanged($lead, "first_name", [
     *     "dataChanges" => [
     *          "first_name" => [
     *             "before" => "John",
     *             "after" => "Johnny",
     *         ]
     *     ]
     * ]);
     *
     * --------------------
     *
     * $this->beanFieldChanged($lead, "first_name", $arguments);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $field
     * @param array $hookArguments Array with after_save hook arguments
     *
     * @return bool
     */
    public function beanFieldChanged(SugarBean $bean, string $field, array $hookArguments = []): bool
    {
        $dataChanges = $this->beanGetChanges($bean, $hookArguments);

        if (empty($dataChanges) === true) {
            return false;
        }

        return array_key_exists($field, $dataChanges) === true;
    }

    /**
     * Retrieves the changed values from Bean.
     *
     * <code>
     *
     * $this->beanGetChanges($contact);
     *
     * --------------------
     *
     * $this->beanGetChanges($lead, [
     *     "stateChanges" => [
     *          "first_name" => [
     *             "before" => "John",
     *             "after" => "Johnny",
     *         ]
     *     ]
     * ]);
     *
     * --------------------
     *
     *  $this->beanGetChanges($lead, [
     *     "dataChanges" => [
     *          "first_name" => [
     *             "before" => "John",
     *             "after" => "Johnny",
     *         ]
     *     ]
     * ]);
     *
     * --------------------
     *
     * $this->beanGetChanges($lead, $arguments);
     * </code>
     *
     * @param SugarBean $bean
     * @param array     $hookArguments Array with after_save hook arguments
     *
     * @return mixed
     */
    public function beanGetChanges(SugarBean $bean, array $hookArguments = []):array {
        if (array_key_exists("stateChanges", $hookArguments)) {
            return $hookArguments["stateChanges"];
        } elseif (method_exists($bean, "getStateChanges")) {
            return $bean->stateChanges ?? $bean->getStateChanges();
        } elseif (array_key_exists("dataChanges", $hookArguments)) {
            return $hookArguments["dataChanges"];
        } else {
            return $bean->dataChanges ?? $bean->db->getDataChanges($bean);
        }
    }

    /**
     * Retrieves the field value before saving the bean.
     *
     * <code>
     *
     * $this->beanFieldBeforeChange($user, "first_name");
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $field
     * @param array $hookArguments Array with after_save hook arguments
     *
     * @return mixed
     */
    public function beanFieldBeforeChange(SugarBean $bean, string $field, array $hookArguments = [])
    {
        $dataChanges = $this->beanGetChanges($bean, $hookArguments);

        return array_key_exists($field, $dataChanges) ? $dataChanges[$field]["before"] : null;
    }

    /**
     * Retrieves the field value after saving the bean.
     *
     * <code>
     *
     * $this->beanFieldAfterChange($user, "first_name");
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $field
     * @param array $hookArguments Array with after_save hook arguments
     *
     * @return mixed
     */
    public function beanFieldAfterChange(SugarBean $bean, string $field, array $hookArguments = [])
    {
        $dataChanges = $this->beanGetChanges($bean, $hookArguments);

        return array_key_exists($field, $dataChanges) ? $dataChanges[$field]["after"] : null;
    }

    /**
     * Retrieves a relationship field value.
     *
     * <code>
     *
     * $this->beanRelFieldBeforeChange($contact, "contacts_users_role");
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $field
     *
     * @return null|mixed
     */
    public function beanRelFieldBeforeChange(SugarBean $bean, string $field)
    {
        if (empty($field) === true) {
            return null;
        }

        return $bean->rel_fields_before_value[$field];
    }

    /**
     * Copies fields and links from the source bean into the destination bean.
     *
     * <code>
     *
     * $this->beanCopy($contact, $account, [
     *      // Copy contact name and assigned user to account name and assigned user
     *     "name"             => "name",
     *     "assigned_user_id" => "assigned_user_id",
     * ], [
     *     "meetings", // Copy all contact's meetings to account
     * ]);
     *
     * --------------------
     *
     * $this->beanCopy($contact, $account, [
     *      // Copy contact title into account description
     *     "title" => "description",
     * ], [
     *     ["opportunities"], // Copy all contact's opportunities to account
     * ]);
     *
     * --------------------
     *
     * $this->beanCopy($contact, $account, [
     *      // Copy contact first name into account name
     *     "first_name" => "name",
     * ], [
     *     [
     *         "billing_quotes", "quotes_shipto", [
     *             "where"       => [
     *                 [
     *                     "id", "in", ["0a829f14-030c-11eb-86cd-08002709c5df"],
     *                 ],
     *             ],
     *             "limit"       => 40,
     *             "offset"      => 0,
     *             "orderby"     => "date_modified desc",
     *             "skipDeleted" => true,
     *         ],
     *     ], // Copy all contact's quotes with the given id to account
     *     [
     *         "billing_quotes", "quotes", [
     *             "where" => [
     *                 [
     *                     "name", "like", "%wsys2%",
     *                 ],
     *             ],
     *         ],
     *     ], // Copy all contact's quotes whose name contain `wsys2` to account
     * ]);
     *
     * </code>
     *
     * @param SugarBean $copyFrom
     * @param SugarBean $copyTo
     * @param string[] $fields Pairs of <from> => <to> fields
     * @param array $links Accepts four forms:
     *      @property string[] A list of mutual link names
     *      @property array[]string[] A list of tuples with one item that is the mutual link name
     *      @property array[]array[] A list of tuples with two items
     *          @property string First item is the link to be copied from the $copyFrom bean
     *          @property string Second item is the link to be copied over the $copyTo bean
     *      @property array[]array[] A list of tuples with three items
     *          @property string First item is the link to be copied from the $copyFrom bean
     *          @property string Second item is the link to be copied over the $copyTo bean
     *          @property array Third item is the criteria used to filter link items to be copied (@see beanRelGetIds)
     *              @property array "where"
     *              @property integer "limit"
     *              @property integer "offset"
     *              @property string "orderby"
     *              @property boolean "skipDeleted"
     *
     * @return SugarBean
     *
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function beanCopy(SugarBean $copyFrom, SugarBean $copyTo, array $fields, array $links = []): SugarBean
    {
        if (empty($fields) === false) {
            foreach ($fields as $from => $to) {
                $copyTo->{$to} = $copyFrom->{$from};
            }

            $this->beanSave($copyTo);
        }

        try {
            foreach ($links as $link) {
                if (is_array($link) === true) {
                    $countArgs = \count($link);

                    switch ($countArgs) {
                        case 0:
                            LoggerManager::getLogger()->fatal("Fail to copy bean. Invalid syntax for links.");

                            break;

                        case 1:
                            $linkFrom         = $link[0];
                            $linkTo           = $link[0];
                            $linkFromCriteria = [];

                            break;

                        case 2:
                            $linkFrom         = $link[0];
                            $linkTo           = $link[1];
                            $linkFromCriteria = [];

                            break;

                        case 3:
                            $linkFrom         = $link[0];
                            $linkTo           = $link[1];
                            $linkFromCriteria = $link[2];

                            break;
                    }

                    $this->beanRelAddRecords(
                        $copyTo, $linkTo, $this->beanRelGetIds($copyFrom, $linkFrom, $linkFromCriteria)
                    );
                } else {
                    $this->beanRelAddRecords($copyTo, $link, $this->beanRelGetIds($copyFrom, $link));
                }
            }
        } catch (\Exception $e) {
            LoggerManager::getLogger()->fatal($e->getMessage());
        }

        return $copyTo;
    }

    /**
     * Clones a Sugar bean.
     *
     * <code>
     *
     * $this->beanClone($lead);
     *
     * --------------------
     *
     * $this->beanClone($lead, ["first_name", "last_name"], ["contacts", "meetings"], [
     *     "first_name" => "Test",
     *     "last_name"  => "Wsys"
     * ]);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string[] $excludeFields
     * @param string[] $excludeLinks
     * @param array $prefill Pairs of $field => $value to populate cloned bean with
     *
     * @return SugarBean
     *
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function beanClone(
        SugarBean $bean,
        array $excludeFields = [],
        array $excludeLinks = [],
        array $prefill = []
    ): SugarBean {
        $clone = $bean->getCleanCopy();

        $fieldDefs    = $bean->getFieldDefinitions();
        $linkedFields = $bean->get_linked_fields();

        $excludeFields = \array_merge(["id", "date_entered", "date_modified"], $excludeFields);

        /**
         * Populate cloned bean db fields
         */
        foreach ($fieldDefs as $fieldName => $fieldMeta) {
            $source = $fieldMeta["source"];

            if (empty($fieldName) === true || $source === "non-db" || in_array($fieldName, $excludeFields) === true) {
                continue;
            }

            $clone->{$fieldName} = $bean->{$fieldName};
        }

        $this->beanPopulate($bean, $prefill);
        $this->beanSave($clone);

        /**
         * Establish cloned bean relationships
         */
        foreach ($linkedFields as $linkName => $linkMeta) {
            if (in_array($linkName, $excludeLinks) === true) {
                continue;
            }

            try {
                $this->beanRelAddRecords($clone, $linkName, $this->beanRelGetIds($bean, $linkName));
            } catch (\Exception $e) {
                LoggerManager::getLogger()->fatal($e->getMessage());
            }
        }

        return $clone;
    }

    /**
     * Loads relationship for a specific bean.
     *
     * <code>
     *
     * try {
     *     $this->beanRelationshipLoad($account, "contacts");
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $relationship
     *
     * @return bool True if relationship has been loaded; throw exception otherwise
     *
     * @throws SugarException
     */
    public function beanRelationshipLoad(SugarBean $bean, string $relationship): bool
    {
        $relLoaded = $bean->load_relationship($relationship);

        if ($relLoaded === true) {
            return true;
        }

        $e = new SugarException("Fail to load relationship.");

        $e->setExtraData("module", $bean->module_dir);
        $e->setExtraData("record", $bean->id);
        $e->setExtraData("relationship", $relationship);

        throw $e;
    }

    /**
     * Adds/updates relationship records.
     *
     * <code>
     *
     * try {
     *     $this->beanRelAddRecords(
     *         $contact,
     *         "meetings",
     *         [
     *             "f4463652-4540-11e7-9be5-0a88bd1c46b4",
     *             "f42444b6-4540-11e7-823c-0a88bd1c46b4"
     *         ],
     *         [
     *             "accept_status" => "accept"
     *         ]
     *     )
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $relationship
     * @param string|SugarBean|string[]|SugarBean[] $relKeys Id of record to be linked
     *                                                       SugarBean to be linked
     *                                                       Id list of records to be linked
     *                                                       SugarBean list to be linked
     * @param array $relFieldValues List of fields => values to be set for relationship fields
     *
     * @return bool|array True if all key have been added
     *                    Array with keys that have failed to be added
     *
     * @throws SugarException
     */
    public function beanRelAddRecords(SugarBean $bean, string $relationship, $relKeys, array $relFieldValues = [])
    {
        $this->beanRelationshipLoad($bean, $relationship);

        if (is_string($relKeys) === true || is_array($relKeys) === true || $relKeys instanceof SugarBean === true) {
            return $bean->{$relationship}->add($relKeys, $relFieldValues);
        }

        $e = new SugarException("Fail to add data to relationship. Invalid values.");

        $e->setExtraData("module", $bean->module_dir);
        $e->setExtraData("record", $bean->id);
        $e->setExtraData("relationship", $relationship);
        $e->setExtraData("relKeys", $relKeys);

        throw $e;
    }

    /**
     * Removes records from relationship.
     *
     * <code>
     *
     * try {
     *     $this->beanRelRemoveRecords($account, "contacts", [
     *         "f1eb329a-4540-11e7-8c27-0a88bd1c46b4",
     *     ]);
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $relationship
     * @param string|SugarBean|string[]|SugarBean[] $relKeys Null to unlink the entire relationship data
     *                                                       Id of record to be unlinked
     *                                                       SugarBean to be unlinked
     *                                                       Id list of records to be unlinked
     *                                                       SugarBean list to be unlinked
     *
     * @return bool
     *
     * @throws SugarException
     */
    public function beanRelRemoveRecords(SugarBean $bean, string $relationship, $relKeys): bool
    {
        $this->beanRelationshipLoad($bean, $relationship);

        // Remove all related records from relationship
        if (is_null($relKeys) === true) {
            $bean->{$relationship}->delete($bean->id);

            return true;
        }

        /**
         * `relKeys` is ID of a record to be removed from relationship
         */
        if (is_string($relKeys) === true && empty($relKeys) === false) {
            $bean->{$relationship}->delete($bean->id, $relKeys);

            return true;
        }

        /**
         * `relKeys` is Bean record to be removed from relationship
         */
        if ($relKeys instanceof SugarBean === true) {
            $bean->{$relationship}->delete($bean->id, $relKeys->id);

            return true;
        }

        /**
         * `relKeys` is an array of ids and/or beans to be removed from relationship
         */
        if (is_array($relKeys) === true && empty($relKeys) === false) {
            foreach ($relKeys as $relItem) {
                if (is_string($relItem) === true) {
                    $bean->{$relationship}->delete($bean->id, $relItem);

                    continue;
                }

                if ($relItem instanceof SugarBean === true) {
                    $bean->{$relationship}->delete($bean->id, $relItem->id);

                    continue;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Fetches related records ids.
     *
     * <code>
     *
     * try {
     *     $this->beanRelGetIds($account, "contacts", [
     *         "where"       => [
     *             [
     *                 "id", "in", ["f373ee72-4540-11e7-8f49-0a88bd1c46b4", "f1eb329a-4540-11e7-8c27-0a88bd1c46b4"]
     *             ],
     *             [
     *                 "first_name", "like", "brit%",
     *             ],
     *         ],
     *         "limit"       => 40,
     *         "offset"      => 10,
     *         "orderby"     => "date_modified desc",
     *         "skipDeleted" => true
     *     ]);
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * --------------------
     *
     * try {
     *     $this->beanRelGetIds($account, "contacts", [
     *         "where" => [
     *             "\$and" => [
     *                 [
     *                     "\$or" => [
     *                         ["field" => "first_name", "operator" => "like", "value" => "c%"],
     *                         ["field" => "last_name", "operator" => "like", "value" => "m%"],
     *                     ],
     *                 ],
     *                 [
     *                     "field" => "primary_address_city",
     *                     "operator" => "=",
     *                     "value" => "San Jose"
     *                 ],
     *              ],
     *         ],
     *         "limit"       => 40,
     *         "offset"      => 10,
     *         "orderby"     => "date_modified desc",
     *         "skipDeleted" => true
     *     ]);
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $relationship
     * @param array $criteria
     *      @property array "where" Filter returned records (Can be array-based criteria or operator-based criteria)
     *      @property integer "limit" No of rows to be returned
     *      @property integer "offset" Starting position to return rows from
     *      @property string "orderby" Field to sort by and sort ordering ("date_entered:desc")
     *      @property boolean "skipDeleted" True to only retrieve non-deleted relationships
     *
     * @return string[]
     *
     * @throws SugarException
     */
    public function beanRelGetIds(SugarBean $bean, string $relationship, array $criteria = []): array
    {
        $this->beanRelationshipLoad($bean, $relationship);

        $params = $this->beanRelParseParams($bean, $relationship, $criteria);

        $rows = $bean->{$relationship}->query($params)["rows"];

        return array_keys($rows);
    }

    /**
     * Counts relationship records.
     *
     * <code>
     *
     * try {
     *     $this->beanRelCount($account, "contacts", [
     *         "where"       => [
     *             [
     *                 "id", "in", ["f373ee72-4540-11e7-8f49-0a88bd1c46b4", "f1eb329a-4540-11e7-8c27-0a88bd1c46b4"]
     *             ],
     *             [
     *                 "first_name", "like", "brit%",
     *             ],
     *         ],
     *         "skipDeleted" => true
     *     ]);
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * --------------------
     *
     * try {
     *     $this->beanRelCount($account, "contacts", [
     *         "where" => [
     *             "\$and" => [
     *                 [
     *                     "\$or" => [
     *                         ["field" => "first_name", "operator" => "like", "value" => "c%"],
     *                         ["field" => "last_name", "operator" => "like", "value" => "m%"],
     *                     ],
     *                 ],
     *                 ["field" => "primary_address_city", "operator" => "=", "value" => "San Jose"],
     *             ],
     *         ],
     *     ]);
     * } catch (\Throwable $th) {
     *     $log->fatal($th->getMessage());
     * }
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $relationship
     * @param array $criteria
     *      @property array "where" Filter returned records (Can be array-based criteria or operator-based criteria)
     *      @property boolean "skipDeleted" True to only retrieve non-deleted relationships
     *
     * @return int
     *
     * @throws SugarException
     */
    public function beanRelCount(SugarBean $bean, string $relationship, array $criteria = []): int
    {
        $count  = 0;
        $offset = 0;
        $limit  = 10000;

        while (true) {
            $criteria["offset"] = $offset;
            $criteria["limit"]  = $limit;

            $rows = count($this->beanRelGetIds($bean, $relationship, $criteria));

            $count += $rows;

            if ($rows < $limit) {
                break;
            }

            $offset += $limit;
        }

        return $count;
    }

    /**
     * Fetches related beans.
     *
     * <code>
     *
     * $this->beanRelGetBeans($bean, "contacts",
     *     [
     *         "where"   => [
     *             [
     *                 "id", "in", ["f373ee72-4540-11e7-8f49-0a88bd1c46b4", "f1eb329a-4540-11e7-8c27-0a88bd1c46b4"]
     *             ],
     *             [
     *                 "first_name", "like", "brit%",
     *             ],
     *         ],
     *         "limit"       => 40,
     *         "offset"      => 10,
     *         "orderby"     => "date_modified desc",
     *         "skipDeleted" => true
     * );
     *
     * --------------------
     *
     * $this->beanRelGetBeans($bean, "contacts",
     *     [
     *         "where"   => [
     *             [
     *                 "first_name", "=", "waverly",
     *             ],
     *         ],
     *         "limit" => 3
     *     ]
     * );
     *
     * --------------------
     *
     * $this->beanRelGetBeans($account, "contacts", [
     *      "where" => [
     *          "\$and" => [
     *              [
     *                  "\$or" => [
     *                      ["field" => "first_name", "operator" => "like", "value" => "c%"],
     *                      ["field" => "last_name", "operator" => "like", "value" => "m%"],
     *                  ],
     *              ],
     *              ["field" => "primary_address_city", "operator" => "=", "value" => "San Jose"],
     *          ],
     *      ],
     *     "limit"       => 40,
     *     "offset"      => 10,
     *     "orderby"     => "date_modified desc",
     *     "skipDeleted" => true
     *  ]);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param string $relationship
     * @param array $criteria
     *      @property array "where" Filter returned records (Can be array-based criteria or operator-based criteria)
     *      @property integer "limit" No of rows to be returned
     *      @property integer "offset" Starting position to return rows from
     *      @property string "orderby" Field to sort by and sort ordering ("date_entered:desc")
     *      @property boolean "skipDeleted" True to only retrieve non-deleted relationships
     *
     * @param array $retrieve
     *      @property boolean "cache" True to retrieve records from cache
     *      @property boolean "disableRowLevelSecurity" True to fetch records regardless their visibility
     *      @property boolean "encode" True to HTML encode returned records
     *      @property boolean "skipDeleted" True to only retrieve non-deleted records
     * @param bool $forceLoad True to force load data from database. Applicable only if no criteria is passed in
     *
     * @return SugarBean[]
     *
     * @throws SugarException
     */
    public function beanRelGetBeans(
        SugarBean $bean,
        string $relationship,
        array $criteria = [],
        array $retrieve = [],
        bool $forceLoad = false
    ): array
    {
        $this->beanRelationshipLoad($bean, $relationship);

        /** @var Link2 $relationshipData */
        $relationshipData = $bean->{$relationship};

        /**
         * Load related data from database if:
         *
         * - no criteria is passed in and:
         *      - either force load is required
         *      - or data has not been loaded so far
         */
        if (empty($criteria) && ($forceLoad === true || $relationshipData->loaded !== true)) {
            $relationshipData->load();
        }

        if (empty($criteria) === false) {
            /**
             * Params used to filter returned records.
             * Applicable for SugarQuery.
             */
            $queryParams = $this->beanRelParseParams($bean, $relationship, $criteria);

            // Array of related records
            $relationshipData->load($queryParams);
        }

        $rows  = $relationshipData->rows;
        $beans = $relationshipData->beansAreLoaded() === true ? $relationshipData->beans : [];

        if (empty($beans)) {
            // Related records module
            $relatedModule = $relationshipData->getRelatedModuleName();

            // Related records bean
            $relatedBean = $this->beanCreate($relatedModule);

            $link2Instance = Link2Wrapper::getInstance($relationshipData->name, $bean);

            // Related bean relationship fields
            $relationshipFields = $link2Instance->getRelFields($relatedBean) ?? [];

            /**
             * Params used to be applied over the returned beans.
             * Same params as the ones used by the retrieveBean method from BeanFactory.
             *
             * @see BeanFactory::retrieveBean
             */
            $retrieveParams = [];

            $cachedBeans             = $retrieve["cache"] ?? false;
            $skipDeleted             = $retrieve["skipDeleted"] ?? true;
            $encodeBeans             = $retrieve["encode"] ?? false;
            $disableRowLevelSecurity = $retrieve["disableRowLevelSecurity"] ?? false;

            if (isset($cachedBeans) === true && is_bool($cachedBeans) === true) {
                $retrieveParams["use_cache"] = $cachedBeans;
            }

            if (isset($skipDeleted) === true && is_bool($skipDeleted) === true) {
                $retrieveParams["deleted"] = $skipDeleted === true ? false : true;
            }

            if (isset($encodeBeans) === true && is_bool($encodeBeans) === true) {
                $retrieveParams["encode"] = $encodeBeans;
            }

            if (isset($disableRowLevelSecurity) === true && is_bool($disableRowLevelSecurity) === true) {
                $retrieveParams["disable_row_level_security"] = $disableRowLevelSecurity;
            }

            // Prepare list of SugarBeans
            foreach ($rows as $id => $values) {
                $bean = $this->beanGet(
                    $relatedModule, $id, $retrieveParams["use_cache"], $retrieveParams["deleted"], $retrieveParams
                );

                if ($bean instanceof SugarBean === false) {
                    continue;
                }

                if (empty($relationshipFields) === false) {
                    $link2Instance->populateRelFields($relationshipFields, $values, $bean);
                }

                $beans[$id] = $bean;
            }

            $relationshipData->beans = $beans;
        }

        return $beans;
    }

    /**
     * Retrieves a bean based on the given id and module.
     *
     * According to the `use_cache` parameter, the bean can be retrieved either from the cached bean list,
     * or directly from database.
     *
     * This method allows retrieve both deleted and non-deleted records.
     * This is made based on the `skipDeleted` flag.
     * Having this flag set to true, it means the logic below will always be looking for non-deleted records.
     * Otherwise, it searches records with deleted = 1.
     *
     * <code>
     *
     * $this->beanGet("Accounts", "d9bdd218-4540-11e7-b0f6-0a88bd1c46b4");
     *
     * --------------------
     *
     * $this->beanGet("Accounts", "d9bdd218-4540-11e7-b0f6-0a88bd1c46b4", false, true);
     *
     * --------------------
     *
     * $this->beanGet("Accounts", "d9bdd218-4540-11e7-b0f6-0a88bd1c46b4", false, true, [
     *     "disable_row_level_security" => true
     * ]);
     *
     * </code>
     *
     * @param string $module
     * @param null|string $id
     * @param bool $cache True to retrieve bean from cache, false to retrieve bean from db.
     * @param bool $skipDeleted True to only retrieve non-deleted records
     * @param array $params
     *      @property boolean "strict_retrieve"
     *      @property boolean "disable_row_level_security"
     *      @property boolean "erased_fields"
     *      @property boolean "encode" True to HTML encode returned bean
     *      @property boolean "deleted"
     *
     * @return null|SugarBean
     *
     * @throws SugarApiExceptionNotFound
     * @throws SugarQueryException
     */
    public function beanGet(
        string $module,
        ?string $id = null,
        bool $cache = true,
        bool $skipDeleted = true,
        array $params = []
    ): ?SugarBean {

        if (empty($id) === true) {
            return null;
        }

        $params["use_cache"] = $cache;

        return BeanFactory::retrieveBean($module, $id, $params, $skipDeleted);
    }

    /**
     * Checks if bean exists.
     *
     * @param SugarBean $bean
     *
     * @return bool
     *
     * @throws SugarApiExceptionNotFound
     * @throws SugarQueryException
     */
    public function beanExists(SugarBean $bean): bool
    {
        return $this->beanExistsById($bean->module_name, $bean->id);
    }

    /**
     * Checks if bean exists by id.
     *
     * @param string $module
     * @param null|string $id
     *
     * @return bool
     *
     * @throws SugarApiExceptionNotFound
     * @throws SugarQueryException
     */
    public function beanExistsById(string $module, ?string $id = null): bool
    {
        if (empty($id) === true) {
            return false;
        }

        return $this->beanGet($module, $id, false) instanceof SugarBean;
    }

    /**
     * Retrieves bean by module and id, if exists, otherwise create a new bean.
     *
     * @param string $module
     * @param null|string $id
     *
     * @return SugarBean
     *
     * @throws SugarApiExceptionNotFound
     * @throws SugarQueryException
     */
    public function beanGetOrCreate(string $module, ?string $id = null): SugarBean
    {
        $bean = $this->beanGet($module, $id, false);

        if ($bean instanceof SugarBean === true) {
            return $bean;
        }

        return $this->beanCreate($module);
    }

    /**
     * Retrieves a bean based on the database fields.
     *
     * <code>
     *
     * $this->beanGetByFields("Accounts",
     *     [
     *         "name" => "W-Systems",
     *         "type" => "customer"
     *     ],
     *     [
     *         "skipDeleted"  => false,
     *         "teamSecurity" => false,
     *         "erasedFields" => false,
     *     ]
     * );
     *
     * </code>
     *
     * @param string $module
     * @param array $fieldList Pairs of field => value to build query where
     * @param array $options
     *      @property boolean "teamSecurity" True to filter records based on team visibility
     *      @property boolean "erasedFields" True to retrieve erased fields for returned records
     *      @property boolean "skipDeleted" True to only search non-deleted records
     *      @property integer "offset" Position to fetch bean from
     *      @property string "orderby" Field and order to sort results by; Eg: "date_modified desc"
     *      @property string "groupby" Field to group results by
     *
     * @return null|SugarBean
     *
     * @throws SugarQueryException
     */
    public function beanGetByFields(string $module, array $fieldList, array $options = []): ?SugarBean
    {
        $criteria = [
            "\$and" => [],
        ];

        foreach ($fieldList as $name => $value) {
            $criteria["\$and"][] = [
                "field"    => $name,
                "operator" => "=",
                "value"    => $value,
            ];
        }

        $options["limit"] = 1;

        $beans = $this->beanListGetByCriteria($module, $criteria, $options);

        if (is_array($beans) && empty($beans) === false) {
            return \reset($beans);
        }

        return null;
    }

    /**
     * Retrieves bean based on specific criteria.
     *
     * <code>
     *
     * $bean = $this->beanGetByCriteria("Contacts", "last_name like '%test%'", [
     *     "orderby" => "first_name asc, last_name",
     * ]);
     *
     * --------------------
     *
     * $data = [
     *     "\$and" => [
     *         [
     *            "\$or" => [
     *                ["field" => "deleted", "operator" => "=", "value" => "1"],
     *                ["field" => "created_by", "operator" => "=", "value" => "1"],
     *            ],
     *         ],
     *         ["field" => "name", "operator" => "like", "value" => "%te%"],
     *     ],
     * ];
     *
     * $bean = $this->beanGetByCriteria("Accounts", $data);
     *
     * </code>
     *
     * @param string $module
     * @param array|string $criteria Either raw where criteria or array-based criteria
     * @param array $options
     *      @property boolean "skipDeleted" True to only search non-deleted records
     *      @property boolean "teamSecurity" True to filter records based on team visibility
     *      @property boolean "erasedFields" True to retrieve erased fields for returned records
     *      @property integer "offset" Position to fetch beans from
     *      @property string "orderby" Field and order to sort results by; Eg: "date_modified desc"
     *      @property string "groupby" Field to group results by
     *
     * @return null|SugarBean
     *
     * @throws SugarQueryException
     * @throws QueryException
     */
    public function beanGetByCriteria(string $module, $criteria = null, array $options = []): ?SugarBean
    {
        $options["limit"] = 1;

        $beans = $this->beanListGetByCriteria($module, $criteria, $options);

        if (is_array($beans) && empty($beans) === false) {
            return \reset($beans);
        }

        return null;
    }

    /**
     * Retrieves a list of beans based on specific criteria.
     *
     * <code>
     *
     * $beans = $this->beanListGetByCriteria("Contacts", "last_name like '%test%'", [
     *     "orderby" => "first_name asc, last_name",
     * ]);
     *
     * --------------------
     *
     * $data = [
     *     "\$and" => [
     *         [
     *            "\$or" => [
     *                ["field" => "deleted", "operator" => "=", "value" => "1"],
     *                ["field" => "created_by", "operator" => "=", "value" => "1"],
     *            ],
     *         ],
     *         ["field" => "name", "operator" => "like", "value" => "%te%"],
     *     ],
     * ];
     *
     * $beans = $this->beanListGetByCriteria("Accounts", $data);
     *
     * </code>
     *
     * @param string       $module
     * @param array|string $criteria Either raw where criteria or array-based criteria
     * @param array        $options
     *      @property boolean "skipDeleted" True to only search non-deleted records
     *      @property boolean "teamSecurity" True to filter records based on team visibility
     *      @property boolean "erasedFields" True to retrieve erased fields for returned records
     *      @property integer "limit" Number of beans to be returned
     *      @property integer "offset" Position to fetch beans from
     *      @property string "orderby" Field and order to sort results by; Eg: "date_modified desc"
     *      @property string "groupby" Field to group results by

     *
     * @return SugarBean[]|null
     *
     * @throws SugarQueryException
     * @throws QueryException
     */
    public function beanListGetByCriteria(string $module, $criteria = null, array $options = []): ?array
    {
        $bean = $this->beanCreate($module);

        $sq = new SugarQuery();
        $sq->select("*");
        $sq->from($bean, [
            /**
             * Let SugarQuery know if it should return deleted records or not.
             *
             * add_deleted = true => "WHERE deleted = 0"
             * add_deleted = false => "WHERE deleted = 1"
             */
            "add_deleted" => $options["skipDeleted"] ?? true,

            /**
             * Make SugarQuery not return records that are not visible.
             * Visibility filtering is managed by the BeanVisibility class.
             *
             * team_security = true => apply visibility filtering
             * team_security = false => does not apply visibility filtering
             *
             * @see BeanVisibility
             */
            "team_security" => $options["teamSecurity"] ?? false,

            /**
             * Let SugarQuery know if it should retrieve information from `erased_fields` table,
             * for returned records.
             *
             * erased_fields = true => fetch erased fields for selected records
             * erased_fields = false => does not fetch erased fields for selected records
             */
            "erased_fields" => $options["erasedFields"] ?? false,
        ]);

        if (is_numeric($options["offset"]) && $options["offset"] > 0) {
            $sq->offset($options["offset"]);
        }

        if (is_numeric($options["limit"]) && $options["limit"] > 0) {
            $sq->limit($options["limit"]);
        }

        if (is_array($criteria) && empty($criteria) === false) {
            $criteria = $this->beanWhereCriteriaParse($bean, $criteria);
        }

        if (is_string($criteria) && empty(\trim($criteria)) === false) {
            $sq->whereRaw($criteria);
        }

        if (is_string($options["orderby"]) && empty(\trim($options["orderby"])) === false) {
            $orderbyList = explode(",", $options["orderby"]);

            foreach ($orderbyList as $orderby) {
                $fieldAndOrder = explode(" ", \trim($orderby));

                $sq->orderByRaw($fieldAndOrder[0], $fieldAndOrder[1] ?? "DESC");
            }
        }

        if (is_string($options["groupby"]) && empty(\trim($options["groupby"])) === false) {
            $sq->groupByRaw($options["groupby"]);
        }

        $result = $sq->execute();

        if (is_array($result) === true && count($result) > 0) {
            $beans = [];

            foreach ($result as $row) {
                $bean = $this->beanCreate($module);

                $bean->duplicates_found = true;

                $row = $bean->convertRow($row);

                $bean->fetched_row = $row;
                $bean->populateFetchedEmail();
                $bean->fromArray($row);
                $bean->fill_in_additional_detail_fields();

                $beans[] = $bean;
            }

            return $beans;
        }

        return null;
    }

    /**
     * Creates a new bean.
     *
     * <code>
     *
     * $this->beanCreate("Accounts", [
     *     "type" => "customer",
     *     "name" => "Test",
     * ]);
     *
     * </code>
     *
     * @param string $module
     * @param array  $defaults Pairs of $field => $value to populate bean with
     * @param bool   $registerBean
     *
     * @return SugarBean
     */
    public function beanCreate(string $module, array $defaults = [], bool $registerBean = true): SugarBean
    {
        $bean = BeanFactory::newBean($module);

        if (count($defaults) > 0) {
            $bean = $this->beanPopulate($bean, $defaults);
        }

        if ($registerBean === true) {
            BeanFactory::registerBean($bean);
        }

        return $bean;
    }

    /**
     * Fills-in bean attributes.
     *
     * <code>
     *
     * $this->beanPopulate($account, [
     *     "type" => "customer",
     *     "name" => "Test",
     * ]);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param array $data Pairs of $field => $value to populate the cloned bean with
     *
     * @return SugarBean
     */
    public function beanPopulate(SugarBean $bean, array $data): SugarBean
    {
        foreach ($data as $field => $value) {
            $bean->{$field} = $value;

            if ($field === "id" && isset($value) === true) {
                $bean->new_with_id = true;
                $bean->in_save     = true;
            }
        }

        return $bean;
    }

    /**
     * Adds email addresses to a specific bean.
     *
     * <code>
     *
     * $this->beanEmailsAdd($contact, [
     *     [
     *         "address" => "test@test.com",
     *         "primary" => true,
     *     ],
     *     [
     *         "address" => "tests@wsys.com",
     *     ],
     * ]);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param array $emails
     *
     * @return array
     *
     * @throws Exception
     * @throws UnsatisfiedDependencyException
     * @throws GlobalInvalidArgumentException
     */
    public function beanEmailsAdd(SugarBean $bean, array $emails): array
    {
        $emailAddress = $this->beanEmailAddressGetInstance($bean);

        foreach ($emails as $email) {
            $address  = $email["address"];
            $primary  = $email["primary"] ?? false;
            $replyTo  = $email["replyTo"] ?? false;
            $invalid  = $email["invalid"] ?? false;
            $optOut   = $email["optOut"] ?? false;
            $emailId  = $email["emailId"];
            $validate = $email["validate"] ?? true;

            $added = $emailAddress->addAddress($address, $primary, $replyTo, $invalid, $optOut, $emailId, $validate);

            if ($added === false) {
                LoggerManager::getLogger()->fatal(
                    "Fail to add email address for {$bean->module_dir} {$bean->id}. Email data: {$email}"
                );
            }
        }

        $bean->email = $emailAddress->addresses;

        return $bean->email;
    }

    /**
     * Removes email addresses from a specific bean.
     *
     * <code>
     *
     * $this->beanEmailsRemove($contact, [
     *     "test@test.com", "test@wsys.com"
     * ]);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param array $emailAddresses
     *
     * @return array
     */
    public function beanEmailsRemove(SugarBean $bean, array $emailAddresses): array
    {
        $emailAddress = $this->beanEmailAddressGetInstance($bean);

        foreach ($emailAddresses as $address) {
            $removed = $emailAddress->removeAddress($address);

            if ($removed === false) {
                LoggerManager::getLogger()->fatal(
                    "Fail to remove email address {$address} from {$bean->module_dir} {$bean->id}."
                );
            }
        }

        $bean->email = $emailAddress->addresses;

        return $bean->email;
    }

    /**
     * Retrieves a collection of email addresses for a specific bean.
     *
     * @param SugarBean $bean
     *
     * @return array
     *
     * @throws Exception
     */
    public function beanEmailsGet(SugarBean $bean): array
    {
        $ea = $this->beanEmailAddressGetInstance($bean);

        if ($bean->isUpdate() === true) {
            return $ea->getAddressesForBean($bean, true);
        }

        return $ea->addresses;
    }

    /**
     * Replaces the email addresses for a specific bean.
     *
     * <code>
     *
     * $this->beanEmailsReplace($contact, [
     *     [
     *         "address" => "test@test.com",
     *         "primary" => true,
     *     ],
     *     [
     *         "address" => "tests@wsys.com",
     *     ],
     * ]);
     *
     * </code>
     *
     * @param SugarBean $bean
     * @param array $emailAddresses
     *
     * @return array
     *
     * @throws Exception
     * @throws UnsatisfiedDependencyException
     * @throws GlobalInvalidArgumentException
     */
    public function beanEmailsReplace(SugarBean $bean, array $emailAddresses): array
    {
        $addrs = [];

        foreach ($this->beanEmailsGet($bean) as $email) {
            $addrs[] = $email["email_address"];
        }

        $this->beanEmailsRemove($bean, $addrs);
        $this->beanEmailsAdd($bean, $emailAddresses);

        return $bean->email;
    }

    /**
     * Retrieves the primary email address for a specific bean.
     *
     * @param SugarBean $bean
     *
     * @return string
     *
     * @throws Exception
     */
    public function beanPrimaryEmailGet(SugarBean $bean): string
    {
        return $this->beanEmailAddressGetInstance($bean)->getPrimaryAddress($bean);
    }

    /**
     * Checks if an email address is valid.
     *
     * @param SugarBean $bean
     * @param string $emailAddress
     *
     * @return bool
     */
    public function beanEmailIsValid(SugarBean $bean, string $emailAddress): bool
    {
        return $this->beanEmailAddressGetInstance($bean)->isValidEmail($emailAddress);
    }

    /**
     * Retrieves a collection of beans matching the email address.
     *
     * @param string $emailAddress
     *
     * @return SugarBean[]
     */
    public function beanEmailAddressBeansGet(string $emailAddress): array
    {
        return $this->beanEmailAddressGetInstance()->getBeansByEmailAddress($emailAddress);
    }

    /**
     * Deletes a bean and plucks it from the cached bean list.
     *
     * @param string $module
     * @param string $id
     *
     * @return null|SugarBean Null if there is no bean for the given module; otherwise return the deleted bean
     *
     * @throws SugarQueryException
     */
    public function beanDelete(string $module, string $id): ?SugarBean
    {
        return BeanFactory::deleteBean($module, $id);
    }

    /**
     * Adds a bean to the cached bean list.
     *
     * <code>
     *
     * $this->beanCacheAdd($account);
     *
     * --------------------
     *
     * $this->beanCacheAdd(null, "Accounts", "d9bdd218-4540-11e7-b0f6-0a88bd1c46b4");
     *
     * </code>
     *
     * @param null|SugarBean $bean
     * @param null|string    $module
     * @param null|string    $id
     *
     * @return bool
     *
     * @throws \SugarApiExceptionNotFound
     * @throws \SugarQueryException
     */
    public function beanCacheAdd(?SugarBean $bean, ?string $module = null, ?string $id = null): bool
    {
        if ($bean instanceof SugarBean === false) {
            $bean = $this->beanGet($module, $id);
        }

        return BeanFactory::registerBean($bean);
    }

    /**
     * Removes the bean from the cached bean list so to force the next bean retrieval to be from the db.
     *
     * @param string $module
     * @param null|string $id
     *
     * @return bool
     */
    public function beanCacheRemove(string $module, ?string $id = null): bool
    {
        return BeanFactory::unregisterBean($module, $id);
    }

    /**
     * Removes all cached beans.
     *
     * @return void
     */
    public function beanCacheClear(): void
    {
        BeanFactory::clearCache();
    }

    /**
     * Retrieves the base table for a specific module.
     *
     * @param string $module
     *
     * @return string
     */
    public function beanBaseTableGet(string $module): string
    {
        return $this->beanCreate($module)->getTableName();
    }

    /**
     * Retrieves the custom table for a specific module.
     *
     * @param string $module
     *
     * @return string
     */
    public function beanCustomTableGet(string $module): string
    {
        if ($this->beanModuleHasCustomFields($module) === true) {
            return $this->beanCreate($module)->get_custom_table_name();
        }

        return "";
    }

    /**
     * Retrieves bean class name based on the module name.
     *
     * @param string $module
     *
     * @return null|string
     */
    public function beanClassNameGet(string $module): ?string
    {
        $className = BeanFactory::getBeanClass($module);

        return is_string($className) === true ? $className : null;
    }

    /**
     * Retrieves bean object name based on the module name.
     *
     * @param string $module
     *
     * @return string
     */
    public function beanObjectNameGet(string $module): string
    {
        return BeanFactory::getObjectName($module);
    }

    /**
     * Retrieves bean module name based on the object name or bean itself.
     *
     * @param SugarBean|string $beanOrObjectName SugarBean or bean object name
     *
     * @return null|string
     */
    public function beanModuleNameGet($beanOrObjectName): ?string
    {
        if ($beanOrObjectName instanceof SugarBean
            || (is_string($beanOrObjectName) && empty(\trim($beanOrObjectName)) === false)
        ) {
            return BeanFactory::getModuleName($beanOrObjectName);
        }

        return null;
    }

    /**
     * Retrieves the audit table name related to a specific bean.
     *
     * @param string $module
     *
     * @return string
     *
     * @throws UnsatisfiedDependencyException
     * @throws GlobalInvalidArgumentException
     * @throws Exception
     */
    public function beanAuditTableGet(string $module): string
    {
        return $this->beanCreate($module)->get_audit_table_name();
    }

    /**
     * Checks if audit is enabled for a specific module.
     *
     * @param string $module
     *
     * @return bool
     *
     * @throws UnsatisfiedDependencyException
     * @throws GlobalInvalidArgumentException
     * @throws Exception
     */
    public function beanIsAuditEnabled(string $module): bool
    {
        return $this->beanCreate($module)->is_AuditEnabled();
    }

    /**
     * Checks if favorites is enabled for a specific module.
     *
     * @param string $module
     *
     * @return bool
     *
     * @throws UnsatisfiedDependencyException
     * @throws GlobalInvalidArgumentException
     * @throws Exception
     */
    public function beanIsFavoritesEnabled(string $module): bool
    {
        return $this->beanCreate($module)->isFavoritesEnabled($module);
    }

    /**
     * Retrieves all fields of type link for a specific bean.
     *
     * @param SugarBean $bean
     *
     * @return array
     */
    public function beanLinkedFieldsGet(SugarBean $bean): array
    {
        return $bean->get_linked_fields();
    }

    /**
     * Deletes all records for each relationship for a specific bean.
     *
     * @param SugarBean $bean
     *
     * @return void
     */
    public function beanRelationshipsDelete(SugarBean $bean): void
    {
        $bean->delete_linked($bean->id);
    }

    /**
     * Updates calculated fields of related link records.
     * If no link is passed in, it will update calculated fields fro all related link records.
     *
     * @param SugarBean $bean
     * @param string|null $link
     *
     * @return void
     *
     * @throws SugarApiExceptionNotFound
     * @throws Exception
     */
    public function beanRelCalculatedFieldsUpdate(SugarBean $bean, string $link = null): void
    {
        $bean->updateRelatedCalcFields($link);
    }

    /**
     * @param SugarBean $bean
     *
     * @return void
     *
     * @throws Exception
     */
    public function beanUndelete(SugarBean $bean): void
    {
        $bean->mark_undeleted($bean->id);
    }

    /**
     * Finds duplicates.
     *
     * @param SugarBean $bean
     *
     * @return null|array
     */
    public function beanDuplicatesFind(SugarBean $bean): ?array
    {
        return $bean->findDuplicates();
    }

    /**
     * Checks if a bean has email defs.
     *
     * @param SugarBean $bean
     *
     * @return bool
     */
    public function beanHasEmails(SugarBean $bean): bool
    {
        return $bean->hasEmails();
    }

    /**
     * Retrieves the list of tags associated to a specific bean.
     *
     * @param SugarBean $bean
     *
     * @return SugarBean[]
     */
    public function beanTagsGet(SugarBean $bean): array
    {
        return $bean->getTags();
    }

    /**
     * Retrieves the name of a specific bean.
     * This is useful for person type beans.
     *
     * @param SugarBean $bean
     *
     * @return null|string
     */
    public function beanRecordNameGet(SugarBean $bean): ?string
    {
        return $bean->getRecordName();
    }

    /**
     * Checks if a bean can be accessed by the current user based on the team security.
     *
     * @param string $module
     * @param string $id
     *
     * @return bool
     *
     * @throws SugarApiExceptionNotFound
     * @throws SugarQueryException
     */
    public function beanIsAccessible(string $module, string $id): bool
    {
        $bean = $this->beanGet($module, $id, false, true, [
            "disable_row_level_security" => false,
        ]);

        return $bean instanceof SugarBean;
    }

    /**
     * In Sugar 7.8, the Process Manager library brought Registry Object
     * to maintain the state of SugarBPM processes during a PHP Process.
     *
     * This change introduced a limitation in SugarBPM that prevents the same process definition
     * from running on multiple records inside the same PHP process.
     *
     * @link https://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_9.1/Architecture/SugarBPM/index.html
     *
     * @access protected
     *
     * @return void
     */
    protected function beanFixPMSE(): void
    {
        $systemInfo   = SugarSystemInfo::getInstance()->getAppInfo();
        $systemFlavor = $systemInfo["sugar_flavor"] ?? $GLOBALS["sugar_flavor"];

        // SugarBPM is exclusive to Enterprise and Ultimate editions of Sugar 7.6.x and later.
        if (in_array(strtoupper($systemFlavor), ["ULT", "ENT"]) === false) {
            return;
        }

        // Check if the Factory class specific to the ProcessManager exists,
        // in order not to call the below logic if it does not apply for the current system.
        // EG: Sugar PRO does not implement Process Management.
        if (class_exists("Sugarcrm\Sugarcrm\ProcessManager\Registry\Registry") === true) {
            Registry\Registry::getInstance()->drop("triggered_starts");
        }
    }

    /**
     * Caches bean properties temporarily.
     * They are going to be restored to their initial state.
     *
     * @see beanSave
     * @see beanRestoreAttrs
     *
     * @access protected
     *
     * @param SugarBean $bean
     * @param string[] $flags
     *
     * @return array
     */
    protected function beanCacheAttrs(SugarBean $bean, string...$flags): array
    {
        $cache = [];

        foreach ($flags as $flag) {
            $cache[$flag] = $bean->{$flag};
        }

        return $cache;
    }

    /**
     * Restores bean properties to their initial state.
     *
     * @access protected
     *
     * @param SugarBean $bean
     * @param string[] $cachedFlags
     *
     * @return void
     */
    protected function beanRestoreAttrs(SugarBean $bean, array $cachedFlags): void
    {
        foreach ($cachedFlags as $name => $value) {
            if ($bean->{$name} === $value) {
                continue;
            }

            $bean->{$name} = $value;
        }
    }

    /**
     * Parses criteria options as to be able to use them to filter returned relationship records.
     *
     * @access protected
     *
     * @param SugarBean $bean
     * @param string    $relationship
     * @param array     $criteria "where" Filter returned records
     *                            "limit" How many records to return
     *                            "offset" From which position to return records
     *                            "orderby" OrderBy and SortOrder
     *                            "skipDeleted" True to only retrieve non-deleted relationships
     *
     * @return array
     * @throws \SugarException
     */
    protected function beanRelParseParams(SugarBean $bean, string $relationship, array $criteria = []): array
    {
        if (empty($criteria) === true) {
            return [];
        }

        $params = [];

        $where       = $criteria["where"];
        $limit       = $criteria["limit"];
        $offset      = $criteria["offset"] ?? 0;
        $orderby     = $criteria["orderby"] ?? "date_modified desc";
        $skipDeleted = $criteria["skipDeleted"] ?? true;

        if (empty($where) === false) {
            if (is_string($where) === true) {
                $params["where"] = $where;
            }

            if (is_array($where) === true) {
                $relModule = $bean->{$relationship}->getRelatedModuleName();
                $relFields = $bean->{$relationship}->relationship->getFields();
                $relTable  = $bean->{$relationship}->relationship->getRelationshipTable();

                $relBean = $this->beanCreate($relModule);

                if (array_key_exists("\$and", $where) || array_key_exists("\$or", $where)) {
                    $params["where"] = $this->beanWhereCriteriaParse($relBean, $where);
                } else {
                    foreach ($where as &$item) {
                        $field    = $item[0];
                        $operator = $item[1];
                        $value    = $item[2];

                        if (in_array(strtolower($operator), ["in", "not in"]) === true && is_array($value) === true) {
                            $value = "('" . \implode("','", $value) . "')";
                        } else {
                            $value = "'{$value}'";
                        }

                        // First check if the field is found within the related bean
                        if ($this->beanHasField($relBean, $field) === true) {
                            if ($this->beanIsCustomField($relBean, $field) === true) {
                                $relatedTable = $this->beanCustomTableGet($relModule);
                            } else {
                                $relatedTable = $this->beanBaseTableGet($relModule);
                            }
                        } else {
                            // If not, search it within the relationship meta fields
                            if (array_key_exists($field, $relFields) === true) {
                                $relatedTable = $relTable;
                            }
                        }

                        $whereParts[] = "{$relatedTable}.{$field} {$operator} {$value}";
                    }

                    $params["where"] = \implode(" AND ", $whereParts);
                }
            }
        }

        if (isset($limit) === true && is_numeric($limit) === true) {
            $params["limit"] = $limit;
        }

        if (isset($offset) === true && is_numeric($offset) === true) {
            $params["offset"] = $offset;
        }

        if (isset($orderby) === true && is_string($orderby) === true) {
            $args = explode(" ", $orderby);

            if (count($args) === 2) {
                $params["orderby"] = $orderby;
            }
        }

        if (isset($skipDeleted) === true && is_bool($skipDeleted) === true) {
            /**
             * If `skipDeleted` is true, it means we only want to retrieve non-deleted relationships.
             * Thus, `deleted` parameter should be 0, as the background SugarQuery will use it to filte returned data.
             *
             * <code>
             *
             * WHERE deleted = 0 when `skipDeleted` = true
             * WHERE deleted = 1 when `skipDeleted` = false
             *
             * </code>
             */
            $params["deleted"] = $skipDeleted === true ? 0 : 1;
        }

        return $params;
    }

    /**
     * @access protected
     *
     * @param SugarBean|null $bean
     *
     * @return EmailAddress
     */
    protected function beanEmailAddressGetInstance(SugarBean $bean = null): EmailAddress
    {
        if ($bean instanceof SugarBean === false) {
            return $this->beanCreate("EmailAddress");
        }

        if ($bean->emailAddress instanceof EmailAddress === false) {
            $bean->emailAddress = new EmailAddress();
        }

        return $bean->emailAddress;
    }

    /**
     * Enables populating the audit table for the given bean.
     * This method is especially used when calling beanSave with method => sql.
     *
     * @access protected
     *
     * @param SugarBean $bean
     *
     * @return void
     *
     * @throws SugarMath_Exception
     * @throws UnsatisfiedDependencyException
     * @throws GlobalInvalidArgumentException
     * @throws Exception
     */
    protected function beanAuditCommit(SugarBean $bean): void
    {
        if ($bean->is_AuditEnabled() === false) {
            return;
        }

        if (is_array($bean->fetched_row) === true) {
            $lastAuditedState = array_merge($bean->fetched_row, $bean->fetched_rel_row);
        } else {
            $lastAuditedState = [];
        }

        $changes = $bean->db->getStateChanges($bean, $lastAuditedState, [
            "for" => "audit",
        ]);

        if (count($changes) < 1) {
            return;
        }

        $eventRepository = Container::getInstance()->get(EventRepository::class);

        $auditEventId = $eventRepository->registerUpdate($bean);

        $changeList = FieldChangeList::fromChanges($changes);

        foreach ($changeList->getChangesList() as $change) {
            $bean->saveAuditRecords($bean, $change, $auditEventId);
        }
    }

    /**
     * Parses array-based where criteria and converts it into SQL syntax.
     *
     * @access protected
     *
     * @param SugarBean $bean
     * @param array $where
     * @param string $output
     * @param string $operator
     *
     * @return string
     *
     * @throws SugarException
     */
    protected function beanWhereCriteriaParse(
        SugarBean $bean,
        array $where,
        string $output = "",
        string $operator = ""
    ): string {

        $defaultOperators = [
            "\$or"  => "OR",
            "\$and" => "AND",
        ];

        foreach ($where as $op => $value) {
            if (in_array($op, array_keys($defaultOperators), true)) {
                $output .= $this->beanWhereCriteriaParse($bean, $value, $output, $op);
            } else {
                if (empty(\array_intersect_key($value, $defaultOperators))) {
                    $mysqlOp = $defaultOperators[$operator];

                    if ($value !== \reset($where)) {
                        $output .= " {$mysqlOp} ";
                    }

                    $output .= $this->beanWhereTranslateToSQL($bean, $value);
                } else {
                    foreach ($value as $key => $items) {
                        $output .= $this->beanWhereCriteriaParse($bean, $items, $output, $key);
                    }
                }
            }
        }

        return "({$output})";
    }

    /**
     * Coverts array-based where into valid SQL syntax.
     *
     * @access protected
     *
     * @param SugarBean $bean
     * @param array     $where
     *
     * @return string
     * @throws \SugarException
     */
    protected function beanWhereTranslateToSQL(SugarBean $bean, array $where): string
    {
        $field    = $where["field"];
        $operator = $where["operator"];
        $value    = $where["value"] ?? "";

        if ($this->beanIsCustomField($bean, $field) === true) {
            $table = $bean->get_custom_table_name();
        } else {
            $table = $bean->getTableName();
        }

        if (in_array(\strtoupper($operator), ["IN", "NOT IN"])) {
            if (is_array($value) && empty($value) === false) {
                $value = "('" . \implode("','", $value) . "')";
            } else {
                $e = new SugarException("Fail to parse where criteria. Invalid value format for {$operator} operator.");

                $e->setExtraData("field", $field);
                $e->setExtraData("operator", $operator);
                $e->setExtraData("valid", $value);

                throw $e;
            }
        } else {
            if (empty($value) === false) {
                $value = DBManagerFactory::getInstance()->quoted($value);
            }
        }

        return trim("({$table}.{$field} {$operator} {$value})");
    }
}

class Link2Wrapper extends Link2
{
    protected static $instance = null;

    /**
     * @inheritdoc
     */
    public function __construct(string $linkName, SugarBean $bean)
    {
        parent::__construct($linkName, $bean, true);
    }

    /**
     * @inheritdoc
     */
    public function getRelFields(SugarBean $relBean)
    {
        return parent::getRelationshipFields($relBean);
    }

    /**
     * @inheritdoc
     */
    public function populateRelFields(array $relFields, array $relData, SugarBean $relBean)
    {
        return parent::populateRelationshipOnlyFields($relFields, $relData, $relBean);
    }

    /**
     * @param string $linkName
     * @param SugarBean $bean
     *
     * @return Link2Wrapper
     */
    public static function getInstance(string $linkName, SugarBean $bean): Link2Wrapper
    {
        if (self::$instance instanceof Link2Wrapper === false) {
            self::$instance = new self($linkName, $bean);
        }

        return self::$instance;
    }
}
