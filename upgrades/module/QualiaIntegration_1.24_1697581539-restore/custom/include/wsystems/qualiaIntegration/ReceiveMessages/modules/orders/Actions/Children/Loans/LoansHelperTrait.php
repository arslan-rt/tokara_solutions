<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children\Loans;

use BeanFactory;
use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils\QualiaGlobalVariables;

trait LoansHelperTrait
{
    /**
     * _patchLoan function
     *
     * @param String $orderId
     * @param Array $loan
     * @return void
     */
    private function _patchLoan(String $orderId, array $loan, bool $newOrder)
    {
        $recordData = QualiaUtils\Queries::getRecordIdAndDiffHashByUniqueId(
            QualiaUtils\QualiaGlobalVariables::LOAN_TABLE_NAME,
            QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            $loan["uniqueHash"]
        );

        $recordId       = $recordData["id"];
        $recordDiffHash = $recordData["qualia_diff_hash"];

        $name      = $this->_getLoanName($loan);
        $partyMeta = $this->_getPartyMeta($loan);

        if ($recordId === false) {
            $recordId = $this->_createLoanBean($loan, $name);
        } else if ($recordDiffHash !== $loan["diffHash"]) {
            $this->_updateLoanBean($recordId, $loan, $name);
        }

        $loanPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::QUALIA_UNIQUE_HASH,
            QualiaUtils\QualiaGlobalVariables::LOAN_CHILD,
            $loan["uniqueHash"]
        );

        if ($loanPartyId === false) {
            $loanPartyId = QualiaUtils\QualiaBeanUtils::createParty(
                QualiaUtils\QualiaGlobalVariables::LOAN_CHILD,
                QualiaUtils\QualiaGlobalVariables::LOAN_MODULE_NAME,
                $recordId,
                $name,
                $partyMeta
            );
        } else if ($recordDiffHash !== $loan["diffHash"]) {
            $this->_updateParty($loanPartyId, $name, $partyMeta);
        }

        //we dont need to check if the records are already related because this is the order create functionality
        if ($newOrder === true) {
            $orderLinked = false;
        } else {
            $orderLinked = QualiaUtils\QualiaBeanUtils::checkLinkModuleXtoModuleY(
                $loanPartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }

        if ($orderLinked === false) {
            QualiaUtils\QualiaBeanUtils::linkModuleXtoModuleYManyToMany(
                $loanPartyId,
                $orderId,
                QualiaUtils\QualiaGlobalVariables::ORDER_MODULE_NAME,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL
            );
        }
    }

    /**
     * _getLoanName function
     *
     * @param array $loan
     * @return String
     */
    private function _getLoanName($loan)
    {
        $name = "";

        if (QualiaUtils\StringUtils::isNotNullOrEmptyString($loan["loanNumber"])) {
            $name = $loan["loanNumber"];
        } else {
            $name = "No loan number";
        }

        return $name;
    }

    /**
     * _getPartyMeta function
     *
     * @param Array $loan
     * @return array
     */
    protected function _getPartyMeta($loan)
    {
        $uniqueHash = $loan["uniqueHash"];
        $meta       = [QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH => $uniqueHash];

        return $meta;
    }

    /**
     * _createLoanBean function
     *
     * @param array $loan
     * @param string $name
     * @return void
     */
    protected function _createLoanBean(array $loan, string $name)
    {
        $bean                   = BeanFactory::newBean(QualiaUtils\QualiaGlobalVariables::LOAN_MODULE_NAME);
        $id                     = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $bean->id               = $id;
        $bean->new_with_id      = true;
        $bean->assigned_user_id = QualiaUtils\QualiaSimpleUtils::getCurrentUserId();

        $bean = $this->_updateSelfLoanFields($bean, $loan, $name);

        $bean->save();

        return $id;
    }

    /**
     * _updateLoanBean function
     *
     * @param string $id
     * @param array $loan
     * @param string $name
     * @return void
     */
    protected function _updateLoanBean(string $id, array $loan, string $name)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::LOAN_MODULE_NAME,
            $id,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean            = $this->_updateSelfLoanFields($bean, $loan, $name);
        $bean->processed = true;
        $bean->save();
    }

    /**
     * _updateSelfLoanFields function
     *
     * @param SugarBean|null $bean
     * @param array $loan
     * @param string $name
     * @return SugarBean
     */
    protected function _updateSelfLoanFields(SugarBean $bean, array $loan, string $name): SugarBean
    {
        $bean->loan_number        = $loan["loanNumber"];
        $bean->amount             = $loan["amount"];
        $bean->interest_rate      = $loan["interestRate"];
        $bean->qualia_unique_hash = $loan["uniqueHash"];
        $bean->qualia_diff_hash   = $loan["diffHash"];
        $bean->name               = $name;

        return $bean;
    }

    protected function _updateParty(string $loanPartyId, string $name, array $partyMeta)
    {
        $bean = BeanFactory::retrieveBean(
            QualiaUtils\QualiaGlobalVariables::PARTY_MODULE_NAME,
            $loanPartyId,
            array('disable_row_level_security' => true)
        );

        if ($bean instanceof SugarBean === false) {
            return;
        }

        $bean->name = $name;

        foreach ($partyMeta as $fieldName => $fieldValue) {
            $bean->{$fieldName} = $fieldValue;
        }

        $bean->processed = null;
        $bean->save();
    }

    /**
     * unlinkLoan function
     *
     * unlink loan party from order
     *
     * @param String $loanUniqueHash
     * @param String $orderId
     * @return void
     */
    private function unlinkLoan(string $loanUniqueHash, string $orderId)
    {
        $loanPartyId = QualiaUtils\Queries::getPartyByTypeAndId(
            QualiaUtils\QualiaGlobalVariables::PARTY_TYPE_FIELD,
            QualiaUtils\QualiaGlobalVariables::PARTY_QUALIA_UNIQUE_HASH,
            QualiaUtils\QualiaGlobalVariables::LOAN_CHILD,
            $loanUniqueHash
        );

        if ($loanPartyId !== false) {
            QualiaUtils\QualiaBeanUtils::unlinkPartyFromRecordId(
                $loanPartyId,
                QualiaUtils\QualiaGlobalVariables::PARTY_ORDER_REL,
                $orderId
            );
        }
    }
}
