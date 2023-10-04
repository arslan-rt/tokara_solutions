(function jsExtensionListView(app) {
    let headerViews = ["header", "headerEdit"];

    headerViews.forEach(headerViewName => {
        let uniqueViewId = app.utils.generateUUID();

        SUGAR.mobile.extensions["addHeaderViewActionEvents" + uniqueViewId] = {
            extendsFrom: {
                baseType: headerViewName
            },

            _processAction(e, actionName, options) {
                app.controller.trigger("header-view-action", { name: actionName, options });

                return this._super("_processAction", arguments);
            },

            onAfterShow() {
                app.controller.trigger("header-view-attached", { headerView: this });

                return this._super("onAfterShow", arguments);
            }
        };
    });
})(SUGAR.App);