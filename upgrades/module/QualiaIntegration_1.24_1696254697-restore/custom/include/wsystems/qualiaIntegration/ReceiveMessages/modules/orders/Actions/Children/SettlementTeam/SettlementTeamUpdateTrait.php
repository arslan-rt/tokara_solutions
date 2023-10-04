<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\SettlementTeam;

trait SettlementTeamUpdateTrait
{
    use SettlementTeamHelperTrait;

    protected function updateExisting(String $orderId)
    {
        $settlementTeamMeta = $this->settlementTeamMeta;
        $settlementTeams    = $settlementTeamMeta["value"];

        $settlementTeamRoles = $this->getSettlementTeamRoles();

        foreach ($settlementTeams as $settlementTeam) {
            $uniqueHash = $settlementTeam["uniqueHash"];

            if ($uniqueHash === null || in_array($settlementTeam["role"], $settlementTeamRoles) === false) {
                continue;
            }

            $this->_patchSettlementTeam($orderId, $settlementTeam, false);
        }
    }

    protected function unlinkExisting(String $orderID)
    {
        $settlementTeamMeta = $this->settlementTeamMeta;
        $settlementTeams    = $settlementTeamMeta["value"];

        foreach ($settlementTeams as $settlementTeam) {
            $uniqueHash = $settlementTeam["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->unlinkSettlementTeam($settlementTeam, $orderID);
        }
    }
}
