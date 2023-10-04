/* global app, _ */

({
    events: {
        "click #expandColapseButton": "expandColapseButtonClicked"
    },

    initialize: function (options) {
        this._super("initialize", arguments);

        this.header = options.title;
        this.parent = options.parent;
        this.cUUID = app.utils.generateUUID();
        this.headerIndex = options.headerIndex;
        this.showSummary = options.showSummary;
        this.tableToCollapseId = _.uniqueId();
        this.childTableVisible = true;
        this.dashletParent = options.dashletParent;

        var spacesOffset = 10;
        var spacesLeft = 5;
        this.spaces = this.headerIndex * spacesOffset - spacesLeft;

        this.darkMode = $("body").hasClass("theme-dark") === true;
    },

    render: function () {
        this._super("render", arguments);
        this.getHeader();
        var headerHtml =
            "<div data-html=\"true\" style=\"float:left; margin-left: 5px;\">" +
            this.header +
            "</div>";

        this.$el.find("." + this.tableToCollapseId).append(headerHtml);
    },

    expandColapseButtonClicked: function (event) {
        var childTable = this.$el.find("#" + event.currentTarget.name);
        if (childTable.data("visible") === false) {
            event.currentTarget.children[0].src =
                "themes/default/images/basic_search.gif?v=NDZq21b7_V0TWvcCY4J40";
            childTable.data("visible", true);
            childTable.show();
        } else {
            childTable.hide();
            childTable.data("visible", false);
            event.currentTarget.children[0].src =
                "themes/default/images/advanced_search.gif?v=NDZq21b7_V0TWvcCY4J40";
        }
    },

    getHeader: function () {
        if (
            typeof this.collection == "undefined" ||
            this.showSummary !== true
        ) {
            return;
        }

        if (this.collectionIsHeader()) {
            for (var group in this.collection) {
                if (group !== "header") {
                    var subGroupView = app.view.createView({
                        name          : "saved-report-list-summary-header",
                        model         : this.model,
                        context       : this.context,
                        collection    : this.collection[group],
                        headerIndex   : this.headerIndex + 1,
                        showSummary   : this.showSummary,
                        title         : this.collection[group]["header"],
                        dashletParent : this.dashletParent
                    });

                    subGroupView.render();

                    this.$el
                        .find("table#" + this.cUUID)
                        .find("td.group-data:first")
                        .append(subGroupView.$el.find("table:first"));
                }
            }
        } else {
            var headerRow = app.view.createView({
                name          : "saved-report-list-summary-row",
                model         : this.model,
                context       : this.context,
                collection    : this.collection,
                dashletParent : this.dashletParent
            });

            headerRow.render();

            this.$el
                .find("table#" + this.cUUID)
                .find("td.group-data:first")
                .append(headerRow.$el.find("table:first"));
        }
    },

    collectionIsHeader: function () {
        return !this.collection.wIsData;
    }
});