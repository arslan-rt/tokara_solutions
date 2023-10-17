// eslint-disable-next-line
; (function (app) {
    app.events.on("app:init", function alertPlugin() {
        /**
         * Default closing state for alerts.
         * 
         * - True to automatically close themselves, after the auto close delay elapses.
         * - False to be visible unless the user doesn't want to anymore.
         * 
         * @var {Boolean}
         */
        var _alertAutoClose = true;

        /**
         * Default time for an alert to be visible.
         * 
         * @var {Boolean}
         */
        var _alertAutoCloseDelay = 3000;

        /**
         * Builds alert definition.
         * This method cannot be used for `loading` or `confirmation` alerts.
         * 
         * @param {String} level 
         * @param {String} message 
         * @param {Boolean} autoClose 
         * @param {Integer} autoCloseDelay 
         * 
         * @return {Object}
         */
        var _alertBuildDef = function (level, message, autoClose, autoCloseDelay) {
            return {
                "level"            : level,
                "messages"         : message,
                "autoClose"        : _.isBoolean(autoClose) === true ? autoClose : _alertAutoClose,
                "autoCloseTimeout" : _.isNumber(autoCloseDelay) === true ? autoCloseDelay : _alertAutoCloseDelay,
            };
        };

        app.plugins.register("QualiaIntegration_Alert", ["field", "view", "layout"], {
            /**
             * @param {String} level 
             * @param {String} message 
             * @param {Boolean} autoClose 
             * @param {Integer} autoCloseDelay  
             * 
             * @return {Undefined}
             */
            alertSuccess: function (id, message, autoClose, autoCloseDelay) {
                app.alert.show(id, _alertBuildDef("success", message, autoClose, autoCloseDelay));
            },

            /**
             * @param {String} level 
             * @param {String} message 
             * @param {Boolean} autoClose 
             * @param {Integer} autoCloseDelay  
             * 
             * @return {Undefined}
             */
            alertError: function (id, message, autoClose, autoCloseDelay) {
                app.alert.show(id, _alertBuildDef("error", message, autoClose, autoCloseDelay));
            },

            /**
             * @param {String} level 
             * @param {String} message 
             * @param {Boolean} autoClose 
             * @param {Integer} autoCloseDelay  
             * 
             * @return {Undefined}
             */
            alertWarning: function (id, message, autoClose, autoCloseDelay) {
                app.alert.show(id, _alertBuildDef("warning", message, autoClose, autoCloseDelay));
            },

            /**
             * @param {String} level 
             * @param {String} message 
             * @param {Boolean} autoClose 
             * @param {Integer} autoCloseDelay  
             * 
             * @return {Undefined}
             */
            alertInfo: function (id, message, autoClose, autoCloseDelay) {
                app.alert.show(id, _alertBuildDef("info", message, autoClose, autoCloseDelay));
            },

            /**
             * @param {String} level 
             * @param {String} message 
             * 
             * @return {Undefined}
             */
            alertLoading: function (id, message) {
                app.alert.show(id, {
                    "level" : "process",
                    "title" : app.lang.get(message),
                });
            },

            /**
             * @param {String} level 
             * @param {String} message 
             * @param {Function} onConfirm 
             * @param {Function} onCancel  
             * 
             * @return {Undefined}
             */
            alertConfirm: function (id, message, onConfirm, onCancel) {
                app.alert.show(id, {
                    "level"     : "confirmation",
                    "messages"  : app.lang.get(message),
                    "autoClose" : false,
                    "onConfirm" : onConfirm,
                    "onCancel"  : onCancel
                });
            },

            /**
             * @param {String} id
             * 
             * @return {Undefined}
             */
            alertDismiss: function (id) {
                app.alert.dismiss(id);
            },

            /**
             * @return {Undefined}
             */
            alertDismissAll: function () {
                app.alert.dismissAll();
            }
        });
    });
})(SUGAR.App);
