(function start(app) {
    var viewsToBeExtended = ["Record", "Create"];

    _.each(viewsToBeExtended, function extendView(viewName) {
        app.events.on("app:sync:complete", function overrideComplete() {
            if (
                !app.view.views["BaseOrder_RQ_Order" + viewName + "View"] &&
                !app.view.views["BaseOrder_RQ_OrderCustom" + viewName + "View"]
            ) {
                app.view.declareComponent(
                    "view",
                    viewName.toLowerCase(),
                    "Order_RQ_Order",
                    undefined,
                    false,
                    "base"
                );
            }

            var customPanel = "BaseOrder_RQ_Order" + viewName + "View";

            if (app.view.views["BaseOrder_RQ_OrderCustom" + viewName + "View"]) {
                customPanel = "BaseOrder_RQ_OrderCustom" + viewName + "View";
            }

            if (App.view.views[customPanel].addedNewTabs === true) {
                return;
            }

            // eslint-disable-next-line max-nested-callbacks
            Handlebars.registerHelper("ifEquals", function registerHelper() {
                var options = arguments[arguments.length - 1];
                var returnValue = options.inverse(this);
                var searchedValue = arguments[0];
                var searchStartIndex = 1;

                for (var searchIndex = searchStartIndex; searchIndex < arguments.length - 1; searchIndex++) {
                    if (arguments[searchIndex] === searchedValue) {
                        returnValue = options.fn(this);
                    }
                }

                return returnValue;
            });

            // eslint-disable-next-line max-nested-callbacks
            Handlebars.registerHelper("ifNotEquals", function registerHelper() {
                var options = arguments[arguments.length - 1];
                var returnValue = options.inverse(this);
                var searchedValue = arguments[0];
                var searchStartIndex = 1;

                for (var searchIndex = searchStartIndex; searchIndex < arguments.length - 1; searchIndex++) {
                    if (arguments[searchIndex] !== searchedValue) {
                        returnValue = options.fn(this);
                    }
                }

                return returnValue;
            });

            App.view.views[customPanel] = App.view.views[customPanel].extend({
                addedNewTabs : true,
                panelKeys    : ["SalesRep", "ReferralSource", "LendingInformation", "AgenciesBuyerandSeller", "Property",
                    "Insurance", "RecordandTax", "OtherContacts"],
                panelsViews           : [],
                partyViewMappingTable : {
                    "SettlementTeam": {
                        viewName  : "party-agent-contact-settlement-team",
                        panelName : "party-panel"
                    },
                    "SourceOfBusiness": {
                        viewName  : "party-agent-contact-source-of-business",
                        panelName : "party-panel"
                    },
                    "Lenders": {
                        viewName  : "party-agent-contact-company-lender",
                        panelName : "party-panel",
                    },
                    "MortgageBrokerages": {
                        viewName  : "party-agent-contact-company-mortgage-brokerages",
                        panelName : "party-panel"
                    },
                    "SellingAgencies": {
                        viewName  : "party-agent-contact-company-selling-agencies",
                        panelName : "party-panel"
                    },
                    "ListingAgencies": {
                        viewName  : "party-agent-contact-company-listing-agencies",
                        panelName : "party-panel"
                    },
                    "Sellers": {
                        viewName  : "party-agent-contact-seller",
                        panelName : "party-panel"
                    },
                    "Borrowers": {
                        viewName  : "party-agent-contact-borrower",
                        panelName : "party-panel"
                    },
                    "Loan": {
                        viewName  : "party-loan",
                        panelName : "party-panel"
                    },
                    "Property": {
                        viewName  : "party-property",
                        panelName : "party-panel"
                    },
                    "TitleAbstractors": {
                        viewName  : "party-agent-contact-company-title-abstractors",
                        panelName : "party-panel"
                    },
                    "TitleCompanies": {
                        viewName  : "party-agent-contact-company-title-companies",
                        panelName : "party-panel"
                    },
                    "SettlementAgencies": {
                        viewName  : "party-agent-contact-company-settlement-agencies",
                        panelName : "party-panel"
                    },
                    "Underwriters": {
                        viewName  : "party-agent-contact-company-underwriters",
                        panelName : "party-panel"
                    },
                    "RecordingOffices": {
                        viewName  : "party-agent-contact-company-recording-offices",
                        panelName : "party-panel"
                    },
                    "TaxAuthorities": {
                        viewName  : "party-agent-contact-company-tax-authorities",
                        panelName : "party-panel"
                    },
                    "SurveyingFirms": {
                        viewName  : "party-agent-contact-company-surveying-firms",
                        panelName : "party-panel"
                    },
                    "OtherContacts": {
                        viewName  : "party-agent-contact-company-other-contacts",
                        panelName : "party-panel"
                    },
                    "Contact": {
                        viewName  : "party-agent-contact",
                        panelName : "party-panel"
                    },
                    "Associates": {
                        viewName  : "party-agent-contact",
                        panelName : "party-panel"
                    },
                },

                initialize() {
                    var callParent = this._super("initialize", arguments);

                    this.createPanelTabs();

                    return callParent;
                },

                render() {
                    var callParent = this._super("render", arguments);
                    this.getRQPartiesData();

                    return callParent;
                },

                save() {
                    App.data.temporaryBeans = [];
                    var callParent = this._super("save", arguments);
                    return callParent;
                },

                cancel() {
                    var callParent = this._super("cancel", arguments);
                    this.model.destroy();
                    return callParent;
                },

                refreshSubapanels() {
                    var subpanelCollection = this.model.getRelatedCollection("party_rq_party_order_rq_order");
                    subpanelCollection.fetch({
                        relate: true
                    });
                },

                getRQPartiesData(canSave) {
                    if (canSave && this.name === "record") {
                        App.controller.context.get("model").save();
                    }
                    var createPanelViews = {
                        success: function createPanelViews(rqPartiesData) {
                            this.createPanelViews(rqPartiesData);
                        }.bind(this)
                    };

                    var reqParamsObject = {
                        orderId: this.model.get("id"),
                    };

                    app.api.call(
                        "create",
                        app.api.buildURL("GetRQPartiesData"),
                        reqParamsObject,
                        null,
                        createPanelViews
                    );
                },

                formatRQPartiesData(rqPartiesData) {
                    var formattedRQPartiesData = {};

                    _.each(this.partyViewMappingTable, function createDataTable(panelData, partyType) {
                        formattedRQPartiesData[partyType] = [];
                    });

                    _.each(rqPartiesData, function formatData(partyData) {
                        var partyType = partyData.partyType;
                        if (_.isUndefined(formattedRQPartiesData[partyType]) === false) {
                            formattedRQPartiesData[partyType].push(partyData);
                        }
                    }.bind(this));

                    return formattedRQPartiesData;
                },

                createPanelTabs() {
                    this.cleanPanelTabs();
                    _.each(this.panelKeys, function createPanelTab(panelKey) {
                        var beforeLastElementIndex = 1;
                        var indexToInsertAt = this.meta.panels.length - beforeLastElementIndex;

                        if (indexToInsertAt < 0) {
                            indexToInsertAt = 0;
                        }

                        this.meta.panels.splice(indexToInsertAt, 0, this.createNewPanelTab(panelKey));
                    }.bind(this));
                },

                cleanPanelTabs() {
                    for (let panelIndex = this.meta.panels.length - 1; panelIndex - 0; panelIndex--) {
                        if (this.meta.panels[panelIndex].panelType === "RQParty") {
                            this.meta.panels.splice(panelIndex, 1);
                        }
                    }
                },

                createNewPanelTab(name, fields = []) {
                    var label = this.getLabel(name);

                    var panel = {
                        columns      : 12,
                        fields       : fields,
                        label        : label,
                        labelsOnTop  : 1,
                        name         : name,
                        newTab       : true,
                        panelDefault : "expanded",
                        placeholders : 1,
                        panelType    : "RQParty",
                        customTab    : true
                    };

                    return panel;
                },

                getLabel(name) {
                    var labels = {
                        "SalesRep"               : "Sales Rep",
                        "ReferralSource"         : "Referral Source",
                        "LendingInformation"     : "Lending Information",
                        "AgenciesBuyerandSeller" : "Agencies Buyer and Seller",
                        "Property"               : "Property",
                        "Insurance"              : "Insurance",
                        "RecordandTax"           : "Record and Tax",
                        "OtherContacts"          : "Other Contacts",
                    };

                    return labels[name];
                },

                cleanPanelViews() {
                    _.each(this.panelsViews, function deleteView(panelView) {
                        panelView.remove();
                    });

                    this.panelsViews = [];
                },

                createPanelViews(rqPartiesData) {
                    var formattedRQPartiesData = this.formatRQPartiesData(rqPartiesData);

                    this.cleanPanelViews();

                    _.each(this.partyViewMappingTable, function createPanelView(panelData, partyType) {
                        var panelTab = this.getPanelTabContentElement(partyType);
                        if (panelTab) {
                            var panelName = this.partyViewMappingTable[partyType].panelName;

                            var panelView = App.view.createView({
                                name          : panelName,
                                manager       : this,
                                rqPartiesData : formattedRQPartiesData[partyType],
                            });
                            panelView.render();
                            $(panelTab).append(panelView.$el);
                            this.panelsViews.push(panelView);
                        }
                    }.bind(this));
                },

                getNewTabIndex() {
                    const panels = _.pluck(this.meta.panels, "name");
                    var max = 0;

                    _.sortBy(panels, function getIndex(name) {
                        let number = parseInt(name.replace("LBL_RECORDVIEW_PANEL", ""));
                        if (!isNaN(number) && number > max) {
                            max = number;
                        }

                        return number;
                    });

                    const newTabIndex = max + 1;

                    return newTabIndex;
                },

                getPanelTabContentElement(partyType) {
                    const tabContent = this.$el.find("#tabContent");

                    var parentTabName = this.getTabName(partyType);

                    var panelTab = tabContent.find("div[id^=\"" + parentTabName + "\"]");

                    return _.first(panelTab);
                },

                getTabName(partyType) {
                    var parties = {
                        "SettlementTeam"     : "SalesRep",
                        "SourceOfBusiness"   : "ReferralSource",
                        "Lenders"            : "LendingInformation",
                        "MortgageBrokerages" : "LendingInformation",
                        "SellingAgencies"    : "AgenciesBuyerandSeller",
                        "ListingAgencies"    : "AgenciesBuyerandSeller",
                        "Sellers"            : "AgenciesBuyerandSeller",
                        "Borrowers"          : "AgenciesBuyerandSeller",
                        "Loan"               : "Property",
                        "Property"           : "Property",
                        "TitleAbstractors"   : "Insurance",
                        "TitleCompanies"     : "Insurance",
                        "SettlementAgencies" : "Insurance",
                        "Underwriters"       : "Insurance",
                        "RecordingOffices"   : "RecordandTax",
                        "TaxAuthorities"     : "RecordandTax",
                        "SurveyingFirms"     : "RecordandTax",
                        "OtherContacts"      : "OtherContacts",
                    };

                    return parties[partyType];
                },
            });
        });
    });

})(SUGAR.App);