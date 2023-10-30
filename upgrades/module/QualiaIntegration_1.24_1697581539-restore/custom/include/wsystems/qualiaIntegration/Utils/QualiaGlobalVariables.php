<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

class QualiaGlobalVariables
{
    const ORDER_MODULE_NAME    = "Order_RQ_Order";
    const PARTY_MODULE_NAME    = "Party_RQ_Party";
    const PROPERTY_MODULE_NAME = "Listg_Listings";
    const LOAN_MODULE_NAME     = "Loans_Loans";
    const CONTACT_MODULE_NAME  = "Contacts";
    const ACCOUNT_MODULE_NAME  = "Accounts";

    const CONTACT_TABLE_NAME  = "contacts";
    const ACCOUNT_TABLE_NAME  = "accounts";
    const PROPERTY_TABLE_NAME = "listg_listings";
    const LOAN_TABLE_NAME     = "loans_loans";
    const PARTY_TABLE_NAME    = "party_rq_party";

    const PARTY_ORDER_REL       = "party_rq_party_order_rq_order";
    const PARTY_PARTY_REL       = "party_rq_party_party_rq_party";
    const ACCOUNTS_CONTACTS_REL = "contacts";
    const CONTACTS_ACCOUNTS_REL = "accounts";
    const PARTY_CONTACTS_REL    = "party_rq_party_contacts";
    const PARTY_ACCOUNTS_REL    = "party_rq_party_accounts";
    const PROPERTY_CHILD        = "Property";
    const LOAN_CHILD            = "Loan";
    const CONTACT_CHILD         = "Contact";
    const ASSOCIATE_CHILD       = "Associates";

    const PARTY_LISTING_AGENT_SALES_REPS_REL_NAME  = "listing_agent_sales_reps_related";
    const PARTY_SELLING_AGENT_SALES_REPS_REL_NAME  = "selling_agent_sales_reps_related";
    const PARTY_LISTING_AGENT_CREDIT_REPS_REL_NAME = "listing_agent_credit_reps_related";
    const PARTY_SELLING_AGENT_CREDIT_REPS_REL_NAME = "selling_agent_credit_reps_related";
    const PARTY_ESCROW_CLOSER_REL_NAME             = "escrow_closer_related";
    const PARTY_TITLE_OFFICER_REL_NAME             = "title_officer_related";
    const PARTY_MARKETER_REL_NAME                  = "marketer_related";
    const ORDER_FILTER_MASK_FOR_CONTACTS_NAME      = "filter_related_contacts";

    const PARTY_LISTING_AGENT_SALES_REPS  = "listing_agent_sales_reps";
    const PARTY_SELLING_AGENT_SALES_REPS  = "selling_agent_sales_reps";
    const PARTY_LISTING_AGENT_CREDIT_REPS = "listing_agent_credit_reps";
    const PARTY_SELLING_AGENT_CREDIT_REPS = "selling_agent_credit_reps";
    const PARTY_ESCROW_CLOSER             = "escrow_closer";
    const PARTY_TITLE_OFFICER             = "title_officer";
    const PARTY_MARKETER                  = "marketer";

    const QUALIA_ID          = "qualia_id";
    const QUALIA_UNIQUE_HASH = "qualia_unique_hash";
    const QUALIA_DIFF_HASH   = "qualia_diff_hash";

    const ACCOUNT_PARTY_TYPES = "party_types";

    const PARTY_PARENT_PARTY_TYPE_FIELD = "parent_party_type";
    const PARTY_TYPE_FIELD              = "party_type";
    const PARTY_PARENT_ID_FIELD         = "parent_id";
    const PARTY_PARENT_ROLE             = "qualia_parent_role";
    const PARTY_QUALIA_ID               = "qualia_id";
    const PARTY_QUALIA_UNIQUE_HASH      = "qualia_unique_hash";
    const PARTY_QUALIA_DIFF_HASH        = "qualia_diff_hash";

    const CONTACT_CHILD_BORROWER  = "borrowers";
    const CONTACT_CHILD_SELLER    = "sellers";
    const CONTACT_CHILD_ASSOCIATE = "associates";

    const CONTACT_CHILD_LENDER             = "lenders";
    const CONTACT_CHILD_LISTING_AGENCY     = "listingAgencies";
    const CONTACT_CHILD_MORTGAGE_BROKERAGE = "mortgageBrokerages";
    const CONTACT_CHILD_OTHER_CONTACTS     = "otherContacts";
    const CONTACT_CHILD_RECORDING_OFFICE   = "recordingOffices";
    const CONTACT_CHILD_SELLING_AGENCY     = "sellingAgencies";
    const CONTACT_CHILD_SETTLEMENT_AGENCY  = "settlementAgencies";
    const CONTACT_CHILD_SURVEYING_FIRMS    = "surveyingFirms";
    const CONTACT_CHILD_TAX_AUTHORITY      = "taxAuthorities";
    const CONTACT_CHILD_TITLE_ABSTRACTOR   = "titleAbstractors";
    const CONTACT_CHILD_TITLE_COMPANIES    = "titleCompanies";
    const CONTACT_CHILD_UNDERWRITER        = "underwriters";

    const CONTACT_CHILD_SOURCE_OF_BUSINESS = "sourceOfBusiness";
    const CONTACT_CHILD_SETTLEMENT_TEAM    = "SettlementTeam";

    //there are 2 types of contacts
    //they have a completely different data type
    const CONTACT_CHILD_TYPE_BORROWER_SELLER = [
        "borrowers",
        "sellers",
    ];
    const CONTACT_CHILD_TYPE_COMPANY = [
        "lenders",
        "listingAgencies",
        "mortgageBrokerages",
        "otherContacts",
        "recordingOffices",
        "sellingAgencies",
        "settlementAgencies",
        "surveyingFirms",
        "taxAuthorities",
        "titleAbstractors",
        "titleCompanies",
        "underwriters",
    ];

}
