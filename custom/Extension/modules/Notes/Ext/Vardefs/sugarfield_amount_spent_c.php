<?php
 // created: 2022-03-11 15:16:48
$dictionary['Note']['fields']['amount_spent_c']['labelValue']='Amount Spent';
$dictionary['Note']['fields']['amount_spent_c']['enforced']='';
$dictionary['Note']['fields']['amount_spent_c']['dependency']='equal($note_type_c,"Spend")';
$dictionary['Note']['fields']['amount_spent_c']['related_fields']=array (
  0 => 'currency_id',
  1 => 'base_rate',
);
$dictionary['Note']['fields']['amount_spent_c']['required_formula']='';
$dictionary['Note']['fields']['amount_spent_c']['readonly_formula']='';

 ?>