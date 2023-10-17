<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Loans;

class Loans
{
    use LoansCreateTrait;
    use LoansUpdateTrait;

    public function __construct(?array $loansMeta)
    {
        $this->loansMeta = $loansMeta;
    }

    public function create($orderId, $newOrder)
    {
        $this->patchLoan($orderId, $newOrder);
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
