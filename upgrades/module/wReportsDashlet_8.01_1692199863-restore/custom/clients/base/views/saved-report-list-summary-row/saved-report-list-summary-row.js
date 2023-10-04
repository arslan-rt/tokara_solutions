/* global app */

({
    headerFields   : null,
    normalizedRows : [],
    reportModuleLC : "",

    initialize: function (options) {
        this._super("initialize", arguments);

        this.rowsTableId = _.uniqueId();
        this.normalizedRows = [];
        this.reportModuleLC = this.options.dashletParent.serverResults.keyPrefix;
        this.headerFields = this.options.dashletParent.serverResults.fields;
    },

    render: function () {
        this._super("render", arguments);
        this.parseCollectionData();
    },

    orderRows: function (event) {},

    parseCollectionData: function (orderParam) {
        var cKeys = Object.keys(this.collection);
        var rowsContainerEl = this.$el.find(".rowsContainer");

        // iterate through all the cells html and append them into the table
        for (var i = 0; i < cKeys.length; i++) {
            if (cKeys[i] !== "wIsData" && cKeys[i] !== "header") {
                var currentRowData = this.collection[cKeys[i]];
                var htmlContent = "<tr class='group-line-cells'>";
                var maxCellWidth = 100;
                var cellWidth =
                    maxCellWidth / Object.keys(currentRowData).length;

                _.each(currentRowData, function createHtml(
                    cellContent,
                    cellKey
                ) {
                    if (cellKey !== "wIsData" && cellKey !== "header") {
                        var oddComparision = 2;
                        var bgColor =
                            i % oddComparision === 0 ? "#f6f6f6" : "#fff";
                        htmlContent =
                            htmlContent +
                            "<td class='row-column' style='text-indent:5px; height:25px; width:" +
                            cellWidth +
                            "%; text-align:left; background-color:" +
                            bgColor +
                            "; border-width:1px; border-bottom-style:solid; border-top-style:solid; border-color:#e9e9e9;'>" +
                            cellContent +
                            "</td>";
                    }
                });

                htmlContent = htmlContent + "</tr>";

                rowsContainerEl.append(htmlContent);
            }
        }
        var self = this;
        _.each(this.headerFields, function createHeader(headerData) {
            var headerHtml =
                "<th class=\"row-column\" style=\"text-align:left; border-width:1px; border-style:solid; background-color:#fff;border-color: #e9e9e9\">\
                    <a class=\"rowHeader\" data-html=\"true\" style=\"margin-left: 5px; border-style: none;color:#666;font-size: 13px;font-weight: bolder;\" tabindex=\"-1\">\
                    " +
                headerData.label +
                "</a>\
                </th>";

            self.$el.find(".headerContainer").append(headerHtml);
        });
    }
});