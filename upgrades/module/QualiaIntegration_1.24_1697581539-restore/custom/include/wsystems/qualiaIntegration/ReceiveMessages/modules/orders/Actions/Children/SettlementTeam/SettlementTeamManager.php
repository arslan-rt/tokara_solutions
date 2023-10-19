<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\SettlementTeam;

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class SettlementTeamManager
{
    public function create(string $orderId, array $orderMeta)
    {
        $hasSettlementTeam = array_key_exists("settlementTeam", $orderMeta);

        if ($hasSettlementTeam === false) {
            return false;
        }

        $settlementTeamMeta = $orderMeta["settlementTeam"];

        $newOrder = true;
        $settlementTeamProcessor = new SettlementTeam($settlementTeamMeta);
        $settlementTeamProcessor->create($orderId, $newOrder);
    }

    public function update(string $orderId, array $orderMeta)
    {
        list(
            "ignore"  => $ignore,
            "added"   => $added,
            "removed" => $removed,
            "updated" => $updated) = QualiaUtils\QualiaSimpleUtils::extractUpdateMeta("settlementTeam", $orderMeta);

        if ($ignore === true) {
            return true;
        }

        if (count($added) > 0) {
            $settlementTeamMeta = [
                "value" => $added,
            ];

            //order update functionality
            $newOrder = false;
            $settlementTeamProcessor = new SettlementTeam($settlementTeamMeta);
            $settlementTeamProcessor->create($orderId, $newOrder);
        }

        if (count($updated) > 0) {
            $settlementTeamMeta = [
                "value" => $updated,
            ];

            $settlementTeamProcessor = new SettlementTeam($settlementTeamMeta);
            $settlementTeamProcessor->update($orderId);
        }

        if (count($removed) > 0) {
            $settlementTeamMeta = [
                "value" => $removed,
            ];

            $settlementTeamProcessor = new SettlementTeam($settlementTeamMeta);
            $settlementTeamProcessor->delete($orderId);
        }
    }
}
