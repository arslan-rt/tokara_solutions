<?php

use Sugarcrm\Sugarcrm\Security\HttpClient\ExternalResourceClient;
use Sugarcrm\Sugarcrm\Security\HttpClient\RequestException;

class QualiaApiHelper
{
    public static function getApiData()
    {
        if (!self::validateApiCreds()) {
            $response['error_message'] = 'Some Qualia Credentials are missing in the config. Please contact admin!';
            return $response;
        }else {
            $response = self::validateApiCreds();
        }

        $auth_key = $response['auth_key'];
        $url = $response['url'];

        // $response['Accounts'] = self::getModifiedAccIds($url, $auth_key);
        // $response['LastModifiedOrders'] = self::getLastModifiedOrders($url, $auth_key);
        
        return $response;
    }

    public static function validateApiCreds()
    {
        global $sugar_config;

        //get login API Params
        $auth_key = $sugar_config['additional_js_config']['autherization_creds']['auth_key'];
        $url = $sugar_config['additional_js_config']['autherization_creds']['url'];

        if (empty($auth_key) || empty($url)) {
            return false;
        }
        $response = array(
            'auth_key' => $auth_key,
            'url' => $url
        );
        return $response;
    }

    public static function getAccRecordData($url = '', $auth_key, $id)
    {
        try {
            $response = (new ExternalResourceClient())->post(
            $url,
             json_encode([
              'query' => 'query companyContacts($id: ID!) {
                companyContact(id: $id) {
                    id
                    name
                    email
                    phone
                    nationalLicenseID
                    stateLicenseIDs {
                        id
                    }
                    type
                    primaryAddress {
                        address1
                        address2
                        zipcode
                        city
                        state
                        county
                    }
                    mailingAddress {
                        address1
                        address2
                        zipcode
                        city
                        state
                        county
                    }
                }
            }',
                'variables' => [
                    'id' => $id
                ]
        ]),
            ['Authorization' => $auth_key,
            'Content-Type' => 'application/json']);
        } catch (RequestException $e) {
            throw new \SugarApiExceptionError($e->getMessage());
        }
        
        $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
        return $parsed;
    }

    public static function getAccountsIds($url = '', $auth_key, $method = 'POST')
    {
        try {
      
            $response = (new ExternalResourceClient())->post(
                $url,
            json_encode([
                'query' => 'query getCompaniesIds($input:CompaniesFilter){ companyContacts(filter:$input)}',
                'variables' => [
                    'operationName' => 'getCompaniesIds',
                    'variables' => [
                        'input' => ""
                    ]
                ]
            ]), 
            ['Authorization' => $auth_key,
            'Content-Type' => 'application/json']);
        } catch (RequestException $e) {
            throw new \SugarApiExceptionError($e->getMessage());
        }
        
        $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
        return $parsed;
    }

    public static function getModifiedAccIds($url = '', $auth_key, $method = 'POST')
    {
        try {
            $query = [
                'query' => 'query retrieveCompanyIdsChangedAfterLastTouched($input:CompaniesFilter){ companyContacts(filter:$input)}',
                'variables' => [
                    'operationName' => 'retrieveCompanyIdsChangedAfterLastTouched',
                    'input' => [
                        'lastTouched'=> [
                            'start'=> '2023-09-15T10:15:30Z',
                            'end'=> '2023-10-15T10:15:30Z'
                        ]
                    ]
                ]
            ];
            
            $response = (new ExternalResourceClient())->post($url, json_encode([$query]),
            ['Authorization' => $auth_key,
            'Content-Type' => 'application/json']);
        }
        catch (RequestException $e) {
            throw new \SugarApiExceptionError($e->getMessage());
        }
    
        $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
        return $parsed;
    }

    public static function getOrderRecordData($url = '', $auth_key, $id)
    {
        try {
            $response = (new ExternalResourceClient())->post(
            $url,
             json_encode([
                'query' => 'query orders($id: ID!) {
                    order(id: $id) {
                      id
                      createdDate
                      externalReferenceNumber
                      earnestAmount
                      estimatedClosing
                      orderNumber
                      purchasePrice
                      status
                      transactionType
                      contacts {
                        sourceOfBusiness {
                          ...SourceOfBusinessDetails
                        }
                        borrowers {
                          ...BorrowerOfSellerDetails
                        }
                        lenders {
                          ...CompanyDetails
                        }
                        listingAgencies {
                          ...CompanyDetails
                        }
                        mortgageBrokerages {
                          ...CompanyDetails
                        }
                        otherContacts {
                          ...CompanyDetails
                        }
                        recordingOffices {
                          ...CompanyDetails
                        }
                        sellers {
                          ...BorrowerOfSellerDetails
                        }
                        sellingAgencies {
                          ...CompanyDetails
                        }
                        settlementAgencies {
                          ...CompanyDetails
                        }
                        surveyingFirms {
                          ...CompanyDetails
                        }
                        taxAuthorities {
                          ...CompanyDetails
                        }
                        titleAbstractors {
                          ...CompanyDetails
                        }
                        titleCompanies {
                          ...CompanyDetails
                        }
                        underwriters {
                          ...CompanyDetails
                        }
                      }
                      accounting {
                        disbursements {
                          amount
                          payeeName
                          posted
                          voided
                        }
                        disbursementAccounts {
                          name
                        }
                        receipts {
                          amount
                          forBenefitOf
                          posted
                          receivedFrom
                          voided
                        }
                      }
                      closingLocation {
                        ...AddressDetails
                      }
                      appointments {
                        start
                        type
                        duration
                        eventName
                        guestInstructions
                        place {
                          address {
                            ...AddressDetails
                          }
                        }
                      }
                      charges {
                        section
                        lineNumber
                        description
                        borrowerAmount {
                          total
                        }
                        sellerAmount {
                          total
                        }
                        payeeName
                        payees {
                          type
                          amount
                          name
                          address {
                            address1
                            address2
                            zipcode
                            city
                            state
                            county
                          }
                          label
                        }
                      }
                      documents {
                        name
                        created
                      }
                      loans {
                        amount
                        interestRate
                        loanNumber
                      }
                      properties {
                        ...PropertyDetails
                      }
                      settlementStatement {
                        lines {
                          description
                          borrowerAmount
                          sellerAmount
                          payeeName
                        }
                      }
                      settlementTeam {
                        firstName
                        lastName
                        role
                        phone
                        fax
                        email
                        roleID
                        userID
                      }
                      settlementAgency {
                        id
                        name
                        branchName
                        email
                        phone
                        fax
                        addresses {
                          ...AddressDetails
                        }
                      }
                      tasks {
                        label
                        assigneeName
                        due
                        completed
                      }
                    }
                  }
                  
                  fragment CompanyDetails on Company {
                    ... on OrderCompany {
                      id
                      associates {
                        ...Associate
                      }
                      name
                      phone
                      fax
                      email
                      nationalLicenseID
                      stateLicenseIDs {
                        ...License
                      }
                      primaryAddress {
                        ...AddressDetails
                      }
                      mailingAddress {
                        ...AddressDetails
                      }
                      type
                    }
                  }
                  
                  fragment BorrowerOfSellerDetails on BorrowerSellerEntity {
                    ... on Organization {
                      name
                      currentAddress {
                        ...AddressDetails
                      }
                      email
                      forwardingAddress {
                        ...AddressDetails
                      }
                      type
                    }
                    ... on Individual {
                      ssn
                      cellPhone
                      currentAddress {
                        ...AddressDetails
                      }
                      dateOfBirth
                      email
                      firstName
                      forwardingAddress {
                        ...AddressDetails
                      }
                      lastName
                      maritalStatus
                    }
                    currentAddress {
                      ...AddressDetails
                    }
                    email
                    forwardingAddress {
                      ...AddressDetails
                    }
                  }
                  
                  fragment SourceOfBusinessDetails on SourceOfBusiness {
                    associates {
                      ...Associate
                    }
                    borrowerOrSeller {
                      ...BorrowerOfSellerDetails
                    }
                    company {
                      ...CompanyDetails
                    }
                    manualEntry
                    type
                    users {
                      id
                      email
                      firstName
                      jobTitle
                      lastName
                      middleName
                      phone
                      suffix
                    }
                  }
                  
                  fragment AddressDetails on Address {
                    address1
                    address2
                    zipcode
                    city
                    state
                    county
                  }
                  
                  fragment PropertyDetails on Property {
                    address1
                    address2
                    zipcode
                    city
                    state
                    county
                  }
                  
                  fragment Associate on OrderAssociate {
                    id
                    firstName
                    lastName
                    workPhone
                    cellPhone
                    email
                    jobTitle
                    nationalLicenseID
                    stateLicenseIDs {
                      ...License
                    }
                  }
                  
                  fragment License on StateLicense {
                    id
                    state
                  }',
                'variables' => [
                    "id" => $id
                ],
        ]),
            ['Authorization' => $auth_key,
            'Content-Type' => 'application/json']);
        } catch (RequestException $e) {
            throw new \SugarApiExceptionError($e->getMessage());
        }
        
        $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
        return $parsed;
    }

    
    public static function getLastModifiedOrders($url = '', $auth_key)
    {
        try {
      
            $response = (new ExternalResourceClient())->post(
            $url,
             json_encode([
                'query' => 'query retrieveOrderIdsChangedAfterLastSync($input:OrdersFilter){ orders(filter:$input)}',
                'variables' => [
                    'operationName' => 'retrieveOrderIdsChangedAfterLastSync',
                    
                    'input' => [
                        'lastActivity' => [
                            'start' =>  "2023-09-25T00:00:00Z"
                        ]
                    ]
                    
                ]
        ]),
            ['Authorization' => $auth_key,
            'Content-Type' => 'application/json']);
        } catch (RequestException $e) {
            throw new \SugarApiExceptionError($e->getMessage());
        }
        
        $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
        return $parsed;
    }

    public static function getPaginatedOrdersData($url = '', $auth_key, $limit, $cursor = '')
    {
        try {
            $response = (new ExternalResourceClient())->post(
              $url,
              json_encode([
                'query' => 'query orders($inputFirst: Int, $inputAfter: String, $inputLast: Int, $inputBefore: String, $filter:OrdersFilter){
                    ordersList(first:$inputFirst, after:$inputAfter, last:$inputLast, before:$inputBefore, filter:$filter) {
                      edges {
                        cursor
                        node {
                          id
                          createdDate
                          externalReferenceNumber
                          earnestAmount
                          estimatedClosing
                          orderNumber
                          purchasePrice
                          status
                          transactionType
                          contacts {
                            sourceOfBusiness {
                              ...SourceOfBusinessDetails
                            }
                            borrowers {
                              ...BorrowerOfSellerDetails
                            }
                            lenders {
                              ...CompanyDetails
                            }
                            listingAgencies {
                              ...CompanyDetails
                            }
                            mortgageBrokerages {
                              ...CompanyDetails
                            }
                            otherContacts {
                              ...CompanyDetails
                            }
                            recordingOffices {
                              ...CompanyDetails
                            }
                            sellers {
                              ...BorrowerOfSellerDetails
                            }
                            sellingAgencies {
                              ...CompanyDetails
                            }
                            settlementAgencies {
                              ...CompanyDetails
                            }
                            surveyingFirms {
                              ...CompanyDetails
                            }
                            taxAuthorities {
                              ...CompanyDetails
                            }
                            titleAbstractors {
                              ...CompanyDetails
                            }
                            titleCompanies {
                              ...CompanyDetails
                            }
                            underwriters {
                              ...CompanyDetails
                            }
                          }
                          accounting {
                            disbursements {
                              amount
                              payeeName
                              posted
                              voided
                            }
                            disbursementAccounts {
                              name
                            }
                            receipts {
                              amount
                              forBenefitOf
                              posted
                              receivedFrom
                              voided
                            }
                          }
                          closingLocation {
                            ...AddressDetails
                          }
                          appointments {
                            start
                            type
                            duration
                            eventName
                            guestInstructions
                            place {
                              address {
                                ...AddressDetails
                              }
                            }
                          }
                          charges {
                            section
                            lineNumber
                            description
                            borrowerAmount {
                              total
                            }
                            sellerAmount {
                              total
                            }
                            payeeName
                            payees {
                              type
                              amount
                              name
                              address {
                                address1
                                address2
                                zipcode
                                city
                                state
                                county
                              }
                              label
                            }
                          }
                          documents {
                            name
                            created
                          }
                          loans {
                            amount
                            interestRate
                            loanNumber
                          }
                          properties {
                            ...PropertyDetails
                          }
                          settlementStatement {
                            lines {
                              description
                              borrowerAmount
                              sellerAmount
                              payeeName
                            }
                          }
                          settlementTeam {
                            firstName
                            lastName
                            role
                            phone
                            fax
                            email
                            roleID
                            userID
                          }
                          settlementAgency {
                            id
                            name
                            branchName
                            email
                            phone
                            fax
                            addresses {
                              ...AddressDetails
                            }
                          }
                          tasks {
                            label
                            assigneeName
                            due
                            completed
                          }
                        }
                      }
                    } 
                  }
                  
                  fragment CompanyDetails on Company {
                    ... on OrderCompany {
                      id
                      associates {
                        ...Associate
                      }
                      name
                      phone
                      fax
                      email
                      nationalLicenseID
                      stateLicenseIDs {
                        ...License
                      }
                      primaryAddress {
                        ...AddressDetails
                      }
                      mailingAddress {
                        ...AddressDetails
                      }
                      type
                    }
                  }
                  
                  fragment BorrowerOfSellerDetails on BorrowerSellerEntity {
                    ... on Organization {
                      name
                      currentAddress {
                        ...AddressDetails
                      }
                      email
                      forwardingAddress {
                        ...AddressDetails
                      }
                      type
                    }
                    ... on Individual {
                      ssn
                      cellPhone
                      currentAddress {
                        ...AddressDetails
                      }
                      dateOfBirth
                      email
                      firstName
                      forwardingAddress {
                        ...AddressDetails
                      }
                      lastName
                      maritalStatus
                    }
                    currentAddress {
                      ...AddressDetails
                    }
                    email
                    forwardingAddress {
                      ...AddressDetails
                    }
                  }
                  
                  fragment SourceOfBusinessDetails on SourceOfBusiness {
                    associates {
                      ...Associate
                    }
                    borrowerOrSeller {
                      ...BorrowerOfSellerDetails
                    }
                    company {
                      ...CompanyDetails
                    }
                    manualEntry
                    type
                    users {
                      id
                      email
                      firstName
                      jobTitle
                      lastName
                      middleName
                      phone
                      suffix
                    }
                  }
                  
                  fragment AddressDetails on Address {
                    address1
                    address2
                    zipcode
                    city
                    state
                    county
                  }
                  
                  fragment PropertyDetails on Property {
                    address1
                    address2
                    zipcode
                    city
                    state
                    county
                  }
                  
                  fragment Associate on OrderAssociate {
                    id
                    firstName
                    lastName
                    workPhone
                    cellPhone
                    email
                    jobTitle
                    nationalLicenseID
                    stateLicenseIDs {
                      ...License
                    }
                  }
                  
                  fragment License on StateLicense {
                    id
                    state
                  }',
                'variables' => [
                  "inputFirst" => $limit,
                  "inputAfter" => $cursor
                ],
              ]),
              ['Authorization' => $auth_key,
              'Content-Type' => 'application/json']
            );
        } catch (RequestException $e) {
            throw new \SugarApiExceptionError($e->getMessage());
        }
        
        $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
        return $parsed;
    }
    
    // public static function getOrderIds($url = '', $auth_key, $method = 'POST')
    // {
    //     try {
    //         $response = (new ExternalResourceClient())->post(
    //         $url,
    //         json_encode([
    //             'query' => 'query getOrderIds($input:OrdersFilter){ orders(filter:$input)}',
    //             'variables' => [
    //                 'operationName' => 'getOrderIds',
    //                 'variables' => [
    //                     'input' => ""
    //                 ]
    //             ]
    //         ]), 
    //         ['Authorization' => $auth_key,
    //         'Content-Type' => 'application/json']);
    //     } catch (RequestException $e) {
    //         throw new \SugarApiExceptionError($e->getMessage());
    //     }
        
    //     $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
    //     return $parsed;
    // }


    // public static function getOrderRecordData($url = '', $auth_key, $id)
    // {
    //     try {
      
    //         $response = (new ExternalResourceClient())->post(
    //         $url,
    //          json_encode([
    //             'query' => 'query orders($id:ID!){
    //                 order (id: $id){
    //                   id
    //                   createdDate
    //                   status
    //                   cancelledDate
    //                   orderNumber
    //                   estimatedClosing
    //                   purchasePrice
    //                   earnestAmount
    //                   createdDate
    //                 }
    //               }',
    //             'variables' => [
    //                 'id' => $id
    //             ]
    //     ]),
    //         ['Authorization' => $auth_key,
    //         'Content-Type' => 'application/json']);
    //     } catch (RequestException $e) {
    //         throw new \SugarApiExceptionError($e->getMessage());
    //     }
        
    //     $parsed = !empty($response) ? json_decode($response->getBody()->getContents(), true) : null;
    //     return $parsed;
    // }

}
