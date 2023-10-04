<?php
$dictionary["Order_RQ_Order"]["fields"]["order_linked_contacts"] =
array(
    "name"         => "order_linked_contacts",
    "type"         => "link",
    "link_file"    => "custom/Extension/modules/Order_RQ_Order/OrdersParentLinkedContacts.php",
    "link_class"   => "OrdersParentLinkedContacts",
    "source"       => "non-db",
    "vname"        => "Contacts Related To Current Order",
    "module"       => "Contacts",
    "bean_name"    => "Contact",
    "link_type"    => "many",
    "relationship" => "",
);
