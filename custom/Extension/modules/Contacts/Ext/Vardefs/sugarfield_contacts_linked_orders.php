<?php
$dictionary['Contact']['fields']['contact_linked_orders'] =
array(
  'name'         => 'contact_linked_orders',
  'type'         => 'link',
  'link_class'   => 'ContactsParentLinkedOrders',
  'source'       => 'non-db',
  'vname'        => 'Orders Related To Current Contact',
  'module'       => 'Order_RQ_Order',
  'bean_name'    => 'Order_RQ_Order',
  'link_type'    => 'many',
  'relationship' => '',
);
