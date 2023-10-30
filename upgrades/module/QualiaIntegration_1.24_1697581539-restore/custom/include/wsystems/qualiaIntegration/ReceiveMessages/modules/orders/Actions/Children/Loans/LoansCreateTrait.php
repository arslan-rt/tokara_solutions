<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Loans;

trait LoansCreateTrait
{
    use LoansHelperTrait;

    protected function patchLoan($orderId, $newOrder)
    {
        $loansMeta = $this->loansMeta;
        $loans     = $loansMeta["value"];

        foreach ($loans as $loan) {
            $uniqueHash = $loan["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }
            $this->_patchLoan($orderId, $loan, $newOrder);
        }
    }
}
