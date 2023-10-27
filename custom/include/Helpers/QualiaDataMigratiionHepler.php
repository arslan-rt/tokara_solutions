<?php

class QualiaDataMigratiionHepler {

    /** 
     * Creates a Party_RQ_Party bean associated with the provided bean.
     * 
     * @param $orderBean The associated order bean.
     * @param $bean The source bean.
     * @param $RQ_PartyType The type of Party_RQ_Party.
     * @param $mod The module name.
     */
    public static function createRQPartyBean($orderBean, $bean, $RQ_PartyType, $mod) {
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
    public static function mapfields($sugarField, $bean, $value){
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
                                    if(!empty($value[$f])) {
                                        $bean->$subSugarField .= ' ' . $value[$f];
                                    }
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
    public static function mapAndSaveModuleData($fields, $module, $fields_mapping, $orderBean) {
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

            $moduleBean = self::qualiaBean(strtolower($module), $qualia_id, $module);
            
            // Map filtered values to corresponding fields in the SugarBean
            foreach ($filteredFieldData as $sourceField => $value) {
                if (isset($fields_mapping[$sourceField]) && $moduleBean) {
                    $sugarField = $fields_mapping[$sourceField];
                    self::mapfields($sugarField, $moduleBean, $value);
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

            self::createRQPartyBean($orderBean, $moduleBean, $rqPartyType, $module);

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
    public static function qualiaBean($table, $qualia_id, $module = '') {
        global $db;

        if($module == 'Loans_Loans') {
            $stmt = "SELECT id FROM $table where loan_number = '{$qualia_id}' and deleted = 0";
        }else if($module == 'Listg_Listings') {
            $stmt = "SELECT id FROM $table where address = '{$qualia_id['address1']}' AND zip_code = '{$qualia_id['zipcode']}' AND city = '{$qualia_id['city']}' AND deleted = 0;";
        }else if($module == 'Contacts' && (strpos($qualia_id, 'borrowers') !== false || strpos($qualia_id, 'sellers') !== false)) {
            $stmt = "SELECT id FROM $table where unique_code = '{$qualia_id}' and deleted = 0";
        }else if($module == 'tk_Financial_Info') {
            $stmt = "SELECT id FROM $table where order_number = '{$qualia_id}' and deleted = 0";
        }else if($module == 'tk_Charges') {
            $stmt = "SELECT id FROM $table where line_number = '{$qualia_id['lineNumber']}' AND section = '{$qualia_id['section']}' AND payee_name = '{$qualia_id['payeeName']}' AND  description = '{$qualia_id['description']}' AND deleted = 0";
        }else if($module == 'tk_SettlementStatementLines') {
            $stmt = "SELECT id FROM $table where payee_name_settlement = '{$qualia_id['payeeName']}' AND  description = '{$qualia_id['description']}' AND  borrower_amount = '{$qualia_id['borrowerAmount']}' AND  seller_amount = '{$qualia_id['sellerAmount']}' AND deleted = 0";
        }else {
            $stmt = "SELECT id FROM  $table  where qualia_id = '{$qualia_id}' and deleted = 0";
        }

        $result = $db->query($stmt);
        $data = $db->fetchByAssoc($result);

        $bean = !empty($data['id']) ? BeanFactory::getBean($module, $data['id']) : BeanFactory::newBean($module); // Create or retrieve the bean

        return $bean;
    }

}
