(function jsExtension(app) {
    SUGAR.mobile.extensions["wMobileCustomizationsReloader"] = {
        extendsFrom: {
            baseType: "login",
        },

        render() {
            let _renderResult = this._super("render", arguments);

            if (app.reloadCustomizationsNeeded) {
                app.reloadCustomizationsNeeded = false;
                window.location.reload();
            }

            return _renderResult;
        }
    };
})(SUGAR.App);