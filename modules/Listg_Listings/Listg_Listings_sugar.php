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
 * PLACE ANY CUSTOMIZATIONS IN Listg_Listings
 */


class Listg_Listings_sugar extends Basic {
    public $new_schema = true;
    public $module_dir = 'Listg_Listings';
    public $object_name = 'Listg_Listings';
    public $table_name = 'listg_listings';
    public $importable = true;
    public $team_id;
    public $team_set_id;
    public $acl_team_set_id;
    public $team_count;
    public $team_name;
    public $acl_team_names;
    public $team_link;
    public $team_count_link;
    public $teams;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $tag;
    public $tag_link;
    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $activities;
    public $following;
    public $following_link;
    public $my_favorite;
    public $favorite_link;
    public $locked_fields;
    public $locked_fields_link;
    public $abstract_number;
    public $acreage;
    public $arb_num;
    public $block;
    public $book;
    public $building;
    public $district;
    public $instr_num;
    public $lot;
    public $municipality;
    public $out_lot;
    public $page;
    public $parcel;
    public $part_attrb;
    public $phase;
    public $subdiv_name;
    public $tract;
    public $unit;
    public $sequence_attrb;
    public $tax_identifier;
    public $type_address_attrb;
    public $line1_address_attrb;
    public $city_address_attrb;
    public $state_address_attrb;
    public $zip_address_attrb;
    public $fips_address_attrb;
    public $name_address_attrb;
    public $county_code_address_attrb;
    public $country_address_attrb;
    public $legal_description;
    public $address_street;
    public $address;
    
    public function bean_implements($interface){
        switch($interface){
            case 'ACL': return true;
        }
        return false;
    }
    
}