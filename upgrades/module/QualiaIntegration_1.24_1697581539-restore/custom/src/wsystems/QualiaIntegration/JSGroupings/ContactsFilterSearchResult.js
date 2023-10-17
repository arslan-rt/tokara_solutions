// eslint-disable-next-line
; (function contactsFilterSearchResult(app) {
    var filterId = "filterRelatedContacts";
    var editable = false;

    var orderRelateFieldExtension = {
        initialize: function () {
            var parent = this._super("initialize", arguments);

            var whitelistedFields = [
                "listing_agent_sales_reps",
                "selling_agent_sales_reps",
                "listing_agent_credit_reps",
                "selling_agent_credit_reps",
                "escrow_closer",
                "title_officer",
                "marketer",
            ];

            if (_.contains(whitelistedFields, this.name) === true) {
                this.def["initial_filter"] = filterId;
                this.def["initial_filter_label"] = "LBL_QUALIAINTEGRATION_FILTER_RELATED_CONTACTS";

                this.def["filter_populate"] = {};
                this.def["filter_populate"]["filter_related_contacts"] = this.name;
            }

            return parent;
        },
    };

    /**
     * Makes sure the filter component stays closed,
     * if it is set to be readonly.
     */
    var handleFilterDropdown = {
        handleFilterChange: function (id) {
            var parent = this._super("handleFilterChange", arguments);

            /**
             * Close filter component, if it's readonly
             */
            if (id === filterId && editable === false) {
                this.layout.trigger("filter:create:close");
            }

            return parent;
        },
    };

    /**
     * Makes the filter component editable/readonly.
     */
    var handleFilterEditState = {
        isFilterEditable: function (id) {
            if (id === filterId) {
                return editable;
            }

            return this._super("isFilterEditable", arguments);
        },
    };

    app.events.once("app:sync:complete", function contactsRelatedSearchResult() {
        app.wsystems.QualiaIntegration.extendComponent("base", "Order_RQ_Order", "field", "relate", orderRelateFieldExtension);
    });

    app.events.once("app:start", function handleFilterEditableState() {
        app.wsystems.QualiaIntegration.extendComponent(
            "base", null, "layout", "filter", handleFilterDropdown
        );
        app.wsystems.QualiaIntegration.extendComponent(
            "base", null, "view", "filter-filter-dropdown", handleFilterEditState
        );
    });
})(SUGAR.App);
