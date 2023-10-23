<?php

/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

$dictionary['tk_Financial_Info'] = array(
    'table' => 'tk_financial_info',
    'audited' => true,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' =>  array (
        'disbursements' => 
        array (
          'required' => false,
          'readonly' => false,
          'name' => 'disbursements',
          'vname' => 'LBL_DISBURSEMENTS',
          'type' => 'varchar',
          'massupdate' => true,
          'hidemassupdate' => false,
          'no_default' => false,
          'comments' => '',
          'help' => '',
          'importable' => 'true',
          'duplicate_merge' => 'enabled',
          'duplicate_merge_dom_value' => '1',
          'audited' => false,
          'reportable' => true,
          'unified_search' => false,
          'merge_filter' => 'disabled',
          'pii' => false,
          'default' => '',
          'full_text_search' => 
          array (
            'enabled' => '0',
            'boost' => '1',
            'searchable' => false,
          ),
          'calculated' => false,
          'len' => '255',
          'size' => '20',
        ),
        'disbursement_account' => 
        array (
          'required' => false,
          'readonly' => false,
          'name' => 'disbursement_account',
          'vname' => 'LBL_DISBURSEMENT_ACCOUNT',
          'type' => 'varchar',
          'massupdate' => true,
          'hidemassupdate' => false,
          'no_default' => false,
          'comments' => '',
          'help' => '',
          'importable' => 'true',
          'duplicate_merge' => 'enabled',
          'duplicate_merge_dom_value' => '1',
          'audited' => false,
          'reportable' => true,
          'unified_search' => false,
          'merge_filter' => 'disabled',
          'pii' => false,
          'default' => '',
          'full_text_search' => 
          array (
            'enabled' => '0',
            'boost' => '1',
            'searchable' => false,
          ),
          'calculated' => false,
          'len' => '255',
          'size' => '20',
        ),
        'order_number' => 
        array (
          'required' => false,
          'readonly' => false,
          'name' => 'order_number',
          'vname' => 'LBL_ORDER_NUMBER',
          'type' => 'varchar',
          'massupdate' => true,
          'hidemassupdate' => false,
          'no_default' => false,
          'comments' => '',
          'help' => '',
          'importable' => 'true',
          'duplicate_merge' => 'enabled',
          'duplicate_merge_dom_value' => '1',
          'audited' => false,
          'reportable' => true,
          'unified_search' => false,
          'merge_filter' => 'disabled',
          'pii' => false,
          'default' => '',
          'full_text_search' => 
          array (
            'enabled' => '0',
            'boost' => '1',
            'searchable' => false,
          ),
          'calculated' => false,
          'len' => '255',
          'size' => '20',
        ),
      ),
    'relationships' => array (
),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('tk_Financial_Info','tk_Financial_Info', array('basic','team_security','assignable','taggable','sale'));
