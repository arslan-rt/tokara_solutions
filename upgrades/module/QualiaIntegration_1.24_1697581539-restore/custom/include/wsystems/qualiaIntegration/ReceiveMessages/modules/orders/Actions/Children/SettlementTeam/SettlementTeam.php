<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\SettlementTeam;

class SettlementTeam 
{
    use SettlementTeamCreateTrait;
    use SettlementTeamUpdateTrait;

    public function __construct(?array $settlementTeamMeta)
    {
        $this->settlementTeamMeta = $settlementTeamMeta;
    }

    public function create($orderId, $newOrder)
    {
        $this->patchSettlementTeam($orderId, $newOrder);
    }

    public function update($orderId)
    {
        $this->updateExisting($orderId);
    }

    public function delete($orderId)
    {
        $this->unlinkExisting($orderId);
    }
}
