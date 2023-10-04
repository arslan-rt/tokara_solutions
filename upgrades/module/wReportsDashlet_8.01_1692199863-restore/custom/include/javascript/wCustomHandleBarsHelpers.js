/* global SUGAR, _, App, Handlebars */

(function extendFunctionality(app) {
    app.events.on("app:sync:complete", function extendOnInit() {
        Handlebars.registerHelper("lookupProp", function goThroughProps(obj, key) {
            return obj[key];
        });
    });
})(SUGAR.App);
