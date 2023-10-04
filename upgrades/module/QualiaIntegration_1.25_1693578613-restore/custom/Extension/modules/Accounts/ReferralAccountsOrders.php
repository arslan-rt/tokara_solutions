<?php
class ReferralAccountsOrders extends Link2
{/**
 * DB
 *
 * @var DBManager
 */
  protected $db;

  public function __construct($linkName, $bean, $linkDef = false)
  {
    $this->focus = $bean;
    $this->name  = $linkName;
    $this->db    = DBManagerFactory::getInstance();
    if (empty($linkDef)) {
      $this->def = $bean->field_defs[$linkName];
    } else {
      $this->def = $linkDef;
    }
  }

  /**
   * Returns false if no relationship was found for this link
   *
   * @return bool
   */
  public function loadedSuccesfully()
  {
    //if($this->focus->mph_type_c == "MO" || $this->focus->mph_type_c == "HO")
    return true;
    //else
    //   return false;

  }

  public function getRelatedModuleName()
  {
    // Be sure the plural form of the related module is returned here
    return 'Order_RQ_Order';
  }

  public function getRelatedModuleLinkName()
  {
    // this is one-side link, other side (Emails) won't have the link
    return false;
  }
  /**
   * @see Link2::getType()
   */
  public function getType()
  {
    return "many";
  }
  /**
   * @see Link2::getSide()
   */
  public function getSide()
  {
    return REL_LHS;
  }
  /**
   * @see Link2::is_self_relationship()
   */
  public function is_self_relationship()
  {
    return false;
  }
  /**
   * @see Link2::isParentRelationship()
   */
  public function isParentRelationship()
  {
    return false;
  }
  /**
   * If there are any relationship fields, we need to figure out the mapping
   * from the relationship fields to the
   * fields in the module vardefs
   */
  public function getRelationshipFieldMapping(SugarBean $seed = null)
  {
    return array();
  }
  /**
   * use this function to create link between 2 objects
   */
  public function add($rel_keys, $additional_values = array())
  {
    // cannot add to this relationship as it is implicit
    return false;
  }
  /**
   * Marks the relationship deleted for this given record pair.
   */
  public function delete($id, $related_id = '')
  {
    // cannot delete from this relationship as it is implicit
    return false;
  }

  /**
   *
   * @see Link2::buildJoinSugarQuery()
   */
  public function buildJoinSugarQuery($sugar_query, $options = array())
  {
    $jta = 'pop';
    if (!empty($options['joinTableAlias'])) {
      $jta = $options['joinTableAlias'];
    }

    $sugar_query->select()->fieldRaw("pp.party_type as role_type");
    $sugar_query->join("party_rq_party_order_rq_order", ["joinType" => "INNER", "alias" => "pp"]);
    $sugar_query->joinTable("accounts", ["joinType" => "INNER", "alias" => $jta])
                ->on()->equalsField("pp.parent_id", $jta . ".id");
    $query = $sugar_query->where()->queryAnd()->equals("pp.party_type", "Referral")->equals($jta . ".id", $this->focus->id);

    return $query;
  }
}
