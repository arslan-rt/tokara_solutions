<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

$viewdefs['base']['view']['saved-reports-list'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_SAVED_REPORTS_LIST',
            'description' => 'LBL_DASHLET_SAVED_REPORTS_LIST_DESC',
            'config' => array(

            ),
            'preview' => array(

            ),
        )
    ),
    'dashlet_config_panels' => array(
        array(
            'name' => 'panel_body',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'saved_report_id',
                    'label' => 'LBL_REPORT_SELECT',
                    'type' => 'enum',
                    'options' => array('' => ''),
                ),
                array(
                    'name' => 'auto_refresh',
                    'label' => 'LBL_REPORT_AUTO_REFRESH',
                    'type' => 'enum',
                    'options' => 'sugar7_dashlet_reports_auto_refresh_options'
                ),
                array(
                    'name' => 'display_columns',
                    'label' => 'LBL_COLUMNS',
                    'type' => 'enum',
                    'isMultiSelect' => true,
                    'ordered' => true,
                    'span' => 6,
                    'hasBlank' => false,
                    'options' => array('' => ''),
                ),
                array(
                    'name' => 'sort',
                    'label' => 'LBL_WREPORT_SORT',
                    'type' => 'enum',
                    'isMultiSelect' => false,
                    'span' => 6,
                    'hasBlank' => true,
                    'options' => array('' => ''),
                ),
                array(
                    'name' => 'editReport',
                    'label' => 'LBL_REPORT_EDIT',
                    'type' => 'button',
                    'css_class' => 'btn-invisible btn-link btn-inline',
                    'dismiss_label' => true,
                ),
                array(
                    'name' => 'display_rows',
                    'label' => 'LBL_DASHLET_SAVED_REPORTS_ROWS_NUMBER',
                    'type' => 'enum',
                    'options' => 'rows_columns_dashlet_rows_number'
                ),
                array(
                    'name' => 'show_drilldown_button',
                    'label' => 'LBL_DASHLET_SAVED_REPORTS_DISPLAY_DRILLDOWN',
                    'type' => 'bool',
                ),
                array(
                    'name' => 'show_total_count',
                    'label' => 'LBL_DASHLET_SAVED_REPORTS_DISPLAY_COUNT',
                    'type' => 'bool',
                ),
                array(
                    'name' => 'intelligent',
                    'label' => 'LBL_DASHLET_CONFIGURE_INTELLIGENT',
                    'type' => 'bool',
                ),
                array(
                    'name' => 'linked_fields',
                    'label' => 'LBL_DASHLET_CONFIGURE_LINKED',
                    'type' => 'enum',
                    'options' => array('' => ''),
                    'required' => true
                ),
                array(
                    'name' => 'show_summary',
                    'label' => 'LBL_DASHLET_SAVED_REPORTS_DISPLAY_SUMMARY',
                    'type' => 'bool',
                ),
            ),
        ),
    ),
);
