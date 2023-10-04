({
    extendsFrom: "PartyAgentContactView",
    name: "party-agent-contact-borrower-seller",
    agentType: "PartyAgentCcontactBorrowersSellers",
    partyModule: "Contacts",
    mainPartiesAllowed: ["Borrower", "Seller"],
    validFields: [
        "primary_address_street",
        "alt_address_street",
        "phone_mobile",
        "primary_address_street_2",
        "alt_address_street_2",
        "email",
        "primary_address_city",
        "alt_address_city",
        "wstudio-empty-space",
        "primary_address_state",
        "alt_address_state",
        "wstudio-empty-space",
        "primary_address_postalcode",
        "alt_address_postalcode",
        "wstudio-empty-space",
        "primary_address_country",
        "alt_address_country",
    ],
});