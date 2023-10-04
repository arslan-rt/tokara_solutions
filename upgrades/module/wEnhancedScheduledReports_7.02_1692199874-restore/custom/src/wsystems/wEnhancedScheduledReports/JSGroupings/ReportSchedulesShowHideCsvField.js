// eslint-disable-next-line
; (function ReportSchedulesShowHideCsvField(app) {
    var createViewExtension = {
        initialize: function (options) {
            var parent = this._super("initialize", arguments);
            
            this.listenTo(this.model, "change:report", _.bind(this._showHideCsvField, this));

            return parent;
        },

        _showHideCsvField: function () {
            if (this.name === "create" && this.model.get("report").report_type !== "tabular") {
                this.$el.find("[data-name=\"export_report_to_csv\"]").css("visibility", "hidden");
            } else {
                this.$el.find("[data-name=\"export_report_to_csv\"]").css("visibility", "visible");
            }

            if (this.name === "record") {
                this._checkReportScheduledType();
            }
        },

        _checkReportScheduledType: function () {
            var _apiURL = app.api.buildURL("wEnhancedScheduledReports", "get/report/schedules");

            var scheduledReportsRecordId = "";

            scheduledReportsRecordId = this.model.get("report_id");

            var _data = {
                recordId: scheduledReportsRecordId
            };
            var _options = {
                skipMetadataHash: true
            };

            var _callback = {
                success: this._showHideCsvFieldOnRecordView.bind(this)
            };

            app.api.call("create", _apiURL, _data, _callback, _options);

        },

        _showHideCsvFieldOnRecordView: function (data) {
            if (this.disposed === true) {
                return;
            }

            if (data.success === true) {
                this.$el.find("[data-name=\"export_report_to_csv\"]").css("visibility", "visible");
            } else {
                this.$el.find("[data-name=\"export_report_to_csv\"]").css("visibility", "hidden");
            }
        },

        _renderFields: function() {
            var _parent = this._super("_renderFields", arguments);

            var userType = app.user.get("type");
            var readOnlyFields = ["export_report_to_csv", "show_report_in_body"];
            if (userType !== "admin"){
                _.each(this.fields, function parseFields(field) {
                    if (_.isEmpty(field)){
                        return;
                    } 
    
                    if (readOnlyFields.indexOf(field.name) >= 0) {
                        field.def.readonly = true;
                    }
                }.bind(this));
            }

            return _parent;
        },

    };

    app.events.once("app:sync:complete", function ReportSchedulesShowHideCsvFieldExtention() {
        app.wsystems.wEnhancedScheduledReports.extendComponent("base", "ReportSchedules", "view", "create", createViewExtension);
        app.wsystems.wEnhancedScheduledReports.extendComponent("base", "ReportSchedules", "view", "record", createViewExtension);
    });
})(SUGAR.App);
