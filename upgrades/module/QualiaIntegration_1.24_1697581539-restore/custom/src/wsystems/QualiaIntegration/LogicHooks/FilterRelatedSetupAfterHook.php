<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\QualiaIntegration\LogicHooks;

class FilterRelatedSetupAfterHook
{
    public function filterRelatedSetupAfter(string $event, array $options)
    {
        if (
            $event === "RelateApi_filterRelatedSetup_after"
            && $options["args"]["module"] === "Accounts"
            && $options["args"]["link_name"] === "order_rq_order_accounts"
        ) {
            $this->handleOrdersSubpanelFromAccounts($options);
        }
    }

    private function handleOrdersSubpanelFromAccounts($options)
    {
        $args   = $options["args"];
        $parent = $options["parent"];

        list($args, $query) = $parent;

        foreach ($query->join as $key => $join) {
            if ($key !== "sf_order_rq_order") {
                unset($query->join);
            }
        }

        $query->joinTable("party_rq_party_order_rq_order_c", array("alias" => "po"))->on()
              ->equalsField("order_rq_order.id", "po.party_rq_party_order_rq_orderorder_rq_order_idb")
              ->equals("po.deleted", "0");

        $query->joinTable("party_rq_party", array("alias" => "p"))->on()
              ->equalsField("po.party_rq_party_order_rq_orderparty_rq_party_ida", "p.id")
              ->equals("p.deleted", "0");

        $query->joinTable("accounts", array("alias" => "a"))->on()
              ->equalsField("p.parent_id", "a.id")
              ->equals("a.deleted", "0");

        $query->where()->equals("a.id", $args["record"]);
    }
}
