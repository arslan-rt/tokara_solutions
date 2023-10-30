<?php

$viewdefs['Home']['base']['view']['qualia_api_view'] = array(
    'buttons' => array(
        array(
            'type' => 'rowaction',
            'name' => 'save_button',
            'label' => 'LBL_TEST_CONNECTION',
            'css_class' => 'btn btn-primary',
            'showOn' => 'edit',
            'acl_action' => 'edit',
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'showOn' => 'view',
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'event' => 'button:edit_button:click',
                    'name' => 'edit_button',
                    'label' => 'LBL_EDIT_BUTTON_LABEL',
                    'acl_action' => 'edit',
                ),
            ),
        )
    ),
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_HEADER',
            'header' => true,
        ),
        array(
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                'empty',
                'empty',
                array(
                    'name' => 'url',
                    'label' => 'LBL_URL'
                ),
				array(
                    'name' => 'auth_key',
                    'label' => 'LBL_AUTH_KEY'
                ),
                array(
                    'name' => 'records_limit',
                    'label' => 'LBL_RECORDS_LIMIT'
                ),
                array(
                    'name' => 'last_cursor',
                    'label' => 'LBL_LAST_CURSOR'
                )
            ),
        ),
    ),
);


