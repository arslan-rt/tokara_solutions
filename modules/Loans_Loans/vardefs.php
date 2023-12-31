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

$dictionary['Loans_Loans'] = array(
    'table'              => 'loans_loans',
    'audited'            => true,
    'activity_enabled'   => false,
    'duplicate_merge'    => true,
    'fields'             => array(
        'qualia_unique_hash'           => array(
            'required'                  => false,
            'name'                      => 'qualia_unique_hash',
            'vname'                     => 'LBL_QUALIA_UNIQUE_HASH',
            'type'                      => 'varchar',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => 'Unique hash for order',
            'label'                     => 'LBL_QUALIA_UNIQUE_HASH',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '255',
            'size'                      => '20',
        ),
        'qualia_diff_hash'             => array(
            'required'                  => false,
            'name'                      => 'qualia_diff_hash',
            'vname'                     => 'LBL_QUALIA_DIFF_HASH',
            'type'                      => 'varchar',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => 'Diff hash for order',
            'label'                     => 'LBL_QUALIA_DIFF_HASH',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '255',
            'size'                      => '20',
        ),
        'loan_number'                  => array(
            'required'                  => false,
            'name'                      => 'loan_number',
            'vname'                     => 'LBL_LOAN_NUMBER',
            'type'                      => 'varchar',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '64',
            'size'                      => '20',
        ),
        'interest_rate'                => array(
            'required'                  => false,
            'name'                      => 'interest_rate',
            'vname'                     => 'LBL_INTEREST_RATE',
            'type'                      => 'varchar',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '64',
            'size'                      => '20',
        ),
        'sequence_attrb'               => array(
            'required'                  => false,
            'name'                      => 'sequence_attrb',
            'vname'                     => 'LBL_SEQUENCE_ATTRB',
            'type'                      => 'int',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '11',
            'size'                      => '20',
            'enable_range_search'       => false,
            'disable_num_format'        => '',
            'min'                       => false,
            'max'                       => false,
        ),
        'loans_loans_type'             => array(
            'name'                      => 'loans_loans_type',
            'vname'                     => 'LBL_TYPE',
            'type'                      => 'enum',
            'options'                   => 'loans_loans_type_dom',
            'len'                       => 100,
            'duplicate_on_record_copy'  => 'always',
            'comment'                   => 'The Sale is of this type',
            'required'                  => false,
            'massupdate'                => true,
            'no_default'                => false,
            'comments'                  => 'The Sale is of this type',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'calculated'                => false,
            'size'                      => '20',
            'dependency'                => false,
        ),
        'party_id_reference'           => array(
            'required'                  => false,
            'name'                      => 'party_id_reference',
            'vname'                     => 'LBL_PARTY_ID_REFERENCE',
            'type'                      => 'int',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '11',
            'size'                      => '20',
            'enable_range_search'       => false,
            'disable_num_format'        => '',
            'min'                       => false,
            'max'                       => false,
        ),
        'nickname'                     => array(
            'required'                  => false,
            'name'                      => 'nickname',
            'vname'                     => 'LBL_NICKNAME',
            'type'                      => 'varchar',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '64',
            'size'                      => '20',
        ),
        'mortgage_insurance_case'      => array(
            'required'                  => false,
            'name'                      => 'mortgage_insurance_case',
            'vname'                     => 'LBL_MORTGAGE_INSURANCE_CASE',
            'type'                      => 'varchar',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => '',
            'full_text_search'          => array(
                'enabled'    => '0',
                'boost'      => '1',
                'searchable' => false,
            ),
            'calculated'                => false,
            'len'                       => '128',
            'size'                      => '20',
        ),
        // 'detail_rate'                  => array(
        //   'required'                  => false,
        //   'name'                      => 'detail_rate',
        //   'vname'                     => 'LBL_DETAIL_RATE',
        //   'type'                      => 'currency',
        //   'massupdate'                => false,
        //   'no_default'                => false,
        //   'comments'                  => '',
        //   'help'                      => '',
        //   'importable'                => 'true',
        //   'duplicate_merge'           => 'enabled',
        //   'duplicate_merge_dom_value' => '1',
        //   'audited'                   => false,
        //   'reportable'                => true,
        //   'unified_search'            => false,
        //   'merge_filter'              => 'disabled',
        //   'pii'                       => false,
        //   'default'                   => 0.0,
        //   'calculated'                => false,
        //   'len'                       => 26,
        //   'size'                      => '20',
        //   'enable_range_search'       => false,
        //   'precision'                 => 6,
        //   'related_fields'            => array(
        //     0 => 'currency_id',
        //     1 => 'base_rate',
        //   ),
        // ),
        'detail_payment_total_monthly' => array(
            'required'                  => false,
            'name'                      => 'detail_payment_total_monthly',
            'vname'                     => 'LBL_DETAIL_PAYMENT_TOTAL_MONTHLY',
            'type'                      => 'currency',
            'massupdate'                => false,
            'no_default'                => false,
            'comments'                  => '',
            'help'                      => '',
            'importable'                => 'true',
            'duplicate_merge'           => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'audited'                   => false,
            'reportable'                => true,
            'unified_search'            => false,
            'merge_filter'              => 'disabled',
            'pii'                       => false,
            'default'                   => 0.0,
            'calculated'                => false,
            'len'                       => 26,
            'size'                      => '20',
            'enable_range_search'       => false,
            'precision'                 => 6,
            'related_fields'            => array(
                0 => 'currency_id',
                1 => 'base_rate',
            ),
        ),
    ),
    'indices'            => [
        [
            'name'   => 'index_qualia_unique_hash_index',
            'type'   => 'index',
            'fields' => array(
                'qualia_unique_hash',
            ),
        ],
        [
            'name'   => 'index_qualia_diff_hash_index',
            'type'   => 'index',
            'fields' => array(
                'qualia_diff_hash',
            ),
        ],
    ],
    'relationships'      => array(
    ),
    'optimistic_locking' => true,
    'unified_search'     => true,
    'full_text_search'   => true,
);

if (!class_exists('VardefManager')) {
}
VardefManager::createVardef('Loans_Loans', 'Loans_Loans', array('basic', 'team_security', 'assignable', 'taggable', 'sale'));
