<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Loans;

use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class LoansManager
{
    public function create(string $orderId, array $orderMeta)
    {
        $hasLoans = array_key_exists("loans", $orderMeta);

        if ($hasLoans === false) {
            return true;
        }
        $loanMeta = $orderMeta["loans"];

        $newOrder      = true;
        $loanProcessor = new Loans($loanMeta);
        $loanProcessor->create($orderId, $newOrder);
    }

    public function update(string $orderId, array $orderMeta)
    {
        list(
            "ignore"  => $ignore,
            "added"   => $added,
            "removed" => $removed,
            "updated" => $updated) = QualiaUtils\QualiaSimpleUtils::extractUpdateMeta("loans", $orderMeta);

        if ($ignore === true) {
            return true;
        }

        if (count($added) > 0) {
            $loanMeta = [
                "value" => $added,
            ];

            $newOrder      = false;
            $loanProcessor = new Loans($loanMeta);
            $loanProcessor->create($orderId, $newOrder);

        }

        if (count($updated) > 0) {
            $loanMeta = [
                "value" => $updated,
            ];

            $loanProcessor = new Loans($loanMeta);
            $loanProcessor->update($orderId);
        }

        if (count($removed) > 0) {
            $loanMeta = [
                "value" => $removed,
            ];

            $loanProcessor = new Loans($loanMeta);
            $loanProcessor->delete($orderId);
        }
    }
}
