({
    extendedEvents : {},
    events         : {
        "click .record-panel-header": "togglePanel",
    },

    agentModel         : {},
    agentData          : {},
    generalInfo        : [],
    validFields        : [],
    agentType          : "Agent",
    partyModule        : "Accounts",
    partyId            : "",
    partyName          : "",
    mainPartiesAllowed : ["SourceOfBusiness", "Borrowers", "Sellers", "Loan", "Lenders", "Property"],

    initialize() {
        Object.assign(this.events, this.extendedEvents);

        let callParent = this._super("initialize", arguments);
        this.uniqueId = app.utils.generateUUID();
        this.createPartyViews();
        return callParent;
    },

    _loadTemplate(options) {
        this.name = "party-agent";

        let callParent = this._super("_loadTemplate", arguments);

        return callParent;
    },

    render() {
        let callParent = this._super("render", arguments);

        this.addFieldsValuePadding();
        this.intializePanelState();

        return callParent;
    },

    createPartyViews() {
        this.agentData = this.options.rqPartiesData[this.options.rqPartiesData.partyType];
        this.partyId = this.agentData.id;
        this.partyModule = this.agentData.parent_type;

        if (this.partyDisplayName === "Settlement Team") {
            this.partyName = this.agentData.qualia_parent_role + ": " + this.agentData.name;
        } else {
            this.partyName = this.partyDisplayName + ": " + this.agentData.name;
        }

        this.agentModel = App.data.createBean(this.partyModule, {
            id: this.agentData.id
        });

        this.agentModel.fetch({
            success: function success(model) {
                this.formatPhoneNumbersInModel();
                this.createPartyViewData();
                this.render();
                this.createRelatedPartyViews();
            }.bind(this),
            error: function error() {
                let infoMessage = " (DELETED RECORD OR YOU DO NOT HAVE ACCESS TO IT)";
                let rqPartiesData = this.options.rqPartiesData;

                if (rqPartiesData && rqPartiesData.partyRecordDeleted === true) {
                    infoMessage += rqPartiesData.partyName;
                }

                this.$el.find(".partyLink").css("color", "red");
                this.$el.find(".partyLink").removeAttr("href");
                this.$el.find(".partyLink").parent().parent().find(".pull-right").css("visibility", "hidden");
                this.$el.find(".partyLink").attr("title", "Removed record. You can use 'Sync Order From RQ' to update it");
                this.$el.find(".partyLink").attr("rel", "tooltip");
                this.$el.find(".partyLink").text(this.$el.find(".partyLink").text() + infoMessage);
            }.bind(this)
        });
    },

    createRelatedPartyViews() {
        var createdRelatedParties = false;

        this.options.rqPartiesData.relatedParties = _.sortBy(this.options.rqPartiesData.relatedParties,
            function sortParties(relatedParty) {
                return relatedParty.displayPriority;
            });

        _.each(this.options.rqPartiesData.relatedParties, function createRelatedParty(relatedPartyData) {
            if (this.canDisplayParty(relatedPartyData)) {
                var relatedPartyViewName = this.options.manager.partyViewMappingTable[relatedPartyData.partyType].viewName;
                var relatedPartyView = App.view.createView({
                    name          : relatedPartyViewName,
                    manager       : this.options.manager,
                    rqPartiesData : relatedPartyData,
                    panel         : this.options.panel,
                });

                relatedPartyView.render();
                this.$el.find("#relatedPartiesContainer" + this.uniqueId).append(relatedPartyView.$el);
                createdRelatedParties = true;
            }
        }.bind(this));

        if (!createdRelatedParties) {
            this.$el.find("#relatedPartiesContainer" + this.uniqueId).hide();
        }
    },

    createPartyViewData() {
        this.generalInfo = [];
        var fieldIndex = 1;
        var pairInfo = [];
        var columnNumber = 3;
        _.each(this.validFields, function createGeneralInfo(fieldName) {
            var fieldData = this.agentModel.fields[fieldName];

            if (!fieldData) {
                fieldData = this.getComplexField(fieldName);
            }

            if (fieldData) {
                pairInfo.push(fieldData);

                if (fieldIndex > 1 && fieldIndex % columnNumber === 0) {
                    this.generalInfo.push(pairInfo);
                    pairInfo = [];
                }

                fieldIndex = fieldIndex + 1;
            }
        }.bind(this));

        if (pairInfo.length > 0) {
            this.generalInfo.push(pairInfo);
        }
    },

    getComplexField(fieldName) {
        if (fieldName === "wstudio-empty-space") {
            return {
                "name" : "wstudio-empty-space",
                "type" : "wstudio-empty-space",
            };
        }

        var allModuleFields = _.flatten(_.pluck(App.metadata.getModule(this.partyModule).views.record.meta.panels, "fields"));
        var searchedForField = _.filter(allModuleFields,
            function filter(field) {
                return field.name === fieldName;
            });

        return searchedForField[0];
    },

    preventDefaultActions(evt) {
        // stop trigger the events from base functionality
        evt.stopPropagation();
        evt.stopImmediatePropagation();
    },

    formatPhoneNumber(phoneNumberString) {
        var cleaned = ("" + phoneNumberString).replace(/\D/g, "");
        var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);

        if (match) {
            return "(" + match[1] + ") " + match[2] + "-" + match[3];
        }

        return null;
    },

    formatPhoneNumbersInModel() {
        _.each(this.agentModel.attributes, function fixPhoneNumbers(fieldValue, fieldName) {
            if (fieldName.includes("phone")) {
                var formattedPhoneNumber = this.formatPhoneNumber(fieldValue);

                if (formattedPhoneNumber) {
                    this.agentModel.set(fieldName, formattedPhoneNumber);
                }
            }
        }.bind(this));
    },

    intializePanelState() {
        var mainPanelContainer = this.$el.find("#mainPanelContainer" + this.uniqueId);
        var mainPanelContent = this.$el.find("#record-panel-content" + this.uniqueId);
        var panelName = mainPanelContainer.data("panelname");

        var shouldBeVisible = App.user.lastState.get("Order_RQ_Order:record_view:" + panelName + ":tabState") === "expanded";
        var isVisible = mainPanelContent.is(":visible");

        if (shouldBeVisible !== isVisible) {
            mainPanelContent.toggle();
        }

        return {
            mainPanelContainer : mainPanelContainer,
            mainPanelContent   : mainPanelContent
        };
    },

    togglePanel(e) {
        this.preventDefaultActions(e);

        var $panelHeader = this.$(e.currentTarget);
        if ($panelHeader && $panelHeader.next()) {
            $panelHeader.next().toggle();
        }

        this.$el.find("#chevronIcon" + this.uniqueId).toggleClass("fa-chevron-up fa-chevron-down");

        var panelName = this.$(e.currentTarget).parent().data("panelname");
        var state = "collapsed";
        if (this.$(e.currentTarget).next().is(":visible")) {
            state = "expanded";
        }

        this.options.manager.savePanelState(panelName, state);
    },

    canDisplayParty(partyData) {
        var canDisplay = true;

        if (this.mainPartiesAllowed.includes(partyData.partyType)) {
            canDisplay = false;
        }

        return canDisplay;
    },

    addFieldsValuePadding() {
        var className = "." + this.action;
        this.$el.find(className).css("margin-left", "0.5em");
    }
});