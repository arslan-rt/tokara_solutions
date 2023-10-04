/* global app */

({
    reportModuleLC: "",

    initialize: function (options) {
        this._super("initialize", arguments);
        
        this.reportModuleLC = this.options.dashletParent.serverResults.keyPrefix;
        this.minTableWidth = options.minTableWidth;
        var grandTotalData = this.options.dashletParent.serverResults.grandTotal;

        this.columns = grandTotalData.columnNames;
        this.values = grandTotalData.columnValues;
    },

    render: function () {
        this._super("render", arguments);
    }
});