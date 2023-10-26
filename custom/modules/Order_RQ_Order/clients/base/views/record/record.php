<?php
$module_name = 'Order_RQ_Order';
$_module_name = 'order_rq_order';
$viewdefs[$module_name] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'record' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'type' => 'button',
            'name' => 'cancel_button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
            'showOn' => 'edit',
            'events' => 
            array (
              'click' => 'button:cancel_button:click',
            ),
          ),
          1 => 
          array (
            'type' => 'rowaction',
            'event' => 'button:save_button:click',
            'name' => 'save_button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'css_class' => 'btn btn-primary',
            'showOn' => 'edit',
            'acl_action' => 'edit',
          ),
          2 => 
          array (
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'showOn' => 'view',
            'buttons' => 
            array (
              0 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:edit_button:click',
                'name' => 'edit_button',
                'label' => 'LBL_EDIT_BUTTON_LABEL',
                'acl_action' => 'edit',
              ),
              1 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:sync_order:click',
                'name' => 'sync_order',
                'label' => 'LBL_SYNC_ORDER_LABEL',
                // 'acl_action' => 'create',
                'module' => 'Order_RQ_Order',
              ),
              2 => 
              array (
                'type' => 'divider',
              ),
              3 => 
              array (
                'type' => 'shareaction',
                'name' => 'share',
                'label' => 'LBL_RECORD_SHARE_BUTTON',
                'acl_action' => 'view',
              ),
              4 => 
              array (
                'type' => 'pdfaction',
                'name' => 'download-pdf',
                'label' => 'LBL_PDF_VIEW',
                'action' => 'download',
                'acl_action' => 'view',
              ),
              5 => 
              array (
                'type' => 'pdfaction',
                'name' => 'email-pdf',
                'label' => 'LBL_PDF_EMAIL',
                'action' => 'email',
                'acl_action' => 'view',
              ),
              6 => 
              array (
                'type' => 'divider',
              ),
              7 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:find_duplicates_button:click',
                'name' => 'find_duplicates_button',
                'label' => 'LBL_DUP_MERGE',
                'acl_action' => 'edit',
              ),
              8 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:duplicate_button:click',
                'name' => 'duplicate_button',
                'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                'acl_module' => 'Order_RQ_Order',
                'acl_action' => 'create',
              ),
              9 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:audit_button:click',
                'name' => 'audit_button',
                'label' => 'LNK_VIEW_CHANGE_LOG',
                'acl_action' => 'view',
              ),
              10 => 
              array (
                'type' => 'divider',
              ),
              11 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:delete_button:click',
                'name' => 'delete_button',
                'label' => 'LBL_DELETE_BUTTON_LABEL',
                'acl_action' => 'delete',
              ),
            ),
          ),
          3 => 
          array (
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
          ),
        ),
        'panels' => 
        array (
          0 => 
          array (
            'name' => 'panel_header',
            'label' => 'LBL_RECORD_HEADER',
            'header' => true,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'picture',
                'type' => 'avatar',
                'width' => 42,
                'height' => 42,
                'dismiss_label' => true,
                'readonly' => true,
                'label' => NULL,
                'fieldIndex' => 0,
                'span' => 6,
              ),
              1 => 
              array (
                'name' => 'name',
                'type' => 'name',
                'label' => 'LBL_NAME',
                'fieldIndex' => 1,
                'span' => 6,
              ),
              2 => 
              array (
                'name' => 'favorite',
                'label' => 'LBL_FAVORITE',
                'type' => 'favorite',
                'readonly' => true,
                'dismiss_label' => true,
                'fieldIndex' => 2,
                'span' => 6,
              ),
              3 => 
              array (
                'name' => 'follow',
                'label' => 'LBL_FOLLOW',
                'type' => 'follow',
                'readonly' => true,
                'dismiss_label' => true,
                'fieldIndex' => 3,
                'span' => 6,
              ),
            ),
            'labels' => true,
          ),
          1 => 
          array (
            'newTab' => true,
            'panelDefault' => 'expanded',
            'name' => 'LBL_RECORDVIEW_PANEL3',
            'label' => 'LBL_RECORDVIEW_PANEL3',
            'columns' => 4,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'labels' => true,
            'panelState' => 'expanded',
            'fields' => 
            array (
              0 => 
              array (
                'fieldIndex' => 1,
                'name' => 'order_status',
                'type' => 'enum',
                'label' => 'LBL_ORDER_STATUS',
                'readonly' => false,
                'dismiss_label' => false,
                'span' => 3,
              ),
              1 => 
              array (
                'fieldIndex' => 2,
                'name' => 'opened_date_for_order_c',
                'type' => 'date',
                'label' => 'Creation Date',
                'span' => 9,
              ),
              2 => 
              array (
                'fieldIndex' => 3,
                'name' => 'purchase_price',
                'type' => 'currency',
                'label' => 'LBL_PURCHASE_PRICE',
                'span' => 3,
              ),
              3 => 
              array (
                'fieldIndex' => 4,
                'name' => 'order_number',
                'type' => 'varchar',
                'label' => 'LBL_ORDER_NUMBER',
                'span' => 9,
              ),
              4 => 
              array (
                'fieldIndex' => 5,
                'name' => 'transaction_type',
                'type' => 'varchar',
                'label' => 'LBL_TRANSACTION_TYPE',
                'readonly' => false,
                'dismiss_label' => false,
                'span' => 3,
              ),
              5 => 
              array (
                'fieldIndex' => 6,
                'name' => 'estimated_closing',
                'type' => 'date',
                'label' => 'LBL_ESTIMATED_CLOSING',
                'span' => 9,
              ),
              6 => 
              array (
                'fieldIndex' => 7,
                'name' => 'earnest_money',
                'type' => 'currency',
                'label' => 'LBL_EARNEST_MONEY',
                'span' => 3,
              ),
              7 => 
              array (
                'span' => 9,
              ),
              8 => 
              array (
                'name' => 'tk_financial_info_order_rq_order_1_name',
              ),
            ),
          ),
          2 => 
          array (
            'newTab' => true,
            'panelDefault' => 'expanded',
            'name' => 'LBL_RECORDVIEW_PANEL5',
            'label' => 'LBL_RECORDVIEW_PANEL5',
            'columns' => 12,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'labels' => true,
            'panelState' => 'expanded',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'description',
                'comment' => 'Full text of the note',
                'label' => 'LBL_DESCRIPTION',
                'type' => 'text',
                'fieldIndex' => 0,
                'span' => 6,
              ),
              1 => 
              array (
                'name' => 'team_name',
                'studio' => 
                array (
                  'portallistview' => false,
                  'portalrecordview' => false,
                ),
                'label' => 'LBL_TEAMS',
                'fieldIndex' => 3,
                'span' => 6,
              ),
              2 => 
              array (
                'fieldIndex' => 6,
                'name' => 'created_by_name',
                'type' => 'relate',
                'label' => 'LBL_CREATED',
                'span' => 3,
              ),
              3 => 
              array (
                'fieldIndex' => 7,
                'name' => 'date_entered',
                'type' => 'datetime',
                'label' => 'LBL_DATE_ENTERED',
                'readonly' => true,
                'span' => 9,
              ),
              4 => 
              array (
                'fieldIndex' => 8,
                'name' => 'modified_by_name',
                'type' => 'relate',
                'label' => 'LBL_MODIFIED',
                'span' => 3,
              ),
              5 => 
              array (
                'fieldIndex' => 9,
                'name' => 'date_modified',
                'type' => 'datetime',
                'label' => 'LBL_DATE_MODIFIED',
                'readonly' => true,
                'span' => 9,
              ),
              6 => 
              array (
                'fieldIndex' => 10,
                'name' => 'qualia_id',
                'type' => 'varchar',
                'label' => 'LBL_ORDER_ID',
                'span' => 3,
              ),
              7 => 
              array (
                'fieldIndex' => 11,
                'name' => 'assigned_user_name',
                'type' => 'relate',
                'label' => 'LBL_ASSIGNED_TO',
                'span' => 9,
              ),
              8 => 
              array (
                'fieldIndex' => 11,
                'name' => 'corrupted_data',
                'type' => 'bool',
                'label' => 'LBL_CORRUPTED_DATA',
                'span' => 3,
              ),
              9 => 
              array (
                'span' => 9,
              ),
            ),
          ),
        ),
        'templateMeta' => 
        array (
          'useTabs' => true,
        ),
      ),
    ),
  ),
);
