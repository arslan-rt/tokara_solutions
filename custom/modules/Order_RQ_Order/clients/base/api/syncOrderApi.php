<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

require_once "custom/include/Helpers/QualiaApiHelper.php"; 
require_once "custom/include/Helpers/QualiaDataMigratiionHepler.php";

class syncOrderApi extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            'DataRetrieve' => array(
                //request type
                'reqType' => 'GET',
                //endpoint path
                'path' => array(
                    'GetOrder',
                    '?',
                ),
                //endpoint variables
                'pathVars' => array(
                    '',
                    'order_id',
                ),
                //method to call
                'method' => 'syncOrderData',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'It will get order id and sync data against this order.',
                //long help to be displayed in the help documentation
                'longHelp' => ''
            )
        );
    }

    /**
     * Method to be used for Data syncing
     */
    public function syncOrderData($api, $args)
    {
        $GLOBALS['log']->fatal('order ID: ', $args['order_id']);

        $response = QualiaApiHelper::getApiData();
        global $app_list_strings;
        
        $authKey = $response['auth_key'];
        $url = $response['url'];

        // Get the list from $app_list_strings
        $acc_fields_mapping = $app_list_strings['acc_fields_mapping'];
        $orders_field_mapping = $app_list_strings['orders_field_mapping'];
        $properties_fields_mapping = $app_list_strings['properties_fields_mapping'];
        $contacts_fields_mapping = $app_list_strings['contacts_fields_mapping'];
        $loans_fields_mapping = $app_list_strings['loans_fields_mapping'];
        $accounting_fields_mapping = $app_list_strings['accounting_fields_mapping'];
        $charges_fields_mapping = $app_list_strings['charges_fields_mapping'];
        $settlement_statement_fields_mapping = $app_list_strings['settlement_statement_fields_mapping'];

        $this->syncRelatedDataForOrder($args['order_id'], $url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping, $accounting_fields_mapping, $charges_fields_mapping, $settlement_statement_fields_mapping);
    }

    public function syncRelatedDataForOrder($id, $url, $authKey, $orders_field_mapping, $contacts_fields_mapping, $acc_fields_mapping, $loans_fields_mapping, $properties_fields_mapping, $accounting_fields_mapping, $charges_fields_mapping, $settlement_statement_fields_mapping) {
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
        $result = QualiaApiHelper::getOrderRecordData($url, $authKey, $id);
        $data = $result['data']['order'];

        if ($data) {
            $qualia_id = $id;
            $orderBean = QualiaDataMigratiionHepler::qualiaBean('order_rq_order', $qualia_id, 'Order_RQ_Order');

            // Process order fields
            foreach ($data as $orderfield => $orderval) {
                if (isset($orders_field_mapping[$orderfield]) && $orderBean) {
                    $sugarField = $orders_field_mapping[$orderfield];
                    QualiaDataMigratiionHepler::mapfields($sugarField, $orderBean, $orderval);
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
                                        $contactBean = QualiaDataMigratiionHepler::qualiaBean('contacts', $newUniqueCode, 'Contacts');
                                    }

                                    if ($key !== 'ssn' && isset($contacts_fields_mapping[$key]) && $contactBean) {
                                        $sugarField = $contacts_fields_mapping[$key];
                                        QualiaDataMigratiionHepler::mapfields($sugarField, $contactBean, $accField);
                                        $contactBean->unique_code = $newUniqueCode;
                                    }
                                    
                                }else if ($qualiaContactType === 'sourceOfBusiness' && $key === 'company' && $accField !== null) {
                                    foreach ($accField as $key => $field) {
                                        if ($key === 'id' && !empty($field)) {
                                            $accounts_qualia_id = $field;
                                            $accountBean = QualiaDataMigratiionHepler::qualiaBean('accounts', $accounts_qualia_id, 'Accounts');
                                        }
                                        if (isset($acc_fields_mapping[$key]) && $accountBean) {
                                            $sugarField = $acc_fields_mapping[$key];
                                            QualiaDataMigratiionHepler::mapfields($sugarField, $accountBean, $accField);
                                        }
                                    }
                                }else {
                                    if ($key === 'id' && !empty($accField)) {
                                        $accounts_qualia_id = $accField;
                                        $accountBean = QualiaDataMigratiionHepler::qualiaBean('accounts', $accounts_qualia_id, 'Accounts');
                                    }
                                    if (isset($acc_fields_mapping[$key]) && $accountBean) {
                                        $sugarField = $acc_fields_mapping[$key];
                                        QualiaDataMigratiionHepler::mapfields($sugarField, $accountBean, $accField);
                                    }
                                }
                
                                if ($key === 'associates') {
                                    foreach ($accField as $contact) {
                                        foreach ($contact as $field => $val) {
                                            if ($field === 'id' && !empty($val)) {
                                                $contacts_qualia_id = $val;
                                                $contactBean = QualiaDataMigratiionHepler::qualiaBean('contacts', $contacts_qualia_id, 'Contacts');
                                            }
                                            if (isset($contacts_fields_mapping[$field]) && $contactBean) {
                                                $sugarField = $contacts_fields_mapping[$field];
                                                QualiaDataMigratiionHepler::mapfields($sugarField, $contactBean, $val);
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
                                            
                                            QualiaDataMigratiionHepler::createRQPartyBean($orderBean, $contactBean, $qualiaContactType, 'Contacts');
                                            $contactBean = null;
                                        }
                                    }
                                }
                            }

                            if(!empty($accountBean)){
                                $accountBean->save(); 

                                $convertedString = str_replace('_', '', strtolower($accountBean->account_type));
                                QualiaDataMigratiionHepler::createRQPartyBean($orderBean, $accountBean, $accTypeMapping[$convertedString], 'Accounts');   
                                
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
                                
                                QualiaDataMigratiionHepler::createRQPartyBean($orderBean, $contactBean, $qualiaContactType, 'Contacts');
                                $contactBean = null;
                            }
                        }
                    }
                }
            }
            
            if($data['accounting'] || $data['charges'] || $data['settlementStatement']) {
                $qualia_id_FI = $orderBean->order_number;
                $financialInfoBean = QualiaDataMigratiionHepler::qualiaBean('tk_financial_info', $qualia_id_FI, 'tk_Financial_Info');
                
                if(!empty($data['accounting']['disbursements']) || !empty($data['accounting']['disbursementAccounts'])) {
                    foreach ($data['accounting'] as $acctField => $acctValue) {
                        if (isset($accounting_fields_mapping[$acctField]) && $financialInfoBean) {
                            $sugarField = $accounting_fields_mapping[$acctField];
                            QualiaDataMigratiionHepler::mapfields($sugarField, $financialInfoBean, $acctValue);
                        }
                    }
                }

                $financialInfoBean->order_number = $qualia_id_FI;
                $financialInfoBean->name = 'Financial Info - ' . $qualia_id_FI;
                $financialInfoBean->save();
                
                foreach ($data['charges'] as $chargesIndex) {
                    $chargesBean = QualiaDataMigratiionHepler::qualiaBean('tk_charges', $chargesIndex, 'tk_Charges');
                    $name_value = '';

                    foreach ($chargesIndex as $chargesField => $chargesValue) {
                        if (!is_array($chargesValue)) {
                            if (isset($charges_fields_mapping[$chargesField]) && $chargesBean) {
                                $sugarField = $charges_fields_mapping[$chargesField];
                                QualiaDataMigratiionHepler::mapfields($sugarField, $chargesBean, $chargesValue);
                            }
                        }
                     
                        if($chargesField == "section") {
                            $name_value .= ' - ' . $chargesBean->section;
                        }else if($chargesField == "payeeName") {
                            $name_value .= ' - ' . $chargesBean->payee_name;
                        }else if($chargesField == "lineNumber") {
                            $name_value .= ' - ' . $chargesBean->line_number;
                        }
                    }
                    
                    if($chargesBean->name == null &&  !empty($name_value)) {
                        $chargesBean->name = $qualia_id_FI . ' ' . $name_value;
                    }
            
                    $chargesBean->save();

                    $chargesRelationship = 'tk_financial_info_tk_charges_1';
                    if ($financialInfoBean->load_relationship($chargesRelationship)) {
                        $financialInfoBean->$chargesRelationship->add($chargesBean->id);
                    }
                    $chargesBean = null; 
                }

                foreach ($data['settlementStatement']['lines'] as $lines) {
                    $lineBean = QualiaDataMigratiionHepler::qualiaBean('tk_settlementstatementlines', $lines, 'tk_SettlementStatementLines');
                    
                    foreach ($lines as $lineField => $lineValue) {
                        if (isset($settlement_statement_fields_mapping[$lineField]) && $lineBean) {
                            $sugarField = $settlement_statement_fields_mapping[$lineField];
                            QualiaDataMigratiionHepler::mapfields($sugarField, $lineBean, $lineValue);
                        }
                    }
                    
                    if(preg_match('/^[0.]+$/', $lineBean->borrower_amount) && !preg_match('/^[0.]+$/', $lineBean->seller_amount)) {
                        $lineBean->name = $qualia_id_FI . ' - Seller -' . $lineBean->seller_amount;
                    }else if(!preg_match('/^[0.]+$/', $lineBean->borrower_amount) && preg_match('/^[0.]+$/', $lineBean->seller_amount)) {
                        $lineBean->name = $qualia_id_FI . ' - Borrower - ' . $lineBean->borrower_amount;
                    }else if(preg_match('/^[0.]+$/', $lineBean->borrower_amount) && preg_match('/^[0.]+$/', $lineBean->seller_amount)) {
                        $lineBean->name = $qualia_id_FI . ' - No Borrower OR Seller';
                    }else {
                        $lineBean->name = $qualia_id_FI . ' - No Borrower OR Seller';
                    }
                        
                    
                    $lineBean->save();

                    $linesRelationship = 'tk_financial_info_tk_settlementstatementlines_1';
                    if ($financialInfoBean->load_relationship($linesRelationship)) {
                        $financialInfoBean->$linesRelationship->add($lineBean->id);
                    }
                    
                    $lineBean = null;
                }

            }

            // Process Properties
            if (isset($data['properties'])) {
                QualiaDataMigratiionHepler::mapAndSaveModuleData($data['properties'], 'Listg_Listings', $properties_fields_mapping, $orderBean);
            }

            // Process Loans
            if (isset($data['loans'])) {
                QualiaDataMigratiionHepler::mapAndSaveModuleData($data['loans'], 'Loans_Loans', $loans_fields_mapping, $orderBean);
            }
        }

    }
}