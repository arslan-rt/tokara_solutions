// eslint-disable-next-line
; (function registerRoutes(app) {
    app.events.on("router:init", function addRoutes() {
        /**
         * Module name to access the custom layout for
         */
        var module = null;

        /**
         * Checks the custom layout accessibility.
         * 
         * @param {Object} layoutMeta 
         * 
         * @return {Boolean}
         */
        var checkLayoutACL = function (layoutMeta) {
            if (layoutMeta.adminAcl === true) {
                return app.acl.hasAccessToAny("admin");
            }

            return true;
        };

        var callback = function (layoutName) {
            var layoutMeta = app.metadata.getLayout(module, layoutName);

            /**
             * Only render the view if the current user is allowed to access it.
             */
            if (checkLayoutACL(layoutMeta) === true) {
                var previousLayout = app.controller.context.get("layout");

                /**
                 * Only open drawer as long as this action is manually made from the Administration panel.
                 * In case the page is refreshed while the drawer is opened, we just load the needed view.
                 */
                if (
                    _.isEmptyValue(previousLayout) === false
                    && previousLayout !== "login"
                    && layoutMeta.drawer === true
                ) {
                    var drawerDef = {
                        "layout": layoutName,
                    };
                    var drawerCallback = function () {
                        var fragment = app.router._previousFragment || app.router.buildRoute("Administration");

                        app.router.navigate(fragment, {
                            "trigger": false
                        });
                    };

                    app.drawer.open(drawerDef, drawerCallback);
                } else {
                    app.controller.loadView({
                        "layout" : layoutName,
                        "module" : module
                    });
                }
            } else {
                app.controller.loadView({
                    "layout"    : "error",
                    "errorType" : "404", // Error types => [400, 404, 422, 500, 502, 503]
                    "module"    : "Error",
                    "create"    : true,
                });
            }
        };

        var routes = [
            {
                "route"    : "QualiaIntegration/qualia/admin/panel",
                "name"     : "QualiaIntegration-qualia-admin-panel",
                "callback" : function () {
                    callback("qualia-admin-panel");
                }
            },
        ];

        app.router.addRoutes(routes);
    });
})(SUGAR.App);
