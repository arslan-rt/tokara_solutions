<?php
 // created: 2022-02-08 18:49:09
$dictionary['Call']['fields']['direction']['default']='Outbound';
$dictionary['Call']['fields']['direction']['audited']=false;
$dictionary['Call']['fields']['direction']['massupdate']=true;
$dictionary['Call']['fields']['direction']['hidemassupdate']=false;
$dictionary['Call']['fields']['direction']['comments']='Indicates whether call is inbound or outbound';
$dictionary['Call']['fields']['direction']['duplicate_merge']='enabled';
$dictionary['Call']['fields']['direction']['duplicate_merge_dom_value']='1';
$dictionary['Call']['fields']['direction']['merge_filter']='disabled';
$dictionary['Call']['fields']['direction']['calculated']=false;
$dictionary['Call']['fields']['direction']['dependency']=false;
$dictionary['Call']['fields']['direction']['visibility_grid']=array (
  'trigger' => 'meeting_type_c',
  'values' => 
  array (
    '' => 
    array (
    ),
    'Call' => 
    array (
      0 => 'Outbound',
      1 => 'Inbound',
    ),
    'In Person' => 
    array (
    ),
  ),
);

 ?>