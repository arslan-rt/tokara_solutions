<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders;

use SugarBean;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\ReceiveMessages\modules\orders\Actions\Children as QualiaOrderChildren;
use Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils as QualiaUtils;

class OrderCore
{
    protected $orderId = null;

    protected function updateSelfFields(SugarBean $bean, array $orderMeta): SugarBean
    {
        $bean->order_number       = $orderMeta["orderNumber"];
        $bean->qualia_id          = $orderMeta["orderId"];
        $bean->name               = $orderMeta["orderNumber"];
        $bean->earnest_money      = $orderMeta["earnestAmount"];
        $bean->purchase_price     = $orderMeta["purchasePrice"];
        $bean->order_status       = $orderMeta["status"];
        $bean->transaction_type   = $orderMeta["transactionType"];
        $bean->qualia_unique_hash = $orderMeta["uniqueHash"];
        $bean->qualia_diff_hash   = $orderMeta["diffHash"];
        $bean->corrupted_data     = $orderMeta["corruptedData"];

        $bean->estimated_closing       = empty($orderMeta["estimatedClosing"]) === false ? QualiaUtils\TimeDateUtils::fromTimeStampToDB($orderMeta["estimatedClosing"], true) : null;
        $bean->opened_date_for_order_c = empty($orderMeta["createdDate"]) === false ? QualiaUtils\TimeDateUtils::fromTimeStampToDB($orderMeta["createdDate"], true) : null;

        return $bean;
    }

    protected function checkCoruptedData(SugarBean $bean, array $orderMeta): void
    {
        $hasProperty   = array_key_exists("corruptedData", $orderMeta);
        $corruptedData = $orderMeta["corruptedData"];

        if ($hasProperty === false || $corruptedData === null) {
            return;
        }

        $this->createAndLinkNewNotes($bean, $orderMeta);
    }

    private function createAndLinkNewNotes(SugarBean $orderBean, array $orderMeta): void
    {
        $newNote              = \BeanFactory::newBean("Notes");
        $newNote->new_with_id = true;
        $newNote->id          = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
        $newNote->name        = $orderBean->qualia_id . " " . $orderBean->name . " " . \TimeDate::getInstance()->nowDbDate();
        $newNote->description = $orderMeta["errors"];

        $newNote->save();

        $orderBean->load_relationship("order_rq_order_notes");
        $orderBean->order_rq_order_notes->add($newNote->id);
    }

    protected function createChildren(string $orderId, array $orderMeta)
    {
        $propertyManager = new QualiaOrderChildren\Property\PropertyManager();
        $propertyManager->create($orderId, $orderMeta);

        $loansManager = new QualiaOrderChildren\Loans\LoansManager();
        $loansManager->create($orderId, $orderMeta);

        $contactsManager = new QualiaOrderChildren\Contacts\ContactsManager();
        $contactsManager->create($orderId, $orderMeta);

        $settlementTeamManager = new QualiaOrderChildren\SettlementTeam\SettlementTeamManager();
        $settlementTeamManager->create($orderId, $orderMeta);
    }

    /**
     * updateChildren function
     *
     * this function will be called only on update an order
     * here all the details will came directly like which childre should be remove/add/change
     *
     * @param SugarBean $orderBean
     * @param string $orderId
     * @param array $orderMeta
     * @return void
     */
    protected function updateChildren(SugarBean $orderBean, string $orderId, array $orderMeta)
    {
        $propertyManager = new QualiaOrderChildren\Property\PropertyManager();
        $propertyManager->update($orderId, $orderMeta);

        $loansManager = new QualiaOrderChildren\Loans\LoansManager();
        $loansManager->update($orderId, $orderMeta);

        $contactsManager = new QualiaOrderChildren\Contacts\ContactsManager();
        $contactsManager->update($orderId, $orderMeta);

        $settlementTeamManager = new QualiaOrderChildren\SettlementTeam\SettlementTeamManager();
        $settlementTeamManager->update($orderId, $orderMeta);
    }
}
