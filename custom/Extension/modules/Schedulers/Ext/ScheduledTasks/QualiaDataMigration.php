<?php

array_push($job_strings, 'QualiaDataMigration');
require_once "custom/include/Helpers/QualiaApiHelper.php"; 

function QualiaDataMigration()
{
    $response = QualiaApiHelper::getApiData();
    global $app_list_strings;
    
    // $accounts = $response['Accounts']['data']['companyContacts'];
    // $accounts = $response['Accounts'][0]['data']['companyContacts'];
    // $lastModefiedOrders = $response['LastModifiedOrders']['data']['orders'];
    $authKey = $response['auth_key'];
    $url = $response['url'];

    // Get the list from $app_list_strings
    $acc_fields_mapping = $app_list_strings['acc_fields_mapping'];
    $orders_field_mapping = $app_list_strings['orders_field_mapping'];
    $properties_fields_mapping = $app_list_strings['properties_fields_mapping'];
    $contacts_fields_mapping = $app_list_strings['contacts_fields_mapping'];
    $loans_fields_mapping = $app_list_strings['loans_fields_mapping'];

    // mapAccountsData($accounts, $url, $authKey, $acc_fields_mapping);
    // mapOrdersData($lastModefiedOrders, $url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping);
    mapPaginatedOrdersData($url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping);
    echo "Testing...";

    return true;
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

                                                $rqPartyId = createRQPartyBean($orderBean, $contactBean, $qualiaContactType, 'Contacts');   

                                                // foreach($rqPartyIds as $rqPartyId) {
                                                    if ($contactBean->load_relationship('party_rq_party_contacts')) {
                                                        $contactBean->party_rq_party_contacts->add($rqPartyId);
                                                    }
                                                // }
                                                $rqPartyId = '';

                                                $contact_ids[$contactBean->id] = $contactBean->id;
                                                $contactBean = null;

                                            }
                                        }
                                    }

                                    $accountBean->save(); 
                                    $convertedString = str_replace('_', '', strtolower($accountBean->account_type));
                                    $rqPartyId = createRQPartyBean($orderBean, $accountBean, $accTypeMapping[$convertedString], 'Accounts');   

                                    // foreach($rqPartyIds as $rqPartyId) {
                                        if ($accountBean->load_relationship('party_rq_party_accounts')) {
                                            $accountBean->party_rq_party_accounts->add($rqPartyId);
                                        }
                                    // }
                                    $rqPartyId = '';
                                }
                            }
                        }
                    }
                }else if(isset($data['accounting'])  || $data['charges'] || $data['settlementStatement']) {
                    $qualia_id = $orderBean->order_number;
                    $financialInfoBean = qualiaBean('tk_financial_info', $qualia_id, 'tk_Financial_Info');
                    
                    foreach ($data['accounting'] as $acctField => $acctValue) {
                        if (isset($accounting_fields_mapping[$acctField]) && $financialInfoBean) {
                            $sugarField = $accounting_fields_mapping[$acctField];
                            mapfields($sugarField, $financialInfoBean, $acctValue);
                        }
                    }
                    $financialInfoBean->name = $qualia_id;
                    $financialInfoBean->save();
                }


                //For Properties
                if($orderfield == 'properties') {
                    mapAndSaveModuleData($orderval, 'Listg_Listings', $properties_fields_mapping, $orderBean);
                }

                // For Loans
                if($orderfield == 'loans') {
                    mapAndSaveModuleData($orderval, 'Loans_Loans', $loans_fields_mapping, $orderBean);
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


function mapPaginatedOrdersData($url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping)
{
    // mapping of Account Types
    $accTypeMapping = [
        'listingagency' => 'ListingAgencies',
        'lender' => 'Lenders',
        'underwriter' => 'Underwriters',
        'recordingoffice' => 'RecordingOffices',
        'taxauthority' => 'TaxAuthorities',
        'appraisalcompany' => 'AppraisalCompanies',
        'builder' => 'Builders',
        'creditcardcompany' => 'CreditCardCompanies',
        'exchangeaccommodator' => 'ExchangeAccommodators',
        'eeneralcontractor' => 'GeneralContractors',
        'gov.entity' => 'Gov.Entities',
        'hoa' => 'HOAs',
        'hoamanagementcompany' => 'HOAManagementCompanies',
        'homewarrantycompany' => 'HomeWarrantyCompanies',
        'insurancecompany' => 'InsuranceCompanies',
        'lawfirm' => 'LawFirms',
        'notary' => 'Notaries',
        'payofflender' => 'PayoffLenders',
        'pesinspector' => 'PesInspectors',
        'realestateagency' => 'RealEstateAgencies',
        'releasetracker' => 'ReleaseTrackers',
        'reomanagementcompany' => 'REOManagementCompanies',
        'taxassessor' => 'TaxAssessors',
        'utilitycompany' => 'UtilityCompanies',
        'appprovider' => 'AppProviders',
        'othercompany' => 'OtherCompanies'
    ];

    global $db;
    $limit = 5;
    $cursor = "";
    $execute = true;

    while ($execute) {
        $result = QualiaApiHelper::getPaginatedOrdersData($url, $authKey, $limit, $cursor);
        $orders = $result['data']['ordersList']['edges'];
        $ordersCount = count($orders);
        $count = 0;

        if ($ordersCount < $limit) {
            $execute = false;
        }

        foreach ($orders as $order) {
            $count++;

            // Update the cursor
            if ($ordersCount == $count) {
                $cursor = $order['cursor'];
            }

            $data = $order['node'];
            if ($data) {
                $qualia_id = $data['id'];
                $orderBean = qualiaBean('order_rq_order', $qualia_id, 'Order_RQ_Order');

                // Process order fields
                foreach ($data as $orderfield => $orderval) {
                    if (isset($orders_field_mapping[$orderfield]) && $orderBean) {
                        $sugarField = $orders_field_mapping[$orderfield];
                        mapfields($sugarField, $orderBean, $orderval);
                    }
                }

                $orderBean->save();

                // Process contacts and associated accounts
                if (isset($data['contacts'])) {
                    foreach ($data['contacts'] as $qualiaContactType => $index) {
                        if (!empty($index)) {
                            foreach ($index as $type) {
                                foreach ($type as $key => $accField) {
                                    if($qualiaContactType === 'borrowers' || $qualiaContactType === 'sellers') {
                                        if ($key == 'ssn' && !empty($accField)) {
                                            // Remove hyphens and store each value in an array
                                            $orderId = explode('-', $orderBean->id);
                                            // Now, you can access each value using the array indices
                                            $firstPartOrder = $orderId[0];
                                            $secondPartOrder = $orderId[1];
                                            $ssn = explode('-', $accField);
                                            $firstPartSsn = $ssn[0];
                                            $secondPartSsn = $ssn[1]; 

                                            $newUniqueCode =  $firstPartOrder .'_'. $firstPartSsn .'_'. $secondPartOrder .'_'. $secondPartSsn . '_' . $qualiaContactType;
                                            $contactBean = qualiaBean('contacts', $newUniqueCode, 'Contacts');
                                        }

                                        if ($key !== 'ssn' && isset($contacts_fields_mapping[$key]) && $contactBean) {
                                            $sugarField = $contacts_fields_mapping[$key];
                                            mapfields($sugarField, $contactBean, $accField);
                                            $contactBean->unique_code = $newUniqueCode;
                                        }
                                        
                                    }else if ($qualiaContactType === 'sourceOfBusiness' && $key === 'company') {
                                        foreach ($accField as $key => $field) {
                                            if ($key === 'id' && !empty($field)) {
                                                $accounts_qualia_id = $field;
                                                $accountBean = qualiaBean('accounts', $accounts_qualia_id, 'Accounts');
                                            }
                                            if (isset($acc_fields_mapping[$key]) && $accountBean) {
                                                $sugarField = $acc_fields_mapping[$key];
                                                mapfields($sugarField, $accountBean, $accField);
                                            }
                                        }
                                    }else {
                                        if ($key === 'id' && !empty($accField)) {
                                            $accounts_qualia_id = $accField;
                                            $accountBean = qualiaBean('accounts', $accounts_qualia_id, 'Accounts');
                                        }
                                        if (isset($acc_fields_mapping[$key]) && $accountBean) {
                                            $sugarField = $acc_fields_mapping[$key];
                                            mapfields($sugarField, $accountBean, $accField);
                                        }
                                    }
                    
                                    if ($key === 'associates') {
                                        foreach ($accField as $contact) {
                                            foreach ($contact as $field => $val) {
                                                if ($field === 'id' && !empty($val)) {
                                                    $contacts_qualia_id = $val;
                                                    $contactBean = qualiaBean('contacts', $contacts_qualia_id, 'Contacts');
                                                }
                                                if (isset($contacts_fields_mapping[$field]) && $contactBean) {
                                                    $sugarField = $contacts_fields_mapping[$field];
                                                    mapfields($sugarField, $contactBean, $val);
                                                }
                                            }

                                            if(!empty($contactBean)){
                                                $contactBean->save();

                                                if ($contactBean->load_relationship('contact_linked_orders')) {
                                                    $contactBean->contact_linked_orders->add($orderBean->id);
                                                }

                                                if ($orderBean->load_relationship('order_linked_contacts')) {
                                                    $orderBean->order_linked_contacts->add($contactBean->id);
                                                }
                                                
                                                createRQPartyBean($orderBean, $contactBean, $qualiaContactType, 'Contacts');
                                                $contactBean = null;
                                            }
                                        }
                                    }
                                }

                                if(!empty($accountBean)){
                                    $accountBean->save(); 

                                    $convertedString = str_replace('_', '', strtolower($accountBean->account_type));
                                    createRQPartyBean($orderBean, $accountBean, $accTypeMapping[$convertedString], 'Accounts');   
                                    
                                    if ($accountBean->load_relationship('order_rq_order_accounts')) {
                                        $accountBean->order_rq_order_accounts->add($orderBean->id);
                                    }
                                }

                                if(!empty($contactBean)) {
                                    if (empty($contactBean->name)) {
                                        $contactBean->name = $contactBean->first_name . ' ' . $contactBean->last_name;
                                    }
                                    $contactBean->save();

                                    if ($contactBean->load_relationship('contact_linked_orders')) {
                                        $contactBean->contact_linked_orders->add($orderBean->id);
                                    }

                                    if ($orderBean->load_relationship('order_linked_contacts')) {
                                        $orderBean->order_linked_contacts->add($contactBean->id);
                                    }
                                    
                                    createRQPartyBean($orderBean, $contactBean, $qualiaContactType, 'Contacts');
                                    $contactBean = null;
                                }
                            }
                        }
                    }
                }

                // Process Properties
                if (isset($data['properties'])) {
                    mapAndSaveModuleData($data['properties'], 'Listg_Listings', $properties_fields_mapping, $orderBean);
                }

                // Process Loans
                if (isset($data['loans'])) {
                    mapAndSaveModuleData($data['loans'], 'Loans_Loans', $loans_fields_mapping, $orderBean);
                }
            }
        }
    }
}

/** 
 * Creates a Party_RQ_Party bean associated with the provided bean.
 * 
 * @param $orderBean The associated order bean.
 * @param $bean The source bean.
 * @param $RQ_PartyType The type of Party_RQ_Party.
 * @param $mod The module name.
 */
function createRQPartyBean($orderBean, $bean, $RQ_PartyType, $mod) {
    global $db;

    $stmt = "SELECT id 
    FROM party_rq_party
    WHERE parent_id = '{$bean->id}' and deleted = 0";
    $result = $db->fetchOne($stmt);

    if(!$result){
        // Create a new Party_RQ_Party bean
        $rqPartyBean = BeanFactory::newBean('Party_RQ_Party');

        // Set properties for Party_RQ_Party
        if ($rqPartyBean) {
            $rqPartyBean->party_type = ucfirst($RQ_PartyType);
            $rqPartyBean->name = $bean->name;
            if (empty($rqPartyBean->name)) {
                $rqPartyBean->name = $bean->first_name . ' ' . $bean->last_name;
            }
            $rqPartyBean->parent_id = $bean->id;
        }

        // Save the Party_RQ_Party bean
        $rqPartyBean->save();

        // Update the parent_type in the database
        $stmt = "UPDATE party_rq_party
            SET parent_type = '" . $mod . "'
            WHERE id = '" . $rqPartyBean->id . "'
            AND deleted = 0;";
        $db->query($stmt);

        // Link the order to the Party_RQ_Party relationship
        if ($orderBean->load_relationship('party_rq_party_order_rq_order')) {
            $orderBean->party_rq_party_order_rq_order->add($rqPartyBean->id);
        }

        // Release memory by setting the Party_RQ_Party bean to null
        $rqPartyBean = null;
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
    $dateFields = ['estimated_closing', 'opened_date_for_order_c', 'birthdate'];

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
                                if(!empty($val[$subField])){
                                    $bean->$subSugarField = $val[$subField];
                                }
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
        if(in_array($sugarField, $dateFields)){
            $value = date(TimeDate::DB_DATE_FORMAT, $value/1000);
        }
        $bean->{$sugarField} = $value;
    }
}

/**
 * Map and save data from fields to a SugarBean in a loans and properties module.
 *
 * @param array $fields The data fields to map and save.
 * @param string $module The module name.
 * @param array $fields_mapping The mapping of fields between source and SugarBean.
 * @param SugarBean $orderBean The associated order bean.
 */
function mapAndSaveModuleData($fields, $module, $fields_mapping, $orderBean) {
    foreach ($fields as $fieldData) {

        // Filter out null values from the field data
        $filteredFieldData = array_filter($fieldData, function ($value) {
            return $value !== null;
        });
        
        if ($module == 'Loans_Loans') {
            $qualia_id = !empty($filteredFieldData['loanNumber'])? $filteredFieldData['loanNumber'] : $fieldData['loanNumber']; //loanNumber is used as Qualia Id in case of loans
            $rqPartyType = 'Loan'; // Link loans to the RQ_Party
        } elseif ($module == 'Listg_Listings') {
            $qualia_id = !empty($filteredFieldData)? $filteredFieldData : $fieldData;
            $rqPartyType = 'Property'; // Link properties to the RQ_Party
        }

        $moduleBean = qualiaBean(strtolower($module), $qualia_id, $module);
        
        // Map filtered values to corresponding fields in the SugarBean
        foreach ($filteredFieldData as $sourceField => $value) {
            if (isset($fields_mapping[$sourceField]) && $moduleBean) {
                $sugarField = $fields_mapping[$sourceField];
                mapfields($sugarField, $moduleBean, $value);
                if ($module == 'Listg_Listings' && $sugarField == 'address' && !empty($moduleBean->$sugarField)) {
                    $moduleBean->name = $moduleBean->$sugarField;
                }
            }
        };

        $moduleBean->save();

        $partyRelationship = strtolower(str_replace('_', '', $module)) . '_order_rq_order';
        if ($moduleBean->load_relationship($partyRelationship)) {
            $moduleBean->$partyRelationship->add($orderBean->id);
        }

        createRQPartyBean($orderBean, $moduleBean, $rqPartyType, $module);

        $moduleBean = null; // Release memory by setting the SugarBean to null
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

    if($module == 'Loans_Loans') {
        $stmt = "SELECT id FROM $table where loan_number = '{$qualia_id}' and deleted = 0";
    }else if($module == 'Listg_Listings') {
        $stmt = "SELECT id FROM $table where address = '{$qualia_id['address1']}' AND zip_code = '{$qualia_id['zipcode']}' AND city = '{$qualia_id['city']}' AND deleted = 0;";
    }else if($module == 'Contacts' && (strpos($qualia_id, 'borrowers') !== false || strpos($qualia_id, 'sellers') !== false)) {
        $stmt = "SELECT id FROM $table where unique_code = '{$qualia_id}' and deleted = 0";
    }else if($module == 'tk_Financial_Info') {
        $stmt = "SELECT id FROM $table where order_number = '{$qualia_id}' and deleted = 0";
    }
    else {
        $stmt = "SELECT id FROM  $table  where qualia_id = '{$qualia_id}' and deleted = 0";
    }

    $result = $db->query($stmt);
    $data = $db->fetchByAssoc($result);

    $bean = !empty($data['id']) ? BeanFactory::getBean($module, $data['id']) : BeanFactory::newBean($module); // Create or retrieve the bean

    return $bean;
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
