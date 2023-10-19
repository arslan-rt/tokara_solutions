<?php
$module_name            = 'Loans_Loans';
$_module_name           = 'loans_loans';
$viewdefs[$module_name] =
array(
    'base' => array(
        'view' => array(
            'record' => array(
                'buttons'      => array(
                    0 => array(
                        'type'      => 'button',
                        'name'      => 'cancel_button',
                        'label'     => 'LBL_CANCEL_BUTTON_LABEL',
                        'css_class' => 'btn-invisible btn-link',
                        'showOn'    => 'edit',
                        'events'    => array(
                            'click' => 'button:cancel_button:click',
                        ),
                    ),
                    1 => array(
                        'type'       => 'rowaction',
                        'event'      => 'button:save_button:click',
                        'name'       => 'save_button',
                        'label'      => 'LBL_SAVE_BUTTON_LABEL',
                        'css_class'  => 'btn btn-primary',
                        'showOn'     => 'edit',
                        'acl_action' => 'edit',
                    ),
                    2 => array(
                        'type'    => 'actiondropdown',
                        'name'    => 'main_dropdown',
                        'primary' => true,
                        'showOn'  => 'view',
                        'buttons' => array(
                            0 => array(
                                'type'       => 'rowaction',
                                'event'      => 'button:edit_button:click',
                                'name'       => 'edit_button',
                                'label'      => 'LBL_EDIT_BUTTON_LABEL',
                                'acl_action' => 'edit',
                            ),
                            1 => array(
                                'type'       => 'shareaction',
                                'name'       => 'share',
                                'label'      => 'LBL_RECORD_SHARE_BUTTON',
                                'acl_action' => 'view',
                            ),
                            2 => array(
                                'type'       => 'pdfaction',
                                'name'       => 'download-pdf',
                                'label'      => 'LBL_PDF_VIEW',
                                'action'     => 'download',
                                'acl_action' => 'view',
                            ),
                            3 => array(
                                'type'       => 'pdfaction',
                                'name'       => 'email-pdf',
                                'label'      => 'LBL_PDF_EMAIL',
                                'action'     => 'email',
                                'acl_action' => 'view',
                            ),
                            4 => array(
                                'type' => 'divider',
                            ),
                            5 => array(
                                'type'       => 'rowaction',
                                'event'      => 'button:find_duplicates_button:click',
                                'name'       => 'find_duplicates_button',
                                'label'      => 'LBL_DUP_MERGE',
                                'acl_action' => 'edit',
                            ),
                            6 => array(
                                'type'       => 'rowaction',
                                'event'      => 'button:duplicate_button:click',
                                'name'       => 'duplicate_button',
                                'label'      => 'LBL_DUPLICATE_BUTTON_LABEL',
                                'acl_module' => 'Loans_Loans',
                                'acl_action' => 'create',
                            ),
                            7 => array(
                                'type'       => 'rowaction',
                                'event'      => 'button:audit_button:click',
                                'name'       => 'audit_button',
                                'label'      => 'LNK_VIEW_CHANGE_LOG',
                                'acl_action' => 'view',
                            ),
                            8 => array(
                                'type' => 'divider',
                            ),
                            9 => array(
                                'type'       => 'rowaction',
                                'event'      => 'button:delete_button:click',
                                'name'       => 'delete_button',
                                'label'      => 'LBL_DELETE_BUTTON_LABEL',
                                'acl_action' => 'delete',
                            ),
                        ),
                    ),
                    3 => array(
                        'name' => 'sidebar_toggle',
                        'type' => 'sidebartoggle',
                    ),
                ),
                'panels'       => array(
                    0 => array(
                        'name'   => 'panel_header',
                        'label'  => 'LBL_RECORD_HEADER',
                        'header' => true,
                        'fields' => array(
                            0 => array(
                                'name'          => 'picture',
                                'type'          => 'avatar',
                                'width'         => 42,
                                'height'        => 42,
                                'dismiss_label' => true,
                                'readonly'      => true,
                                'label'         => null,
                                'fieldIndex'    => 0,
                                'span'          => 6,
                            ),
                            1 => array(
                                'name'       => 'name',
                                'type'       => 'name',
                                'label'      => 'LBL_NAME',
                                'fieldIndex' => 1,
                                'span'       => 6,
                            ),
                            2 => array(
                                'name'          => 'favorite',
                                'label'         => 'LBL_FAVORITE',
                                'type'          => 'favorite',
                                'readonly'      => true,
                                'dismiss_label' => true,
                                'fieldIndex'    => 2,
                                'span'          => 6,
                            ),
                            3 => array(
                                'name'          => 'follow',
                                'label'         => 'LBL_FOLLOW',
                                'type'          => 'follow',
                                'readonly'      => true,
                                'dismiss_label' => true,
                                'fieldIndex'    => 3,
                                'span'          => 6,
                            ),
                        ),
                        'labels' => true,
                    ),
                    1 => array(
                        'name'         => 'panel_body',
                        'label'        => 'LBL_RECORD_BODY',
                        'columns'      => 2,
                        'labelsOnTop'  => true,
                        'placeholders' => true,
                        'newTab'       => false,
                        'panelDefault' => 'expanded',
                        'fields'       => array(
                            0 => array(
                                'name'  => 'loan_number',
                                'type'  => 'varchar',
                                'label' => 'LBL_LOAN_NUMBER',
                            ),
                            1 => array(
                                'name'  => 'amount',
                                'type'  => 'currency',
                                'label' => 'LBL_AMOUNT',
                            ),
                            2 => array(
                                'name'  => 'interest_rate',
                                'label' => 'LBL_INTEREST_RATE',
                            ),
                            3 => array(
                                'name'  => 'description',
                                'type'  => 'text',
                                'label' => 'LBL_DESCRIPTION',
                            ),
                            4 => array(
                                'name'  => 'tag',
                                'type'  => 'tag',
                                'label' => 'LBL_TAGS',
                            ),
                        ),
                        'labels'       => true,
                        'panelState'   => 'expanded',
                    ),
                    2 => array(
                        'columns'      => 2,
                        'name'         => 'panel_hidden',
                        'label'        => 'LBL_SHOW_MORE',
                        'hide'         => true,
                        'labelsOnTop'  => true,
                        'placeholders' => true,
                        'newTab'       => false,
                        'panelDefault' => 'expanded',
                        'fields'       => array(
                            0 => array(
                                'name'     => 'date_entered_by',
                                'type'     => 'fieldset',
                                'label'    => 'LBL_DATE_ENTERED',
                                'fields'   => array(
                                    0 => array(
                                        'name' => 'date_entered',
                                    ),
                                    1 => array(
                                        'type'          => 'label',
                                        'default_value' => 'LBL_BY',
                                    ),
                                    2 => array(
                                        'name' => 'created_by_name',
                                    ),
                                ),
                                'readonly' => true,
                            ),
                            1 => array(
                                'name'     => 'date_modified_by',
                                'type'     => 'fieldset',
                                'label'    => 'LBL_DATE_MODIFIED',
                                'fields'   => array(
                                    0 => array(
                                        'name' => 'date_modified',
                                    ),
                                    1 => array(
                                        'type'          => 'label',
                                        'default_value' => 'LBL_BY',
                                    ),
                                    2 => array(
                                        'name' => 'modified_by_name',
                                    ),
                                ),
                                'readonly' => true,
                            ),
                            2 => array(
                                'name'  => 'team_name',
                                'label' => 'LBL_TEAMS',
                            ),
                            3 => array(
                                'name'  => 'assigned_user_name',
                                'type'  => 'relate',
                                'label' => 'LBL_ASSIGNED_TO',
                            ),
                        ),
                        'labels'       => true,
                        'panelState'   => 'expanded',
                    ),
                ),
                'templateMeta' => array(
                    'useTabs' => false,
                ),
            ),
        ),
    ),
);
