<?php
// created: 2022-12-12 04:51:08
$viewdefs['Accounts']['base']['view']['recorddashlet'] = array (
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
          'type' => 'escalate-action',
          'event' => 'button:escalate_button:click',
          'name' => 'escalate_button',
          'label' => 'LBL_ESCALATE_BUTTON_LABEL',
          'acl_action' => 'create',
          'module' => 'Accounts',
        ),
      ),
    ),
  ),
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_HEADER',
      'header' => true,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'picture',
          'type' => 'avatar',
          'size' => 'large',
          'dismiss_label' => true,
          'readonly' => true,
        ),
        1 => 'name',
      ),
    ),
    1 => 
    array (
      'name' => 'panel_body',
      'label' => 'LBL_RECORD_BODY',
      'columns' => 2,
      'labelsOnTop' => true,
      'placeholders' => true,
      'newTab' => false,
      'panelDefault' => 'expanded',
      'fields' => 
      array (
        0 => 'phone_office',
        1 => 'phone_fax',
        2 => 
        array (
          'name' => 'phone_alternate',
          'label' => 'LBL_PHONE_ALT',
        ),
        3 => 
        array (
        ),
        4 => 'email',
        5 => 'website',
        6 => 
        array (
          'name' => 'billing_address',
          'type' => 'fieldset',
          'css_class' => 'address',
          'label' => 'LBL_BILLING_ADDRESS',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'billing_address_street',
              'css_class' => 'address_street',
              'placeholder' => 'LBL_BILLING_ADDRESS_STREET',
            ),
            1 => 
            array (
              'name' => 'billing_address_city',
              'css_class' => 'address_city',
              'placeholder' => 'LBL_BILLING_ADDRESS_CITY',
            ),
            2 => 
            array (
              'name' => 'billing_address_state',
              'css_class' => 'address_state',
              'placeholder' => 'LBL_BILLING_ADDRESS_STATE',
            ),
            3 => 
            array (
              'name' => 'billing_address_postalcode',
              'css_class' => 'address_zip',
              'placeholder' => 'LBL_BILLING_ADDRESS_POSTALCODE',
            ),
            4 => 
            array (
              'name' => 'billing_address_country',
              'css_class' => 'address_country',
              'placeholder' => 'LBL_BILLING_ADDRESS_COUNTRY',
            ),
          ),
        ),
        7 => 
        array (
          'name' => 'shipping_address',
          'type' => 'fieldset',
          'css_class' => 'address',
          'label' => 'LBL_SHIPPING_ADDRESS',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'shipping_address_street',
              'css_class' => 'address_street',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_STREET',
            ),
            1 => 
            array (
              'name' => 'shipping_address_city',
              'css_class' => 'address_city',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_CITY',
            ),
            2 => 
            array (
              'name' => 'shipping_address_state',
              'css_class' => 'address_state',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_STATE',
            ),
            3 => 
            array (
              'name' => 'shipping_address_postalcode',
              'css_class' => 'address_zip',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_POSTALCODE',
            ),
            4 => 
            array (
              'name' => 'shipping_address_country',
              'css_class' => 'address_country',
              'placeholder' => 'LBL_SHIPPING_ADDRESS_COUNTRY',
            ),
            5 => 
            array (
              'name' => 'copy',
              'label' => 'NTC_COPY_BILLING_ADDRESS',
              'type' => 'copy',
              'mapping' => 
              array (
                'billing_address_street' => 'shipping_address_street',
                'billing_address_city' => 'shipping_address_city',
                'billing_address_state' => 'shipping_address_state',
                'billing_address_postalcode' => 'shipping_address_postalcode',
                'billing_address_country' => 'shipping_address_country',
              ),
            ),
          ),
        ),
        8 => 
        array (
          'name' => 'description',
          'span' => 12,
        ),
        9 => 
        array (
          'name' => 'tag',
          'span' => 12,
        ),
        10 => 
        array (
          'name' => 'is_escalated',
          'type' => 'badge',
          'badge_label' => 'LBL_ESCALATED',
          'warning_level' => 'important',
          'dismiss_label' => true,
          'span' => 12,
        ),
      ),
    ),
    2 => 
    array (
      'name' => 'panel_hidden',
      'label' => 'LBL_RECORD_SHOWMORE',
      'hide' => true,
      'columns' => 2,
      'labelsOnTop' => true,
      'placeholders' => true,
      'newTab' => false,
      'panelDefault' => 'collapsed',
      'fields' => 
      array (
        0 => 'assigned_user_name',
        1 => 'team_name',
        2 => 
        array (
          'name' => 'date_entered_by',
          'readonly' => true,
          'inline' => true,
          'type' => 'fieldset',
          'label' => 'LBL_DATE_ENTERED',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'date_entered',
            ),
            1 => 
            array (
              'type' => 'label',
              'default_value' => 'LBL_BY',
            ),
            2 => 
            array (
              'name' => 'created_by_name',
            ),
          ),
        ),
        3 => 
        array (
          'name' => 'date_modified_by',
          'readonly' => true,
          'inline' => true,
          'type' => 'fieldset',
          'label' => 'LBL_DATE_MODIFIED',
          'fields' => 
          array (
            0 => 
            array (
              'name' => 'date_modified',
            ),
            1 => 
            array (
              'type' => 'label',
              'default_value' => 'LBL_BY',
            ),
            2 => 
            array (
              'name' => 'modified_by_name',
            ),
          ),
        ),
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'useTabs' => false,
  ),
);