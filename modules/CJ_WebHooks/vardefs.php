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
$dictionary['CJ_WebHook'] = [
    'table' => 'cj_web_hooks',
    'audited' => false,
    'unified_search' => false,
    'icon' => 'sicon-customer-journey-lg',
    'duplicate_merge' => true,
    'activity_enabled' => false,
    'comment' => 'CJ_WebHook',
    'optimistic_lock' => true,
    'fields' => [
        'url' => [
            'name' => 'url',
            'vname' => 'LBL_URL',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'varchar',
            'len' => 255,
        ],
        'error_message_path' => [
            'name' => 'error_message_path',
            'vname' => 'LBL_ERROR_MESSAGE_PATH',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'varchar',
            'len' => 255,
            'default' => 'message',
        ],
        'sort_order' => [
            'name' => 'sort_order',
            'vname' => 'LBL_SORT_ORDER',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'int',
            'len' => 8,
            'options' => 'numeric_range_search_dom',
            'enable_range_search' => true,
            'default' => 1,
        ],
        'request_method' => [
            'name' => 'request_method',
            'vname' => 'LBL_REQUEST_METHOD',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'options' => 'cj_webhooks_request_method_list',
            'type' => 'enum',
            'default' => 'GET',
        ],
        'request_format' => [
            'name' => 'request_format',
            'vname' => 'LBL_REQUEST_FORMAT',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'options' => 'cj_webhooks_request_format_list',
            'type' => 'enum',
            'default' => 'json',
        ],
        'response_format' => [
            'name' => 'response_format',
            'vname' => 'LBL_RESPONSE_FORMAT',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'options' => 'cj_webhooks_response_format_list',
            'type' => 'enum',
            'default' => 'json',
        ],
        'trigger_event' => [
            'name' => 'trigger_event',
            'vname' => 'LBL_TRIGGER_EVENT',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'options' => 'cj_webhooks_trigger_event_list',
            'type' => 'enum',
            'default' => '',
            'visibility_grid' => [
                'trigger' => 'parent_type',
                'values' => [
                    'DRI_Workflow_Task_Templates' => [
                        '',
                        'before_create',
                        'after_create',
                        'before_in_progress',
                        'after_in_progress',
                        'before_completed',
                        'after_completed',
                        'before_not_applicable',
                        'after_not_applicable',
                    ],
                    'DRI_SubWorkflow_Templates' => [
                        '',
                        'before_create',
                        'after_create',
                        'before_in_progress',
                        'after_in_progress',
                        'before_completed',
                        'after_completed',
                    ],
                    'DRI_Workflow_Templates' => [
                        '',
                        'before_create',
                        'after_create',
                        'before_in_progress',
                        'after_in_progress',
                        'before_completed',
                        'after_completed',
                        'before_delete',
                        'after_delete',
                    ],
                ],
            ],
        ],
        'request_body' => [
            'name' => 'request_body',
            'vname' => 'LBL_REQUEST_BODY',
            'required' => false,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'options' => 'cj_webhooks_request_body_list',
            'type' => 'enum',
            'default' => 'journey_body',
            'dependency' => 'not(or(equal($request_method, "GET"), equal($request_method, "DELETE")))',
        ],
        'headers' => [
            'name' => 'headers',
            'vname' => 'LBL_HEADERS',
            'required' => false,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'text',
        ],
        'custom_post_body' => [
            'name' => 'custom_post_body',
            'vname' => 'LBL_CUSTOM_POST_BODY',
            'required' => false,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'text',
            'dependency' => 'and(equal($request_body, "custom_body"), or(equal($request_method, "POST"), equal($request_method, "PUT"), equal($request_method, "PATCH")))',
        ],
        'ignore_errors' => [
            'name' => 'ignore_errors',
            'vname' => 'LBL_IGNORE_ERRORS',
            'required' => false,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'bool',
            'default' => false,
        ],
        'active' => [
            'name' => 'active',
            'vname' => 'LBL_ACTIVE',
            'required' => false,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'bool',
            'default' => true,
        ],
        'parent_id' => [
            'name' => 'parent_id',
            'vname' => 'LBL_PARENT_ID',
            'required' => true,
            'reportable' => false,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'id',
        ],
        'parent_name' => [
            'name' => 'parent_name',
            'vname' => 'LBL_PARENT_NAME',
            'required' => true,
            'reportable' => false,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'type' => 'parent',
            'len' => 255,
            'source' => 'non-db',
            'options' => 'cj_webhooks_parent_type_list',
            'parent_type' => 'cj_webhooks_parent_type_list',
            'id_name' => 'parent_id',
            'type_name' => 'parent_type',
        ],
        'parent_type' => [
            'name' => 'parent_type',
            'vname' => 'LBL_PARENT_TYPE',
            'required' => true,
            'reportable' => true,
            'audited' => true,
            'importable' => 'true',
            'massupdate' => false,
            'default' => 'DRI_Workflow_Templates',
            'type' => 'parent_type',
            'len' => 255,
            'dbType' => 'varchar',
            'options' => 'cj_webhooks_parent_type_list',
            'parent_type' => 'cj_webhooks_parent_type_list',
        ],
    ],
    'indices' => [
        'cj_webhooks_parent_id' => [
            'name' => 'cj_webhooks_parent_id',
            'type' => 'index',
            'fields' => [
                'parent_id',
            ],
        ],
    ],
    'duplicate_check' => [
        'enabled' => false,
    ],
    'acls' => [
        'SugarACLAdminOnly' => true,
        'SugarACLCustomerJourney' => true,
    ],
];

VardefManager::createVardef('CJ_WebHooks', 'CJ_WebHook', [
    'basic',
    'team_security',
]);
