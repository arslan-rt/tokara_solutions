<?php
// created: 2019-01-14 10:18:58
$layout_defs["Party_RQ_Party"]["subpanel_setup"]['party_rq_party_party_rq_party'] = array(
  'order'             => 100,
  'module'            => 'Party_RQ_Party',
  'subpanel_name'     => 'default',
  'sort_order'        => 'asc',
  'sort_by'           => 'id',
  'title_key'         => 'LBL_PARTY_RQ_PARTY_PARTY_RQ_PARTY_FROM_PARTY_RQ_PARTY_R_TITLE',
  'get_subpanel_data' => 'party_rq_party_party_rq_party',
  'top_buttons'       => array(
    0 => array(
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => array(
      'widget_class' => 'SubPanelTopSelectButton',
      'mode'         => 'MultiSelect',
    ),
  ),
);
