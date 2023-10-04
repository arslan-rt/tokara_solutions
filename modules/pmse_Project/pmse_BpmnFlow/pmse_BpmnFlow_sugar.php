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

/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN pmse_BpmnFlow
 */
class pmse_BpmnFlow_sugar extends Basic {
	var $new_schema = true;
	var $module_dir = 'pmse_Project/pmse_BpmnFlow';
    public $module_name = 'pmse_BpmnFlow';
	var $object_name = 'pmse_BpmnFlow';
	var $table_name = 'pmse_bpmn_flow';
	var $importable = false;
    var $disable_custom_fields = true;
    var $id;
    var $name;
    var $date_entered;
    var $date_modified;
    var $modified_user_id;
    var $modified_by_name;
    var $created_by;
    var $created_by_name;
    var $description;
    var $deleted;
    var $created_by_link;
    var $modified_user_link;
    var $activities;
    var $assigned_user_id;
    var $assigned_user_name;
    var $assigned_user_link;
    var $flo_uid;
    var $prj_id;
    var $dia_id;
    var $flo_type;
    var $flo_element_origin;
    var $flo_element_origin_type;
    var $flo_element_origin_port;
    var $flo_element_dest;
    var $flo_element_dest_type;
    var $flo_element_dest_port;
    var $flo_is_inmediate;
    var $flo_condition;
    var $flo_eval_priority;
    var $flo_x1;
    var $flo_y1;
    var $flo_x2;
    var $flo_y2;
    var $flo_state;


	public function __construct(){
		parent::__construct();
	}
}
