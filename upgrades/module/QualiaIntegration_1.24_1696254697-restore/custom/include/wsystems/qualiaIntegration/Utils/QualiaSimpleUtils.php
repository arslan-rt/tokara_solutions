<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

class QualiaSimpleUtils
{
    public static function getCurrentUserId()
    {
        global $current_user;

        return $current_user->id;
    }

    /**
     * extractUpdateMeta function
     *
     * extract the child directly the entities that should be updated/deleted/created
     *
     * @param string $childName name of the child example: Properties
     * @param array $orderMeta
     * @return void
     */
    public static function extractUpdateMeta(string $childName, array $orderMeta)
    {
        $metaResp = [
            "ignore"  => false,
            "added"   => [],
            "removed" => [],
            "updated" => [],
        ];

        $hasUpdateFields = array_key_exists("_updatedFields", $orderMeta);

        if ($hasUpdateFields === false) {
            $metaResp["ignore"] = true;

            return $metaResp;
        }

        $isChildUpdated = $orderMeta["_updatedFields"][$childName]["updated"];

        if ($isChildUpdated === false) {
            $metaResp["ignore"] = true;

            return $metaResp;
        }

        $updatedMeta = $orderMeta["_updatedFields"][$childName];

        if ($childName === "contacts") {
            return self::handleContacts($updatedMeta);
        }

        $addedItems   = $updatedMeta["newAddedItems"];
        $removedItems = $updatedMeta["removedItems"];
        $updatedItems = $updatedMeta["onlyUpdates"];

        if (count($addedItems) > 0) {
            $metaResp["added"] = $addedItems;
        }

        if (count($removedItems) > 0) {
            $metaResp["removed"] = $removedItems;
        }

        if (count($updatedItems) > 0) {
            $metaResp["updated"] = $updatedItems;
        }

        return $metaResp;
    }

    public static function handleContacts($updatedMeta)
    {
        $metaResp = [
            "ignore"  => false,
            "added"   => [],
            "removed" => [],
            "updated" => [],
        ];

        foreach ($updatedMeta as $contactType => $contactChanges) {
            if ($contactType === "updated") {
                continue;
            }

            $addedItems   = $contactChanges["newAddedItems"];
            $removedItems = $contactChanges["removedItems"];
            $updatedItems = $contactChanges["onlyUpdates"];

            if (is_array($addedItems) && count($addedItems) > 0) {
                $metaResp["added"][$contactType] = $addedItems;
            }

            if (is_array($removedItems) && count($removedItems) > 0) {
                $metaResp["removed"][$contactType] = $removedItems;
            }

            if (is_array($updatedItems) && count($updatedItems) > 0) {
                $metaResp["updated"][$contactType] = $updatedItems;
            }

        }
        return $metaResp;
    }
}
