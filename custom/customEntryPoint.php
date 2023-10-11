<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once "custom/include/Helpers/QualiaApiHelper.php"; 



function getApiResponseMethod()
{
   
    $response = QualiaApiHelper::getApiData();
    global $app_list_strings;
    
    // $accounts = $response['Accounts']['data']['companyContacts'];
    $accounts = $response['Accounts'][0]['data']['companyContacts'];
    $lastModefiedOrders = $response['LastModifiedOrders']['data']['orders'];
    $authKey = $response['auth_key'];
    $url = $response['url'];

    // Get the list from $app_list_strings
    $acc_fields_mapping = $app_list_strings['acc_fields_mapping'];
    $orders_field_mapping = $app_list_strings['orders_field_mapping'];
    $properties_fields_mapping = $app_list_strings['properties_fields_mapping'];
    $contacts_fields_mapping = $app_list_strings['contacts_fields_mapping'];
    $loans_fields_mapping = $app_list_strings['loans_fields_mapping'];

    // mapAccountsData($accounts, $url, $authKey, $acc_fields_mapping);
    mapOrdersData($lastModefiedOrders, $url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping);
    echo "Testing...";
}


function mapOrdersData($lastModefiedOrders, $url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping){
    global $db;

    // mapping of Account Types
    $accTypeMapping = [
        'listingagency' => 'ListingAgencies',
        'lender' => 'Lenders',
        'underwriter' => 'Underwriters',
        'recordingoffice' => 'RecordingOffices',
        'taxauthority' => 'TaxAuthorities'
    ];

    foreach ($lastModefiedOrders as $orderId) {

        $orderData = QualiaApiHelper::getOrderRecordData($url, $authKey,  $orderId); 

        if ($orderData) {
            $data = $orderData['data']['order'];
            $qualia_id = $data["id"];
            
            $orderTable = 'order_rq_order';
            $orderBean = qualiaBean($orderTable, $qualia_id, 'Order_RQ_Order');
            
            
            $contact_ids = [];

            // Update order fields
            foreach ($data as $orderfield => $orderval) {
                if (isset($orders_field_mapping[$orderfield]) && $orderBean) {
                    $sugarField = $orders_field_mapping[$orderfield];
                    mapfields($sugarField, $orderBean, $orderval);
                }

                if($orderfield == "orderNumber") {
                    $orderNum = $orderBean->order_number;
                }
                $orderBean->name = $orderNum;

                // all contacts and associated accounts
                if($orderfield == "contacts") {
                    foreach($orderval as $qualiaContactType => $index) {
                        if($qualiaContactType !== "borrowers" && $qualiaContactType !== "sellers") {
                            if(!empty($index)){
                                foreach($index as $type) {
                                    foreach($type as $key => $accField) {
                                        if($qualiaContactType == "sourceOfBusiness" && $key == "company") {
                                            foreach($accField as $key => $field) {
                                                if($key == "id" && !empty($field)) {
                                                    $accounts = 'accounts';
                                                    $accounts_qualia_id = $field;
                                                    $accountBean = qualiaBean($accounts, $field, 'Accounts');       
                                                }
                                                if (isset($acc_fields_mapping[$key]) && $accountBean) {
                                                    $sugarField = $acc_fields_mapping[$key];
                                                    mapfields($sugarField, $accountBean, $accField);
                                                }
                                            }
                                        }else {
                                            if($key == "id" && !empty($accField)) {
                                                $accounts = 'accounts';
                                                $accounts_qualia_id = $accField;
                                                $accountBean = qualiaBean($accounts, $accField, 'Accounts');       
                                            }
                                            if (isset($acc_fields_mapping[$key]) && $accountBean) {
                                                $sugarField = $acc_fields_mapping[$key];
                                                mapfields($sugarField, $accountBean, $accField);
                                            }                                        
                                        }
                                    
                                        if($key == "associates") {
                                            foreach($accField as $contact) {
                                                foreach($contact as $field => $val) {
                                                    if($field == "id" && !empty($val)) {
                                                        $contacts_qualia_id = $val;
                                                        $contactBean = qualiaBean($orderfield, $contacts_qualia_id, 'Contacts');
                                                    }
                                                    if (isset($contacts_fields_mapping[$field]) && $contactBean) {
                                                        $sugarField = $contacts_fields_mapping[$field];
                                                        mapfields($sugarField, $contactBean, $val);
                                                    }
                                                    
                                                }
            
                                                $contactBean->save();

                                                $rq_id = createRQ_PartyBean($orderBean, $contactBean, $qualiaContactType, 'Contacts');   

                                                // foreach($rq_ids as $rq_id) {
                                                    if ($contactBean->load_relationship('party_rq_party_contacts')) {
                                                        $contactBean->party_rq_party_contacts->add($rq_id);
                                                    }
                                                // }
                                                $rq_id = '';

                                                $contact_ids[$contactBean->id] = $contactBean->id;
                                                $contactBean = null;

                                            }
                                        }
                                    }

                                    $accountBean->save(); 
                                    $convertedString = str_replace('_', '', strtolower($accountBean->account_type));
                                    $rq_id = createRQ_PartyBean($orderBean, $accountBean, $accTypeMapping[$convertedString], 'Accounts');   

                                    // foreach($rq_ids as $rq_id) {
                                        if ($accountBean->load_relationship('party_rq_party_accounts')) {
                                            $accountBean->party_rq_party_accounts->add($rq_id);
                                        }
                                    // }
                                    $rq_id = '';
                                }
                            }
                        }
                    }
                }

                //For Properties
                if($orderfield == 'properties') {
                    mapModuledata($orderval, 'Listg_Listings', $properties_fields_mapping, $orderBean);
                }

                // For Loans
                if($orderfield == 'loans') {
                    mapModuledata($orderval, 'Loans_Loans', $loans_fields_mapping, $orderBean);
                }
            }

            $orderBean->save();

            foreach($contact_ids as $contact_id) {
                if ($orderBean->load_relationship('order_linked_contacts')) {
                    $orderBean->order_linked_contacts->add($contact_id);
                }

                if ($orderBean->load_relationship('contact_linked_orders')) {
                    $orderBean->contact_linked_orders->add($contact_id);
                }
            } 
        }
    } 

}

/**
 * Create and save a Party_RQ_Party bean associated with an order.
 *
 * @param SugarBean $orderBean    The order SugarBean.
 * @param SugarBean $bean         The bean associated with the party.
 * @param string    $RQ_PartyType The type of Party_RQ_Party.
 * @param string    $mod          The parent type for Party_RQ_Party.
 *
 * @return string The ID of the created Party_RQ_Party bean.
 */
function createRQ_PartyBean($orderBean, $bean, $RQ_PartyType, $mod) {
    global $db;
    $rq_id = '';

    // Create a new Party_RQ_Party bean
    $RQ_partyBean = BeanFactory::newBean('Party_RQ_Party');

    // Update the parent_type in the database
    if($RQ_partyBean) {
        // Set properties for Party_RQ_Party
        $RQ_partyBean->party_type = ucfirst($RQ_PartyType);
        $RQ_partyBean->name = $bean->name;  
        if(empty($RQ_partyBean->name)) {
            $RQ_partyBean->name = $bean->first_name . ' ' . $bean->last_name;
        }
        $RQ_partyBean->parent_id = $bean->id;
    }
    
    // Save the Party_RQ_Party bean
    $RQ_partyBean->save();

    // Update the parent_type in the database
    $stmt = "UPDATE party_rq_party
    SET    parent_type = '". $mod ."'
    WHERE  id = '". $RQ_partyBean->id ."'
            AND deleted = 0;";
    $db->query($stmt);
 
    // Get the ID of the Party_RQ_Party bean
    $rq_id = $RQ_partyBean->id;

    // Link the order to the RQ_Party relationship 
    if ($orderBean->load_relationship('party_rq_party_order_rq_order')) {
        $orderBean->party_rq_party_order_rq_order->add($rq_id);
    }

    // Release memory by setting the Party_RQ_Party bean to null
    $RQ_partyBean = null;
    return $rq_id;
}

/**
 * Map and save account data from Qualia API to SugarCRM.
 *
 * @param array  $accounts          Array of account IDs from Qualia API.
 * @param string $url               Qualia API URL.
 * @param string $authKey           Authentication key for Qualia API.
 * @param array  $acc_fields_mapping Mapping of fields between Qualia API and SugarCRM.
 */
function mapAccountsData($accounts, $url, $authKey, $acc_fields_mapping) {
    $limit = 0;
    if($limit < 10 && count($accounts) > $limit) {
        foreach ($accounts as $accId) {
            // Retrieve account data from Qualia API
            $accFields = QualiaApiHelper::getAccRecordData($url, $authKey, $accId); 
            $qualia_id = $accFields["data"]["companyContact"]["id"];
            
            // Define the SugarCRM accounts table
            $accountsTable = 'accounts';
            // Get or create the SugarBean for the account
            $accBean = qualiaBean($accountsTable, $qualia_id, 'Accounts');

            // Update account fields based on the mapping
            foreach ($accFields["data"]['companyContact'] as $field => $val) {
                if (isset($acc_fields_mapping[$field])) {
                    $sugarField = $acc_fields_mapping[$field];
                    mapfields($sugarField, $accBean, $val);
                }
            }
            
            // Save the account bean
            $accBean->save();
            $limit++;  
            if (isset($acc_fields_mapping[$field])) {
                    $sugarField = $acc_fields_mapping[$field];
                    mapfields($sugarField, $accBean, $val);
            }
        }
    } 
}

/**
 * Map and set values to SugarBean fields based on the provided mappings.
 *
 * @param string|array $sugarField  The name of the SugarBean field or an array of subfields.
 * @param SugarBean    $bean        The SugarBean instance.
 * @param mixed        $value       The value to set in the SugarBean field.
 */
function mapfields($sugarField, $bean, $value){
    // Check if $sugarField is an array (subfields)
    if (is_array($sugarField)) {
        foreach ($sugarField as $subField => $subSugarField) {
            // Check if $bean is not null
            if($bean) {
                // Check if $value is not an object or array
                if(!is_object($value) && !is_array($value)){
                    $bean->$subSugarField = $value;
                }else {
                    // Check if $value is an array and $value[$subField] is null
                    if (is_array($value) && is_null($value[$subField])) {
                        // Handle special case when $subField contains ":"
                        if (strpos($subField, ":") !== FALSE) {
                            $exp_arr = explode(":", $subField);
                            $bean->$subSugarField = '';
                            foreach ($exp_arr as $f) {
                                $bean->$subSugarField .= ' ' . $value[$f];
                            }
                            $bean->$subSugarField = trim($bean->$subSugarField);
                        } else {
                            // Loop through $value and set subSugarField for each entry
                            foreach ($value as $val) {
                                $bean->$subSugarField = $val[$subField];
                            }
                        }
                    }else {
                        // Check if $value[$subField] is set, then set subSugarField
                        if (isset($value[$subField])) {
                            $bean->$subSugarField = $value[$subField];
                        }
                    }
                }
            }else {
                return;
            }
        }
    } else {
        // $sugarField is not an array, set the value directly
        $bean->{$sugarField} = $value;
    }
}

/**
 * Map and save data from fields to a SugarBean in a loans and properties module.
 *
 * @param array       $fields         The array of fields to map.
 * @param string      $module         The module name associated with the SugarBean.
 * @param array       $fields_mapping The mapping of fields between the external data and SugarBean.
 * @param SugarBean   $orderBean      The SugarBean instance related to the order for additional data.
 */
function mapModuledata($fields, $module, $fields_mapping, $orderBean) {
    foreach($fields as $field) {
         // Create a new SugarBean instance for the specified module
        $bean = BeanFactory::newBean($module);

        // Filter out null values from the field array
        $filteredArray = array_filter($field, function ($value) {
            return $value !== null;
        });

        // Map filtered values to corresponding fields in the SugarBean
        foreach($filteredArray as $key => $val) {
            if (isset($fields_mapping[$key])) {
                $sugarField = $fields_mapping[$key];
                mapfields($sugarField, $bean, $val);
            }
        }

        $bean->name = $orderBean->order_number;
        $bean->save();

        // Link loans and properties to the RQ_Party
        if($module == 'Loans_Loans') {
            $rq_id = createRQ_PartyBean($orderBean, $bean, 'Loan', 'Loans_Loans');  
            if ($bean->load_relationship('party_rq_party_loans_loans')) {
                $bean->party_rq_party_loans_loans->add($rq_id);
            }
        }else {
            $rq_id = createRQ_PartyBean($orderBean, $bean, 'Property', 'Listg_Listings');
            if ($bean->load_relationship('party_rq_party_listg_listings')) {
                $bean->party_rq_party_listg_listings->add($rq_id);
            }
        }

        $bean = null;
        $rq_id = '';
    }
}

/**
 * Retrieve or create a SugarBean based on the provided qualia_id and module.
 *
 * @param string $table   The SugarCRM table associated with the SugarBean.
 * @param string $qualia_id  The qualia_id used to identify the record.
 * @param string $module  The module name associated with the SugarBean.
 *
 * @return SugarBean  The retrieved or new SugarBean.
 */
function qualiaBean($table, $qualia_id, $module = '') {
    global $db;

    // Use a prepared statement to fetch the record ID
    $stmt = "SELECT id FROM  $table  where qualia_id = '". $qualia_id . "' and deleted = 0";
    $id = $db->getOne($stmt);
    
    // Create or retrieve the bean
    $bean = !empty($id) ? BeanFactory::getBean($module, $id) : BeanFactory::newBean($module);

    return $bean;
}

getApiResponseMethod();