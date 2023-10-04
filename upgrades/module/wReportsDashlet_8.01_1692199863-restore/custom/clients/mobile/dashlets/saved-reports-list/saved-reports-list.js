
({
    plugins: ["Dashlet"],
    reportData: undefined,
    chartField: undefined,
    reportOptions: undefined,
    reportsData: undefined,
    timerId: undefined,
    rowsNumber: undefined,
    displayTotal: undefined,
    showDrilldownButton: undefined,
    currentRowsShown: 0,
    loadOptions: false,
    reportType: undefined,
    isSummary: false,
    selectedReportIsSummary: false,
    dataLoaded: false,
    defDisplayColumns: {},
    SORT_SEPARATOR: "::",
    /**
     * False if no sort is applied on the list | the object with definition of the sort
     * Ex: {
     *        name:      "first_name",
     *        table_key: "self",
     *        sort_dir:  "a"
     *    }
     */
    sort: false,
    /**
     * List of sort configurations
     * Ex: {
     *      "first_name:self:a": {
     *          name:      "first_name",
     *          label:     "First name",
     *          table_key: "self",
     *          sort_dir:  "a",
     *      },
     *  }
     */
    availableSort: {},

    events: {
        "click a[name=editReport]": "editSavedReport",
        "click #drill_button": "drillAction",
        "click [data-fieldname=\"intelligent\"] input": "setIntelligence",
        "click th[data-fieldname][data-orderby]": "sortList",
    },

    extendsFrom: {
        baseType: "base-chart"
    },

    drillAction: function () {
        window.open("#bwc/index.php?module=Reports&action=DetailView&record=" + this.options.meta.view.saved_report_id);
    },

    _scheduleReload: function (delay) {
        this.timerId = setTimeout(
            _.bind(function refreshTimer() {
                this.context.resetLoadFlag();
                this.loadData({
                    complete: function reloadData() {
                        this._scheduleReload(delay);
                    }.bind(this)
                });
            }, this),
            delay
        );
    },

    initialize: function (options) {
        this.reportData = new Backbone.Model();
        return this._super("initialize", arguments);
    },

    loadData: function (options) {
        options = options || {};

        if (this.options.meta.view.saved_report_id) {
            this.getSavedReportById(this.options.meta.view.saved_report_id, options);
        }
    },

    showLoadingFeedback: function () {
        if (!this.dataLoaded) {
            var newElDiv = this.$el.find("#loadingFeedback");
            newElDiv.append(
                "<i name=\"placeHolderLoading\" class=\"fa fa-spinner fa-spin fa-3x fa-fw margin-top\" style=\"width: 35px;height: 35px;margin-top:0.5%;margin-left: 48%;\"></i>"
            );
        }
    },

    hideLoadingFeedback: function () {
        this.$el.find("[name=placeHolderLoading]").remove();
    },

    getSavedReportById: function (reportId, options) {
        this.dataLoaded = false;
        this.showLoadingFeedback();

        this.loadOptions = options;

        var parentModel = this.context.get("parentModel");
        var forceRefresh = options.complete ? true : false;

        var reqData = {
            reportId: reportId,
            forceRefresh: forceRefresh,
            usePaging: this.rowsNumber != 0,
            linkToCurrentRecord: this.options.meta.view.intelligent
        };

        if (this.options.meta.view.sort) {
            if (this.sort == false || (this.sort != false && !this.sort.forceSort)) {
                var sortConfiguration = this.options.meta.view.sort;
                sortConfiguration = this.options.meta.view.sort.split(this.SORT_SEPARATOR);
                // eslint-disable-next-line
                if (sortConfiguration.length === 3) {
                    this.sort = {
                        name: sortConfiguration[0],
                        table_key: sortConfiguration[1], //eslint-disable-line
                        sort_dir: sortConfiguration[2] //eslint-disable-line
                    };
                } else {
                    //backward versions compatibility (fixes problem with tables different than self)
                    window.console.log("wrong sort configuration set");
                    this.sort = false;
                }
            }
        }
        if (this.sort != false) {
            reqData = _.extend(reqData, {
                sort: this.sort
            });
            reqData.forceRefresh = true;
        }

        if (parentModel instanceof App.Bean && _.isEmpty(this.context.get("parentId") === false)) {
            reqData["linkField"] = this.options.meta.view.linked_fields;
            reqData["link"] = parentModel.get("_module").toLowerCase();
            reqData["module"] = parentModel.get("_module");
            reqData["contextId"] = parentModel.get("id");
            reqData["contextName"] = parentModel.get("name") || parentModel.get("full_name");
        }

        if (
            _.isUndefined(this.currentRowsShown) === false
            && this.loadOptions["append"] === true
        ) {
            reqData["reportOffset"] = this.currentRowsShown;
        }

        var apiUrl = app.api.buildURL("wReportsDashlet", "list/results");

        app.api.call("create", apiUrl, {
            contextData: reqData
        }, null, {
            success: _.bind(function getAllReportsList(serverData, options) {
                if (_.isEmpty(serverData) === true) {
                    this.hideLoadingFeedback();

                    return;
                }

                if (_.isUndefined(serverData.status) === false && serverData.status === "failed") {
                    App.alert.show("saved-report-error", {
                        level: "error",
                        messages: app.lang.getAppString(serverData.message) + serverData.reportId,
                        autoClose: false
                    });

                    this.hideLoadingFeedback();

                    return;
                }

                this.createDashletView(serverData, options);
            }, this),
            complete: options ? options.complete : null
        });
    },

    createBaseDashlet: function (serverData, options) { },

    createMatrixDashlet: function (matrixHtml) {
        var reportMatrixCss =
            "<style>.reportlistView {\
            border-top: 1px solid #000;\
            border-left: 1px solid #000;\
        }\
        table.reportlistView td, table.reportlistView th {\
            background: #fff;\
            border-bottom: 1px solid #000;\
            border-right: 1px solid #000;\
            color: #000;\
            padding: 4px;\
            text-align: center;\
            font-size: 11px;\
        }\
            table.reportlistView th, .reportlistView .reportlistViewMatrixRightEmptyData, .reportlistView .reportlistViewMatrixRightEmptyData1 {\
            background: #dcdcdc;\
            font-weight: bold;\
        }\
            </style>\
        ";

        if ($("body").hasClass("theme-dark") === true) {
            reportMatrixCss = "<style>.reportlistView {\
                border-top: 1px solid;\
                border-left: 1px solid;\
            }\
            table.reportlistView td, table.reportlistView th {\
                border-bottom: 1px solid;\
                border-right: 1px solid;\
                padding: 4px;\
                text-align: center;\
                font-size: 11px;\
            }\
                table.reportlistView th, .reportlistView .reportlistViewMatrixRightEmptyData, .reportlistView .reportlistViewMatrixRightEmptyData1 {\
                font-weight: bold;\
            }\
            table.reportlistView td {\
                background: #575757;\
            }\
                </style>\
            ";
        }

        this.$el.find("#saved_report_list_contents").html(reportMatrixCss + matrixHtml);
    },

    createDashletView: function (serverData, options) {
        this.dataLoaded = true;
        this.hideLoadingFeedback();

        if (_.isEmpty(serverData)) {
            return;
        }

        if (serverData.matrixHtml) {
            this.createMatrixDashlet(serverData.matrixHtml);
        } else if (serverData.collection && serverData.collection.length === 0) {
            this.$el.find("#saved_report_list_contents").empty();
            this.$el.find("#saved_report_list_contents").append("<div style='text-align:center'>" + app.lang.getAppString("LBL_NO_DATA_AVAILABLE") + "</div>");
        } else {
            this.createBaseDashlet(serverData, options);
            this.reportType = serverData["report_type"];
            this.isSummary = this.reportType == "summary" ? true : false;

            var titlesAreBroken = false;

            for (var headerSetIndex = serverData.headerTitles.length - 1; headerSetIndex >= 0; headerSetIndex--) {
                var headerSet = serverData.headerTitles[headerSetIndex];

                /*eslint-disable*/
                for (var headerDataIndex = 0; headerDataIndex < headerSet.length; headerDataIndex++) {
                    if (serverData.headerTitles[headerSetIndex + 1]) {
                        var hTitle = headerSet[headerDataIndex];
                        var exTitle = serverData.headerTitles[headerSetIndex + 1][headerDataIndex];
                        var majorExTitle = serverData.headerTitles[headerSetIndex + 1][0];
                        var majorTitle = serverData.headerTitles[headerSetIndex][0];
                        // eslint-disable-next-line
                        if (
                            majorTitle.indexOf("Count") > -1 &&
                            majorTitle.substr(0, majorTitle.lastIndexOf(" ")) ===
                            majorExTitle.substr(0, majorExTitle.lastIndexOf(" "))
                        ) {
                            var exCount = exTitle.substr(exTitle.lastIndexOf(" ") + 1, exTitle.length);
                            var currentCount = hTitle.substr(hTitle.lastIndexOf(" ") + 1, hTitle.length);
                            var totalCount = parseInt(exCount) + parseInt(currentCount);

                            serverData.headerTitles[headerSetIndex][headerDataIndex] =
                                hTitle.substr(0, hTitle.lastIndexOf(" ") + 1) + totalCount;

                            // eslint-disable-next-line max-depth
                            if (headerDataIndex === headerSet.length - 1) {
                                serverData.headerTitles.splice(headerSetIndex + 1, 1);
                                titlesAreBroken = true;
                            }
                        }
                    }
                }
            }
            /*eslint-enable*/

            if (titlesAreBroken) {
                var collectionIterator = 0;

                _.each(serverData.collection, function correctHeader(headerData, date) {
                    headerData.header = serverData.headerTitles[collectionIterator][0] || "";
                    collectionIterator = collectionIterator + 1;
                });
            }

            var collectionData = serverData;

            if (!this.isSummary || (this.isSummary && serverData.isSummationWithDetails)) {
                collectionData = this.getCollectionData(serverData);
            }

            var parentElement = this.$el.parent().parent();
            var title = parentElement.find(".dashlet-title")[0];

            if (title && this.displayTotal) {

                var collectionLength = _.isEmpty(collectionData.reportData.totalCount) ? collectionData.collection.length : collectionData.reportData.totalCount;

                if (this.isSummary === true) {
                    collectionLength = serverData.totalRecordsCount;
                }

                var initialTitle = this.options.meta.view.label;
                title.innerHTML = initialTitle + ": " + collectionLength + app.lang.getAppString("LBL_WRD_RECORDS");
            }

            // branching functionality as we want different things for when the report is summary
            if (collectionData.collection.length > 0 && this.isSummary != true) {
                this.formatRowsAndColumnsResults(collectionData);
            } else {
                this.formatSummaryResults(collectionData);
            }

            this._render();

            if (this.isSummary) {
                this.buildSummaryView();
            } else {
                this.buildRowsAndColumnsView();
            }

            this.fixBwcLinks();
            // this.addPrintAction();
        }
    },

    buildRowsAndColumnsView: function () {
        var rowColumnView = app.view.createView({
            name: app.mobile.views.MobileSavedreportlistrowscolumnsView,
            model: this.model,
            context: this.context,
            dashletParent: this
        });

        rowColumnView.render();

        this.$el.find("#saved_report_list_contents").append(rowColumnView.$el);
    },

    buildSummaryView: function () {
        var reportData = this.serverResults;

        if (reportData.isSummationWithDetails) {
            /*eslint-disable*/
            // creating the headers
            if (!_.isEmpty(reportData.collection)) {
                for (var col in reportData.collection) {
                    if (col !== "header") {
                        var groupView = app.view.createView({
                            name: app.mobile.views.MobileSavedreportlistsummaryheaderView,
                            model: this.model,
                            context: this.context,
                            collection: reportData.collection[col],
                            headerIndex: 1,
                            showSummary: reportData.showSummary,
                            title: reportData.collection[col]["header"],
                            dashletParent: this
                        });

                        groupView.render();
                        this.$el.find("#saved_report_list_contents").append(groupView.$el);
                    }
                }
            }/*eslint-enable*/
        } else {
            var headerRow = app.view.createView({
                name: app.mobile.views.MobileSavedreportlistsummaryrowView,
                model: this.model,
                context: this.context,
                collection: reportData.collection,
                dashletParent: this
            });

            headerRow.render();
            this.$el.find("#saved_report_list_contents").append(headerRow.$el);
        }

        // showing the grandTotal if the user wants so
        if (!_.isEmpty(reportData.grandTotal) && reportData.displayTotal === true) {
            var subTables = this.$el.find("#saved_report_list_contents").children();
            var tableParent = subTables[subTables.length - 1];
            var subTableElement = tableParent.children[0];
            var tableId = subTableElement ? subTableElement.id : "id";
            var tableElement = this.$el.find("#" + tableId);

            this.minTableWidth = tableElement.css("width");

            var grandTotalView = app.view.createView({
                name: app.mobile.views.MobileSavedreportlistgrandtotalView,
                model: this.model,
                context: this.context,
                grandTotalData: reportData.grandTotal,
                minTableWidth: this.minTableWidth,
                dashletParent: this
            });

            grandTotalView.render();
            this.$el.find("#saved_report_list_contents").append(grandTotalView.$el);
        }
    },

    formatSummaryResults: function (collectionData) {
        var reportData = _.clone(collectionData);
        var serverCollection = reportData.collection;

        if (!reportData.isSummationWithDetails) {
            //if the report is a simple summary report then we must format the data received from the API
            var headers = reportData.headerTitles[0] ? reportData.headerTitles[0] : [];
            reportData.fields = [];

            for (var headerIndex = 0; headerIndex < headers.length; headerIndex++) {
                reportData.fields.push({
                    label: headers[headerIndex]
                });
            }

            // var formattedCollection         = [];
            // formattedCollection[0]          = [];
            // formattedCollection             = this.formatSimpleSummaryReportData(server_collection, formattedCollection, 0, []).formattedCollection;
            serverCollection["wIsData"] = true;
            // server_collection               = formattedCollection;
        }

        this.serverResults = {
            isSummationWithDetails: reportData.isSummationWithDetails,
            fields: reportData.fields,
            collection: serverCollection,
            grandTotal: reportData.grandTotal,
            total: reportData.total,
            headers: reportData.headers,
            headerTitles: reportData.headerTitles,
            keyPrefix: reportData.reportData.module.toLowerCase(),
            displayTotal: this.displayTotal,
            showSummary: this.showSummary
        };
    },

    formatRowsAndColumnsResults: function (collectionData) {
        var serverCollection = [],
            i;

        //only show columns from Display Columns, in the order they are there
        var displayColumns = this.options.meta.view.display_columns;

        _.each(displayColumns, function checkValidColumn(columnName, columnKey) {
            if (columnName.indexOf(this.SORT_SEPARATOR) < 0) {
                var defColumnData = _.filter(this.defDisplayColumns, function getColumnData(columnData) {
                    return columnData.name === columnName;
                })[0];

                if (defColumnData) {
                    displayColumns[columnKey] = defColumnData.table_key + this.SORT_SEPARATOR + columnName;
                }
            }
        }.bind(this));

        if (displayColumns) {
            var columnsMask = []; //holds index in Display Columns and index in collection.fields
            var collectionFieldNames = [];
            _.each(collectionData.fields, function iterateOverFieldsFromDb(field, idx) {
                collectionFieldNames[idx] = field.table_key + this.SORT_SEPARATOR + field.name;
            }.bind(this));
            for (i = 0; i < displayColumns.length; i++) {
                columnsMask[i] = collectionFieldNames.indexOf(displayColumns[i]);
            }

            var collectionFields = [];
            for (i = 0; i < columnsMask.length; i++) {
                var indexOfDisplayFieldInCollection = columnsMask[i];
                collectionFields.push(collectionData.fields[indexOfDisplayFieldInCollection]);
            }
            collectionData.fields = collectionFields;

            for (i = 0; i < collectionData.collection.length; i++) {
                var newCells = [],
                    newRows = [];
                var cellsInARow = collectionData.collection[i].cells;
                var rowsInARow = collectionData.collection[i].rows;
                for (var columnIdx = 0; columnIdx < columnsMask.length; columnIdx++) {
                    var indexOfDisplayFieldInRow = columnsMask[columnIdx];
                    newCells.push(cellsInARow[indexOfDisplayFieldInRow]);
                    newRows.push(rowsInARow[indexOfDisplayFieldInRow]);
                }

                collectionData.collection[i].cells = newCells;
                collectionData.collection[i].rows = newRows;
            }
        }

        // limiting the data we show
        if (this.rowsNumber && this.rowsNumber != 0) {
            if (this.loadOptions && this.loadOptions["append"]) {
                this.currentRowsShown += parseInt(this.rowsNumber);
            } else {
                this.currentRowsShown = parseInt(this.rowsNumber);
            }
            serverCollection = collectionData.collection.slice(0, this.currentRowsShown);

            var collectionLength = _.isEmpty(collectionData.reportData.totalCount) ? collectionData.collection.length : collectionData.reportData.totalCount;

            if (this.currentRowsShown >= collectionLength) {
                this.$el
                    .parent()
                    .parent()
                    .find("[data-action=\"show-more\"]")
                    .parent()
                    .parent()
                    .hide();
            } else {
                if (
                    this.$el
                        .parent()
                        .parent()
                        .find("[data-action=\"show-more\"]").length === 0
                ) {
                    this.$el.addClass("list-view");
                    this.$el
                        .parent()
                        .after(
                            "<div><div class=\"block-footer\"><button data-action=\"show-more\" class=\"btn btn-link btn-invisible more padded\">" + app.lang.getAppString("LBL_MOBILE_SHOW_MORE") + "</button></div></div>"
                        );
                    this.$el
                        .parent()
                        .parent()
                        .find("[data-action=\"show-more\"]")
                        .click(this.showMoreRecords.bind(this));
                } else {
                    // display the "Show more..." button
                    this.$el
                        .parent()
                        .parent()
                        .find("[data-action=\"show-more\"]")
                        .parent()
                        .parent()
                        .show();
                }
            }
        } else {
            serverCollection = collectionData.collection;
        }

        this.serverResults = {
            fields: collectionData.fields,
            collection: serverCollection
        };
    },

    getCollectionData: function (serverData) {
        // building the collection rows with the data received from the report
        for (var j = 0; j < serverData.collection.length; j++) {
            var rows = [];

            for (var z = 0; z < serverData.collection[j].cells.length; z++) {
                var row = {};

                if (serverData.collection[j].cells[z].indexOf("<a") > -1) {
                    var newText = $(serverData.collection[j].cells[z]).text();
                    row.text = newText;
                } else {
                    row.text = serverData.collection[j].cells[z];
                }

                row.html = serverData.collection[j].cells[z];
                rows.push(row);
            }
            serverData.collection[j].rows = rows;
        }

        return serverData;
    },

    _render: function () {
        this._super("_render", arguments);

        this.$el.css("overflow-x", "auto");
        this.fixBwcLinks();

        this.showLoadingFeedback();
    },

    showMoreRecords: function () {
        var options = {
            append: true
        };

        this.getSavedReportById(this.options.meta.view.saved_report_id, options);
    },

    fixBwcLinks: function () {
        this.$el.find("a[href*=\"module=\"]").each(function goThroughElements(i, elem) {
            // App.view.views.BaseBwcView.prototype.convertToSidecarLink(elem);
        });
    },
});