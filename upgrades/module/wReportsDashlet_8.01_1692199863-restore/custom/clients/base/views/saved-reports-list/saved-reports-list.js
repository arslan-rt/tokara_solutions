/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
({
    plugins                 : ["Dashlet"],
    reportData              : undefined,
    chartField              : undefined,
    reportOptions           : undefined,
    reportsData             : undefined,
    timerId                 : undefined,
    rowsNumber              : undefined,
    displayTotal            : undefined,
    showDrilldownButton     : undefined,
    currentRowsShown        : 0,
    loadOptions             : false,
    reportType              : undefined,
    isSummary               : false,
    selectedReportIsSummary : false,
    dataLoaded              : false,
    defDisplayColumns       : {},
    SORT_SEPARATOR          : "::",
    /**
     * False if no sort is applied on the list | the object with definition of the sort
     * Ex: {
     *        name:      "first_name",
     *        table_key: "self",
     *        sort_dir:  "a"
     *    }
     */
    sort                    : false,
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
    availableSort           : {},

    events: {
        "click a[name=editReport]"                     : "editSavedReport",
        "click #drill_button"                          : "drillAction",
        "click [data-fieldname=\"intelligent\"] input" : "setIntelligence",
        "click th[data-fieldname][data-orderby]"       : "sortList",
    },

    initDashlet: function (view) {
        if (this.meta.config) {
            this.meta.panels = this.dashletConfig.dashlet_config_panels;

            // by default we want to show summary and total count
            if (!this.settings.has("show_summary")) {
                this.settings.set({
                    // eslint-disable-next-line camelcase
                    show_summary: true
                });
            }

            if (!this.settings.has("show_total_count")) {
                this.settings.set({
                    // eslint-disable-next-line camelcase
                    show_total_count: true
                });
            }

            this.layout.before("dashletconfig:save", function dashletConfig() {
                if (this.settings.get("intelligent") && this.settings.get("linked_fields") === "") {
                    app.alert.show("linkedFieldNotSet", {
                        level     : "error",
                        title     : "Linked field not set",
                        messages  : "Please select a linked field, as the report is related to the current record",
                        autoclose : true
                    });

                    return false;
                }
                return true;
            }, this);

            this.getAllSavedReports();

            this.settings.on("change:saved_report_id", this._updateDisplayColumns.bind(this));
            this.settings.on("change:saved_report_id", this._updateSortField.bind(this));
        } else {
            this.getDashletDef();
            // setting initial values
            var autoRefresh = this.settings.get("auto_refresh");
            this.rowsNumber = this.settings.get("display_rows") ? this.settings.get("display_rows") : 0;
            this.showDrilldownButton = this.settings.get("show_drilldown_button");
            this.displayTotal = this.settings.get("show_total_count");
            this.showSummary = this.settings.get("show_summary");

            if (autoRefresh > 0) {
                if (this.timerId) {
                    clearTimeout(this.timerId);
                }

                var autoRefreshTimer = 1000;
                var secondsInMinute = 60;
                this._scheduleReload(autoRefresh * autoRefreshTimer * secondsInMinute);
            }
        }
    },

    getDashletDef: function () {
        var reportBean = App.data.createBean("Reports", {
            id: this.settings.get("saved_report_id")
        });

        reportBean.fetch({
            success: function getDisplayColumnsData(dashletData) {
                this.defDisplayColumns = JSON.parse(dashletData.get("content")).display_columns;
            }.bind(this)
        });
    },
    
    _updateDisplayColumns: function () {
        var columnsField = this.getField("display_columns");
        if (this.reportsData[this.settings.attributes.saved_report_id] != "tabular") {
            columnsField.$el.parent().parent().hide(); //hide the field and label
            return;
        }
        var availableColumns = this._getAvailableColumns();
        columnsField.$el.parent().parent().show(); //show the field and label
        if (columnsField) {
            columnsField.items = availableColumns;
        }
        this.settings.set("display_columns", _.keys(availableColumns));
    },

    _updateSortField: function () {
        var sortField = this.getField("sort");
        if (this.reportsData[this.settings.attributes.saved_report_id] != "tabular") {
            this.settings.set("sort", ""); // disable sort
            this.sort = false; // disable sort
            sortField.$el.parent().parent().hide(); //hide the field and label
            return;
        }

        var tempAvailableSort = this.reportsContents[this.settings.attributes.saved_report_id].display_columns;
        this.availableSort = {};
        var sortKey;
        _.each(tempAvailableSort, function iterateOnColumns(column) {
            var newSort = _.extend({}, column);
            newSort.label = newSort.label + " Asc";
            // eslint-disable-next-line camelcase
            newSort.sort_dir = "a";
            sortKey = newSort.name + this.SORT_SEPARATOR + newSort.table_key + this.SORT_SEPARATOR + newSort.sort_dir;
            this.availableSort[sortKey] = newSort;

            newSort = _.extend({}, column);
            newSort.label = newSort.label + " Desc";
            // eslint-disable-next-line camelcase
            newSort.sort_dir = "d";
            sortKey = newSort.name + this.SORT_SEPARATOR + newSort.table_key + this.SORT_SEPARATOR + newSort.sort_dir;
            this.availableSort[sortKey] = newSort;
        }.bind(this));
        var availableSortOptions = {};
        var availableSortKeys = _.keys(this.availableSort);
        _.each(availableSortKeys, function iterateOnDifferentSortTypes(optionKey) {
            availableSortOptions[optionKey] = this.availableSort[optionKey].label;
        }.bind(this));

        sortField.$el.parent().parent().show(); //show the field and label
        if (sortField) {
            sortField.items = availableSortOptions;
        }
        this.settings.set("sort", "");
        this.sort = false;
    },

    _configureDashlet: function () {
        if (this.meta.config) {
            if (this.reportsData[this.settings.attributes.saved_report_id] == "tabular") {
                var availableColumns = this._getAvailableColumns();
                var columnsField = this.getField("display_columns");
                columnsField.options = availableColumns;
                if (columnsField) {
                    columnsField.items = availableColumns;
                }
                var previousDisplayColumns = this.settings.get("display_columns");
                this.settings.set("display_columns", []);
                this.settings.set("display_columns", previousDisplayColumns);

                var initialSort = this.settings.get("sort");
                this._updateSortField();
                this.settings.set("sort", initialSort);

            } else {
                this._updateSortField();
                this._updateDisplayColumns();
            }
        } else {
            this.sort = this.settings.get("sort");
        }
    },

    _getAvailableColumns: function () {
        var columns = {},
                module = this.reportsModules[this.settings.attributes.saved_report_id];
        if (!module) {
            return columns;
        }

        var reportSelected = this.reportsContents[this.settings.attributes.saved_report_id];

        _.each(this.getFieldMetaForView(module), function iterateOnFields(field) {
            var fieldModule = reportSelected.full_table_list[field.table_key].module;
            var columnUniqueKey = field.table_key + this.SORT_SEPARATOR + field.name;
            columns[columnUniqueKey] = app.lang.get(field.label || field.name, fieldModule);
        }.bind(this));

        return columns;
    },

    getFieldMetaForView: function (module) {
        return this.reportsContents[this.settings.attributes.saved_report_id].display_columns;
    },

    drillAction: function () {
        window.open("#bwc/index.php?module=Reports&action=DetailView&record=" + this.settings.get("saved_report_id"));
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
        app.view.View.prototype.initialize.call(this, options);
    },

    editSavedReport: function () {
        var currentTargetId = this.dashModel.get("saved_report_id");
        // This actionFlag is used to change the action after retrieve, from ReportCriteriaResults to ReportsWizard in order
        // to open the record in edit mode
        var actionFlag = "&wReportsDashletRedirectEdit=1";

        var bwcPath = "#bwc/index.php?action=ReportCriteriaResults&module=Reports&page=report&id=";
        var route = bwcPath + currentTargetId + actionFlag;

        if (!currentTargetId) {
            return;
        }

        window.open(route, "_blank");
    },

    postEditListener: function (event) {
        if (this.currentLocation) {
            app.router.navigate(this.currentLocation, {
                trigger: true
            });
        }
    },

    /**
     * Returns object with linked fields.
     *
     * @param {String} moduleName Name of module to find linked fields with.
     * @return {Object} Hash with linked fields labels.
     */
    getLinkedFields: function (moduleName) {
        var reportModule = this.reportsModules[this.settings.get("saved_report_id")];
        var modelModule = this.model.module;
        if (typeof modelModule == "undefined") {
            modelModule = this.model.attributes.module;
        }
        var fieldDefs = app.metadata.getModule(modelModule).fields;
        var relates = _.filter(
            fieldDefs,
            function findRelates(field) {
                if (!_.isUndefined(field.type) && field.type === "link") {
                    if (app.data.getRelatedModule(this.model.module, field.name) === reportModule) {
                        return true;
                    }
                }
                return false;
            },
            this
        );
        var result = {
            "": "" //default not set value
        };
        _.each(
            relates,
            function getResult(field) {
                result[field.name] = app.lang.get(field.vname || field.name, [this.model.module, moduleName]);
            },
            this
        );

        return result;
    },

    setLinkedFields: function () {
        var linkedField = _.find(this.fields, function getLinkedField(field) {
            return field.name == "linked_fields";
        });

        if (linkedField) {
            var linkedFields = this.getLinkedFields();
            linkedField.items = linkedFields;

            var linkedFieldsProperty = _.property(this.settings.get("linked_fields"))(linkedField.items);

            if (_.isUndefined(linkedFieldsProperty) === true) {
                this.settings.set("linked_fields", "");
            }

            linkedField._render();
            if (!this.settings.get("linked_fields")) {
                this.settings.set("linked_fields", _.keys(linkedFields)[0]);
                linkedField.$el.find(".select2-container").select2("data", {
                    id   : this.settings.get("linked_fields"),
                    text : linkedFields[this.settings.get("linked_fields")]
                });
            }
        }
    },

    bindDataChange: function () {
        if (this.meta.config) {
            this.settings.on(
                "change:saved_report_id",
                function reportChangedCallback(model) {
                    var reportTitle = this.reportOptions[model.get("saved_report_id")];
                    this.settings.set({
                        label: reportTitle
                    });
                    $("[name=\"label\"]").val(reportTitle);
                    this.setLinkedFields();
                },
                this
            );
        }
    },

    loadData: function (options) {
        options = options || {};

        if (this.settings.get("saved_report_id")) {
            this.getSavedReportById(this.settings.get("saved_report_id"), options);
        }
    },

    /**
     * Rows and Columns sort feature
     */
    sortList: function (e) {
        var fieldNameToSortOn = e.currentTarget.dataset.fieldname;
        var tableKeyToSortOn = e.currentTarget.dataset.tablekey;
        var sortDirection = e.currentTarget.dataset.sortdirection;
        if (sortDirection == "a") {
            sortDirection = "d";
        } else {
            sortDirection = "a";
        }
        this.sort = {
            name      : fieldNameToSortOn,
            table_key : tableKeyToSortOn, //eslint-disable-line camelcase
            sort_dir  : sortDirection, //eslint-disable-line camelcase
            forceSort : true
        };
        this.loadData();
    },

    getAllSavedReports: function () {
        var url = app.api.buildURL("wReportsDashlet", "list/reports");

        app.alert.show("query-list-reports", {
            level : "process",
            title : app.lang.getAppString("LBL_WREPORTSDASHLET_RETRIEVING_REPORTS") 
        });

        app.api.call("read", url, null, {
            success: _.bind(this.parseAllSavedReports, this)
        });
    },

    parseAllSavedReports: function (reports) {
        app.alert.dismiss("query-list-reports");
        
        if (_.isUndefined(reports.status) === false && reports.status === "failed") {
            App.alert.show("saved-report-error", {
                level     : "error",
                messages  : app.lang.getAppString(reports.message) + reports.reportId,
                autoClose : false
            });

            return;
        }
        
        this.reportOptions = {};
        this.reportsData = {};
        this.reportsModules = {};
        this.reportsContents = {};

        _.each(
            reports,
            function parseRep(report) {
                this.reportsData[report.id] = report.report_type;
                this.reportOptions[report.id] = report.name;
                this.reportsModules[report.id] = report.module;
                this.reportsContents[report.id] = JSON.parse(report.content);
            },
            this
        );

        var reportsField = _.find(this.fields, function parseRepFields(field) {
            return field.name == "saved_report_id";
        });

        if (reportsField) {
            if (reports && !this.settings.has("saved_report_id")) {
                this.settings.set({
                    // eslint-disable-next-line camelcase
                    saved_report_id: _.first(reports).id
                });

                this.handleViewElements(this.reportsData[_.first(reports).id]);
            } else if (reports && this.settings.has("saved_report_id")) {
                this.handleViewElements(this.reportsData[reportsField.value]);
            }

            reportsField.$el.on(
                "select2-selecting",
                function updateView(event) {
                    var reportId = "";

                    // eslint-disable-next-line no-negated-condition
                    if (typeof event.choice != "undefined") {
                        reportId = event.choice.id;
                    } else {
                        reportId = event.val;
                    }

                    if (reportId) {
                        var reportType = this.reportsData[reportId];

                        this.handleViewElements(reportType);
                    }
                }.bind(this)
            );

            reportsField.items = this.reportOptions;
            reportsField._render();
        }

        this.setLinkedFields();
        this._configureDashlet();

    },

    setIntelligence: function () {
        var field = this.getField("linked_fields");
        var fieldEl = false;

        if (!field) {
            return;
        }

        var intelligent = 0;
        var intelligentElement = this.$el.find("[data-fieldname=\"intelligent\"]");
        var checkboxElement = this.$el.find("[data-fieldname=\"intelligent\"] input");

        intelligent = checkboxElement.is(":checked");

        fieldEl = this.$el.find("[data-name=linked_fields]");
        if (intelligent == 1) {
            fieldEl.show();
        } else {
            fieldEl.hide();
        }

        var contextAttr = App.controller.context.attributes;
        if (contextAttr.dataView !== "record") {
            intelligentElement.parent().hide();
            fieldEl.parent().hide();
        }

        this.getAllSavedReports();
    },

    handleViewElements: function (reportType) {
        if (reportType && reportType === "detailed_summary") {
            this.$el.find("[data-name=display_rows]").hide();
            this.$el.find("[data-name=show_summary]").show();
        } else if (reportType && reportType === "tabular") {
            this.$el.find("[data-name=display_rows]").show();
            this.$el.find("[data-name=show_summary]").hide();
        } else {
            this.$el.find("[data-name=display_rows]").hide();
            this.$el.find("[data-name=show_summary]").hide();
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
        var loadingIcon = this.layout.$el.find("i[data-action=\"loading\"]");
        loadingIcon.removeClass("fa-refresh fa-spin");
    },

    getSavedReportById: function (reportId, options) {
        this.dataLoaded = false;
        this.showLoadingFeedback();

        this.loadOptions = options;
        var dt = this.layout.getComponent("dashlet-toolbar");

        if (dt) {
            this.$("[data-action=loading]")
                .removeClass(dt.cssIconDefault)
                .addClass(dt.cssIconRefresh);
        }

        var contextAttr = App.controller.context.attributes;
        var forceRefresh = options.complete ? true : false;

        var reqData = {
            reportId            : reportId,
            forceRefresh        : forceRefresh,
            usePaging           : this.rowsNumber != 0,
            linkToCurrentRecord : this.settings.get("intelligent")
        };

        if (this.settings.get("sort")) {
            if (this.sort == false || (this.sort != false && !this.sort.forceSort)) {
                var sortConfiguration = this.settings.get("sort");
                sortConfiguration = this.settings.get("sort").split(this.SORT_SEPARATOR);
                // eslint-disable-next-line
                if (sortConfiguration.length === 3) {
                    this.sort = {
                        name      : sortConfiguration[0],
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

        if (contextAttr.dataView === "record") {
            reqData["linkField"] = this.settings.get("linked_fields");
            reqData["link"] = contextAttr.module.toLowerCase();
            reqData["module"] = this.module;
            reqData["contextId"] = contextAttr.modelId;
            reqData["contextName"] = contextAttr.model.get("name") || contextAttr.model.get("full_name");
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
                        level     : "error",
                        messages  : app.lang.getAppString(serverData.message) + serverData.reportId,
                        autoClose : false
                    });

                    this.hideLoadingFeedback();

                    return;
                }

                this.createDashletView(serverData, options);
            }, this),
            complete: options ? options.complete : null
        });
    },

    createBaseDashlet: function (serverData, options) {},

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

                var initialTitle = this.settings.get("label");
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
            this.addPrintAction();
        }
    },

    addPrintAction: function () {
        var toolbar = this.layout.getComponent("dashlet-toolbar");

        if (toolbar && toolbar.$el) {
            if (toolbar.$el.find(".dashletReportPrintContent").length === 0) {
                toolbar.$el
                    .find(".dropdown-menu.left")
                    .append(
                        "<li role=\"menuitem\"><span class=\"dashlet-toolbar\"><a class=\"dashletReportPrintContent\">" + app.lang.getAppString("LBL_PRINT") + "</a></span></li>"
                    );

                var printButton = toolbar.$el.find(".dashletReportPrintContent");

                printButton.click(this.printContent.bind(this));
            }
        }
    },

    printContent: function () {
        var wPrintWindow = window.open(
            "",
            "wPrintDashletContent",
            "scrollbars=yes,menubar=no,resizable=yes,toolbar=no,location=no,status=no"
        );
        var head =
            "<head>" +
            "<link rel=\"stylesheet\" href=\"cache/themes/clients/base/default/sugar_59d785a699b9036be05cf5ae36411a93.css?v=NDZq21b7_V0TWvcCY4J40w\">" +
            "</head>";

        var textDecoration = this.$el.find("a").css("text-decoration");
        this.$el.find("a").css("text-decoration", "none");

        var textColor = this.$el.find("a").css("color");
        this.$el.find("a").css("color", "black");
        this.$el.find("img").hide();
        this.$el.find("#drilldownButtonTable").hide();

        var contentHtml = "<html>" + head + "<body>" + this.$el.html() + "</body></html>";

        this.$el.find("a").css("text-decoration", textDecoration);
        this.$el.find("a").css("color", textColor);
        this.$el.find("img").show();
        this.$el.find("#drilldownButtonTable").show();

        wPrintWindow.document.open();
        wPrintWindow.document.write(contentHtml);

        var timeoutInterval = 1000;

        setTimeout(
            _.bind(function printDocument() {
                wPrintWindow.document.close();
                wPrintWindow.focus();
                wPrintWindow.print();
                wPrintWindow.close();
            }, this),
            timeoutInterval
        );
    },

    buildRowsAndColumnsView: function () {
        var rowColumnView = app.view.createView({
            name          : "saved-report-list-rows-columns",
            model         : this.model,
            context       : this.context,
            dashletParent : this
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
                            name        : "saved-report-list-summary-header",
                            model       : this.model,
                            context     : this.context,
                            collection  : reportData.collection[col],
                            headerIndex : 1,
                            showSummary : reportData.showSummary,
                            title       : reportData.collection[col]["header"],
                            dashletParent: this
                        });

                        groupView.render();
                        this.$el.find("#saved_report_list_contents").append(groupView.$el);
                    }
                }
            }/*eslint-enable*/
        } else {
            var headerRow = app.view.createView({
                name          : "saved-report-list-summary-row",
                model         : this.model,
                context       : this.context,
                collection    : reportData.collection,
                dashletParent : this
            });

            headerRow.render();
            this.$el.find("#saved_report_list_contents").append(headerRow.$el);
        }

        this.$el.addClass("list-view");

        // showing the grandTotal if the user wants so
        if (!_.isEmpty(reportData.grandTotal) && reportData.displayTotal === true) {
            var subTables = this.$el.find("#saved_report_list_contents").children();
            var tableParent = subTables[subTables.length - 1];
            var subTableElement = tableParent.children[0];
            var tableId = subTableElement ? subTableElement.id : "id";
            var tableElement = this.$el.find("#" + tableId);

            this.minTableWidth = tableElement.css("width");

            var grandTotalView = app.view.createView({
                name           : "saved-report-list-grand-total",
                model          : this.model,
                context        : this.context,
                grandTotalData : reportData.grandTotal,
                minTableWidth  : this.minTableWidth,
                dashletParent  : this
            });

            grandTotalView.render();
            this.$el.find("#saved_report_list_contents").append(grandTotalView.$el);
        }
    },

    formatSimpleSummaryReportData: function (reportData, formattedCollection, entries, keys) {
        var self = this;
        // format the report data received to meet the summary report type necessities
        if (reportData.wIsData) {
            formattedCollection[entries].unshift(Object.keys(reportData).length - 1);

            entries = entries + 1;

            return {
                formattedCollection : formattedCollection,
                entries             : entries
            };
        } else {
            _.each(reportData, function formatData(data, key) {
                if (!formattedCollection[entries]) {
                    formattedCollection[entries] = [];

                    for (var keyIndex = 0; keyIndex < keys.length; keyIndex++) {
                        formattedCollection[entries].unshift(keys[keyIndex]);
                    }
                }

                formattedCollection[entries].unshift(key);

                keys.unshift(key);

                var returnData = self.formatSimpleSummaryReportData(data, formattedCollection, entries, keys);
                formattedCollection = returnData.formattedCollection;
                entries = returnData.entries;

                keys.splice(-1, 1);
            });
        }

        return {
            formattedCollection : formattedCollection,
            entries             : entries
        };
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
            isSummationWithDetails : reportData.isSummationWithDetails,
            fields                 : reportData.fields,
            collection             : serverCollection,
            grandTotal             : reportData.grandTotal,
            total                  : reportData.total,
            headers                : reportData.headers,
            headerTitles           : reportData.headerTitles,
            keyPrefix              : reportData.reportData.module.toLowerCase(),
            displayTotal           : this.displayTotal,
            showSummary            : this.showSummary
        };
    },

    formatRowsAndColumnsResults: function (collectionData) {
        var serverCollection = [],
                i;

        if (
            collectionData.collection.length > this.settings.get("display_rows")
            && this.currentRowsShown > 0
        ) {
            collectionData.collection = collectionData.collection.slice(0, this.currentRowsShown);
        }

        //only show columns from Display Columns, in the order they are there
        var displayColumns = this.settings.attributes.display_columns;

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

            if (
                this.serverResults 
                && this.serverResults.collection.length > 0
                && this.currentRowsShown !== parseInt(this.settings.get("display_rows"))
            ) {
                serverCollection = this.serverResults.collection;
                serverCollection = serverCollection.concat(collectionData.collection.slice(0, this.settings.get("display_rows")));
            } else {
                serverCollection = collectionData.collection.slice(0, this.currentRowsShown);
            }

            var collectionLength = _.isEmpty(collectionData.reportData.totalCount) ? collectionData.collection.length : collectionData.reportData.totalCount;

            if (this.currentRowsShown >= collectionLength) {
                this.$el.addClass("list-view");
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
            fields     : collectionData.fields,
            collection : serverCollection
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
        if (this.meta.config || _.isUndefined(this.chartField)) {
            app.view.View.prototype._render.call(this);
        }

        this.$el.css("overflow-x", "auto");
        this.fixBwcLinks();

        if (this.meta.config) {
            this.setIntelligence();
        } else {
            this.showLoadingFeedback();
        }
    },

    showMoreRecords: function () {
        var options = {
            append: true
        };

        this.getSavedReportById(this.settings.get("saved_report_id"), options);
    },

    fixBwcLinks: function () {
        this.$el.find("a[href*=\"module=\"]").each(function goThroughElements(i, elem) {
            // App.view.views.BaseBwcView.prototype.convertToSidecarLink(elem);
        });
    },

    _renderField: function (field) {
        app.view.View.prototype._renderField.call(this, field);
        if (_.isUndefined(this.chartField) && field.name == "chart") {
            this.chartField = field;
        }
    }
});