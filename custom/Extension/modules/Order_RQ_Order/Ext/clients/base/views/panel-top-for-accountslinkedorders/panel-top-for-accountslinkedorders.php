<?php

$viewdefs['Order_RQ_Order']['base']['view']['panel-top-for-accountslinkedorders'] = array(
  'type'    => 'panel-top',
  'buttons' => array(
    // array(
    //   'type'      => 'button',
    //   'css_class' => 'btn-invisible',
    //   'icon'      => 'icon-chevron-up',
    //   'tooltip'   => 'LBL_TOGGLE_VISIBILITY',
    // ),
    // array(
    //   'type'      => 'actiondropdown',
    //   'name'      => 'panel_dropdown',
    //   'css_class' => 'pull-right',
    //   'buttons'   => array(

    //   ),
    // ),
  ),
  'fields'  => array(
    array(
      'name' => 'collection-count',
      'type' => 'collection-count',
    ),
  ),
);
