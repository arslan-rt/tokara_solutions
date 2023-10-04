<?php
$dictionary['Loans_Loans']['fields']['loan_linked_orders'] =
array(
  'name'         => 'loan_linked_orders',
  'type'         => 'link',
  'link_file'    => 'custom/Extension/modules/Loans_Loans/LoansParentLinkedOrders.php',
  'link_class'   => 'LoansParentLinkedOrders',
  'source'       => 'non-db',
  'vname'        => 'Orders Related To Current Loan',
  'module'       => 'Order_RQ_Order',
  'bean_name'    => 'Order_RQ_Order',
  'link_type'    => 'many',
  'relationship' => '',
);
