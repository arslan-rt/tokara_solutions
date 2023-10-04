<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

use BeanFactory;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class QualiaBeanUtils
{

    /**
     * createParty in sugar
     *
     * @param String $partyType
     * @param String $childModule
     * @param String $childId
     * @param Array  $partyIdMeta
     * @return String $id of the party
     */
    public static function createParty($partyType, $childModule, $childId, $name, $partyMeta = [])
    {
        $bean              = \BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME);
        $id                = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $bean->id          = $id;
        $bean->new_with_id = true;

        $bean->party_type  = $partyType;
        $bean->parent_type = $childModule;
        $bean->parent_id   = $childId;

        $bean->name             = $name;
        $bean->assigned_user_id = QualiaUtils\QualiaSimpleUtils::getCurrentUserId();

        foreach ($partyMeta as $fieldName => $fieldValue) {
            $bean->{$fieldName} = $fieldValue;
        }

        $bean->processed = null;

        $bean->save();

        return $id;
    }

    /**
     * Undocumented function
     *
     * @param String $idRecordFromWhereWillBeUnlink   id of the record where the party will be unlinkd
     * @param String $moduleFromWhereWillBeUnlink     module of the record where the party will be unlinkd
     * @param String $relationName                    name of the relationships between the modules
     * @param String $partyType                       party type that will be deleted
     * @param Array  $ignoreRecords                   an array with ids that will be ignored on unlink
     * @return void
     */
    public static function unlinkPartyXFromModuleY($idRecordFromWhereWillBeUnlink, $moduleFromWhereWillBeUnlink, $relationName, $partyType, $ignoreRecords = [])
    {
        $parentBean = \BeanFactory::retrieveBean($moduleFromWhereWillBeUnlink, $idRecordFromWhereWillBeUnlink, array('disable_row_level_security' => true));

        $parentBean->load_relationship($relationName);
        $parentPartyRels = $parentBean->{$relationName}->getBeans();

        if ($parentPartyRels && count($parentPartyRels) > 0) {
            foreach ($parentPartyRels as $key => $partyBean) {
                $parentPartyType = $partyBean->party_type;
                $parentId        = $partyBean->id;

                if ($parentPartyType === $partyType && (!in_array($parentId, $ignoreRecords))) {
                    $parentBean->{$relationName}->delete($parentBean->id, $partyBean->id);
                }
            }
        }
    }

    /**
     * linkModuleXtoModuleYManyToMany function
     *
     * A general function to link a record to another based on many-to-many relationship
     *
     * @param String $idRecordToLink          - id of the record that will be linked
     * @param String $idRecordWhereIsLinked   - id of the record where record will be linked
     * @param String $moduleWhereIsLinked     - module of the record where record will be linked
     * @param String $relationshipName        - name of the relationship
     * @return void
     */
    public static function linkModuleXtoModuleYManyToMany($idRecordToLink, $idRecordWhereIsLinked, $moduleWhereIsLinked, $relationshipName)
    {
        $beanWhereToLink = BeanFactory::retrieveBean($moduleWhereIsLinked, $idRecordWhereIsLinked, array('disable_row_level_security' => true));

        $beanWhereToLink->load_relationship($relationshipName);
        $beanWhereToLink->{$relationshipName}->add($idRecordToLink);

        $beanWhereToLink->processed = true;

        $beanWhereToLink->save();
    }

    /**
     * linkModuleXtoModuleY function
     *
     * A general function to check if two records are linked
     *
     * @param String $idRecordToLink          - id of the record that will be linked
     * @param String $idRecordWhereIsLinked   - id of the record where record will be linked
     * @param String $moduleWhereIsLinked     - module of the record where record will be linked
     * @param String $relationshipName        - name of the relationship
     * @return bool
     */
    public static function checkLinkModuleXtoModuleY($idRecordToLink, $idRecordWhereIsLinked, $moduleWhereIsLinked, $relationshipName)
    {
        $beanWhereToLink = BeanFactory::retrieveBean($moduleWhereIsLinked, $idRecordWhereIsLinked, array('disable_row_level_security' => true));

        $beanWhereToLink->load_relationship($relationshipName);
        $relatedIds = $beanWhereToLink->{$relationshipName}->get();

        if (in_array($idRecordToLink, $relatedIds) === true) {
            return true;
        }
        return false;
    }

    public static function unlinkPartyFromRecordId($partyId, $relationshipName, $idRecordToUnlink)
    {
        $partyBean = BeanFactory::retrieveBean(QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME, $partyId, array('disable_row_level_security' => true));
        $partyBean->load_relationship($relationshipName);
        $partyBean->{$relationshipName}->delete($partyId, $idRecordToUnlink);
    }

}
