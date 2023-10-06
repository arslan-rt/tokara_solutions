<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once "custom/include/Helpers/QualiaApiHelper.php"; 



function getApiResponseMethod()
{
    echo "Testing...";
    $response = QualiaApiHelper::getApiData();
    global $app_list_strings;
    
    // $accounts = $response['Accounts']['data']['companyContacts'];
    $accounts = $response['Accounts'][0]['data']['companyContacts'];
    $lastModefiedOrders = $response['LastModifiedOrders']['data']['orders'];

    // Get the list from $app_list_strings
    $acc_fields_mapping = $app_list_strings['acc_fields_mapping'];
    $orders_field_mapping = $app_list_strings['orders_field_mapping'];
    $properties_fields_mapping = $app_list_strings['properties_fields_mapping'];
    $contacts_fields_mapping = $app_list_strings['contacts_fields_mapping'];
    $loans_fields_mapping = $app_list_strings['loans_fields_mapping'];

    mapAccountsData($accounts);
    mapOrdersData($lastModefiedOrders);
}

function mapOrdersData($lastModefiedOrders){
    foreach ($lastModefiedOrders as $orderId) {
        $orderData = QualiaApiHelper::getOrderRecordData($response['url'], $response['auth_key'],  $orderId); 

        if ($orderData) {
            $data = $orderData['data']['order'];
            $qualia_id = $data["id"];
            
            $orderTable = 'order_rq_order';
            $orderBean = qualiaBean($orderTable, $qualia_id, 'Order_RQ_Order');
            
            $rq_ids = [];
            $contact_ids = [];

            // Update order fields
            foreach ($data as $orderfield => $val) {
                $orderBean->{$orders_field_mapping[$orderfield]} = $val;
                if($orderfield == "orderNumber") {
                    $orderNum = $orderBean->order_number;
                }
                $orderBean->name = $orderNum;

                // all contacts
               if($orderfield == "contacts") {
                foreach($val as $qualiaContactType => $index) {
                    if(!empty($index)){
                        foreach($index as $contactFields) {
                            foreach($contactFields['associates'] as $contact) {
                                foreach($contact as $key1 => $val1) {
                                    if($key1 == "id" && !empty($val1)) {
                                        $contacts_qualia_id = $val1;
                                        $contactBean = qualiaBean($orderfield, $contacts_qualia_id, 'Contacts');
                                        if($contactBean) {
                                            $contactBean->{$contacts_fields_mapping[$key1]} = $val1;
                                        }else {
                                            return;
                                        }
                                    }
                                }

                                $contactBean->save();
                                        
                                $RQ_partyBean = BeanFactory::newBean('Party_RQ_Party');
                                if($RQ_partyBean) {
                                    $RQ_partyBean->party_type = ucfirst($qualiaContactType);
                                    $RQ_partyBean->name = $contactBean->first_name . ' ' . $contactBean->last_name;
                                    $RQ_partyBean->parent_id = $contactBean->id;
                                } else {
                                    return;
                                }
                                   
                                $RQ_partyBean->save();

                                $stmt = "UPDATE party_rq_party
                                SET    parent_type = 'Contacts'
                                WHERE  id = '". $RQ_partyBean->id ."'
                                        AND deleted = 0;";
                                $db->query($stmt);
                                
                                $rq_ids[$RQ_partyBean->id] = $RQ_partyBean->id;
                                $contact_ids[$contactBean->id] = $contactBean->id;
                                $contactBean = null;
                                $RQ_partyBean = null;
                            }
                        }
                    }
                }
            }

            //For Properties
            if($orderfield == 'properties') {
                mapModuledata ($val, 'Listg_Listings', $properties_fields_mapping, $orderBean);
            }

            // For Loans
            if($orderfield == 'loans') {
                mapModuledata ($val, 'Loans_Loans', $loans_fields_mapping, $orderBean);
            }

            // For Task
            // if($orderfield == 'tasks') {
                // mapModuledata ($val, 'Loans_Loans', $loans_fields_mapping, $orderBean);
            // }

            }

            $orderBean->save();
            
            foreach($rq_ids as $rq_id) {
                if ($orderBean->load_relationship('party_rq_party_order_rq_order')) {
                    $orderBean->party_rq_party_order_rq_order->add($rq_id);
                }
            }
    
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

function mapAccountsData($accounts) {
    $limit = 0;
    if($limit < 10 && count($accounts) > $limit) {
        foreach ($accounts as $accId) {
            $accFields = QualiaApiHelper::getAccRecordData($response['url'], $response['auth_key'], $accId); 
            $qualia_id = $accFields["data"]['companyContact']["id"];
            
            $accountsTable = 'accounts';
            $accBean = qualiaBean($accountsTable, $qualia_id, 'Accounts');

            // Update account fields
            foreach ($accFields["data"]['companyContact'] as $field => $val) {
                if (isset($acc_fields_mapping[$field])) {
                    $sugarField = $acc_fields_mapping[$field];
    
                    if (is_array($sugarField)) {
                        foreach ($sugarField as $subField => $subSugarField) {
                            if($accBean) {
                                if(!is_object($val) && !is_array($val)){
                                    $accBean->$subSugarField = $val;
                                }else {
                                    if (is_array($val) && is_null($val[$subField])) {
                                        if (strpos($subField, ":") !== FALSE) {
                                            $exp_arr = explode(":", $subField);
                                            $accBean->$subSugarField = '';
                                            foreach ($exp_arr as $f) {
                                                $accBean->$subSugarField .= ' ' . $val[$f];
                                            }
                                            $accBean->$subSugarField = trim($accBean->$subSugarField);
                                        } else {
                                            foreach ($val as $v) {
                                                $accBean->$subSugarField = $v[$subField];
                                            }
                                        }
                                    }else {
                                        if (isset($val[$subField])) {
                                            $accBean->$subSugarField = $val[$subField];
                                        }
                                    }
                                }
                            }else {
                                return;
                            }
                        }
                    } else {
                        $accBean->$sugarField = $val;
                    }
                }
            }
            // Save the account bean
            $accBean->save();
            $limit++;
        }
    } 
}

//for loans, properties
function mapModuledata ($fields, $module, $fields_mapping, $orderBean) {
    foreach($fields as $field) {
        $bean = BeanFactory::newBean($module);
        $filteredArray = array_filter($field, function ($value) {
            return $value !== null;
        });
        foreach($filteredArray as $key => $val) {
            $bean->{$fields_mapping[$key]} = $val;
        }
        $bean->name = $orderBean->order_number;
        $bean->save();
        $bean = null;
    }
}

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