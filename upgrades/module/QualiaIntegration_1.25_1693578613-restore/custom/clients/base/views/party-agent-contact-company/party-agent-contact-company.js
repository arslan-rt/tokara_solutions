({
    extendsFrom: "PartyAgentContactView",
    name: "party-agent-contact-company",
    agentType: "PartyAgentContactCompany",
    partyModule: "Accounts",
    mainPartiesAllowed: ["SourceOfBusiness", "Lenders", "ListingAgencies", "MortgageBrokerages", "OtherContacts",
        "RecordingOffices", "SellingAgencies", "SettlementAgencies", "SurveyingFirms",
        "TaxAuthorities", "TitleAbstractors", "TitleCompanies", "Underwriters", "SettlementTeam"],
    validFields: [
        "phone_office",
    ],
});