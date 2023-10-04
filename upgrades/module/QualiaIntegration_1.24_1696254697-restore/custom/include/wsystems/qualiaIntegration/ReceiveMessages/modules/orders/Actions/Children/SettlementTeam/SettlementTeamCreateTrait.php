<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\SettlementTeam;

trait SettlementTeamCreateTrait
{
    use SettlementTeamHelperTrait;

    protected function patchSettlementTeam($orderID, $newOrder)
    {
        $settlementTeamMeta = $this->settlementTeamMeta;
        $settlementTeams    = $settlementTeamMeta["value"];

        if (empty($settlementTeams) === true) {
            return;
        }

        $settlementTeamRoles = $this->getSettlementTeamRoles();

        foreach ($settlementTeams as $settlementTeam) {
            $uniqueHash = $settlementTeam["uniqueHash"];

            if ($uniqueHash === null || in_array($settlementTeam["role"], $settlementTeamRoles) === false) {
                continue;
            }

            $this->_patchSettlementTeam($orderID, $settlementTeam, $newOrder);
        }
    }
}
