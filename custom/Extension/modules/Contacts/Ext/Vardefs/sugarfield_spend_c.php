<?php
 // created: 2022-03-11 15:26:42
$dictionary['Contact']['fields']['spend_c']['duplicate_merge_dom_value']=0;
$dictionary['Contact']['fields']['spend_c']['labelValue']='Spend';
$dictionary['Contact']['fields']['spend_c']['calculated']='true';
$dictionary['Contact']['fields']['spend_c']['formula']='rollupConditionalSum($notes,"amount_spent_c","note_type_c","Spend")';
$dictionary['Contact']['fields']['spend_c']['enforced']='true';
$dictionary['Contact']['fields']['spend_c']['dependency']='';
$dictionary['Contact']['fields']['spend_c']['related_fields']=array (
  0 => 'currency_id',
  1 => 'base_rate',
);
$dictionary['Contact']['fields']['spend_c']['required_formula']='';
$dictionary['Contact']['fields']['spend_c']['readonly_formula']='';

 ?>