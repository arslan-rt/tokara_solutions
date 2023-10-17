<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Loans;

trait LoansUpdateTrait
{
    use LoansHelperTrait;

    protected function updateExisting(String $orderId)
    {
        $loansMeta = $this->loansMeta;
        $loans     = $loansMeta["value"];

        foreach ($loans as $loan) {
            $uniqueHash = $loan["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->_patchLoan($orderId, $loan, false);
        }
    }

    /**
     * unlinkExisting function
     *
     * Used to unlink parties between order and loans
     *
     * @param String $orderId
     * @return void
     */
    protected function unlinkExisting(String $orderId)
    {
        $loansMeta = $this->loansMeta;
        $loans     = $loansMeta["value"];

        foreach ($loans as $loan) {
            $uniqueHash = $loan["uniqueHash"];

            if ($uniqueHash === null) {
                continue;
            }

            $this->unlinkLoan($uniqueHash, $orderId);
        }

    }
}
