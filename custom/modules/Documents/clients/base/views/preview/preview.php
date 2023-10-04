<?php
$viewdefs['Documents'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'preview' => 
      array (
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
              1 => 
              array (
                'name' => 'document_name',
                'type' => 'name',
                'label' => 'LBL_NAME',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'placeholders' => true,
            'fields' => 
            array (
              0 => 'filename',
              1 => 'doc_type',
              2 => 
              array (
                'name' => 'tag',
                'span' => 12,
              ),
              3 => 'status_id',
              4 => 'revision',
              5 => 'template_type',
              6 => 'is_template',
              7 => 'active_date',
              8 => 'category_id',
              9 => 'exp_date',
              10 => 'subcategory_id',
              11 => 
              array (
                'name' => 'description',
                'span' => 12,
              ),
              12 => 'assigned_user_name',
              13 => 'related_doc_name',
              14 => 'related_doc_rev_number',
              15 => 'team_name',
            ),
          ),
          2 => 
          array (
            'name' => 'panel_hidden',
            'label' => 'LBL_RECORD_SHOWMORE',
            'columns' => 2,
            'hide' => true,
            'placeholders' => true,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'date_modified_by',
                'readonly' => true,
                'inline' => true,
                'type' => 'fieldset',
                'label' => 'LBL_LAST_REV_CREATE_DATE',
                'fields' => 
                array (
                  0 => 
                  array (
                    'name' => 'last_rev_create_date',
                  ),
                  1 => 
                  array (
                    'type' => 'label',
                    'default_value' => 'LBL_BY',
                  ),
                  2 => 
                  array (
                    'name' => 'last_rev_created_name',
                  ),
                ),
              ),
            ),
          ),
        ),
        'templateMeta' => 
        array (
          'maxColumns' => 1,
        ),
      ),
    ),
  ),
);
