/* eslint-disable require-jsdoc */
class wMobileRouteHandler {
    constructor(wMobileBootLoader) {
        this.wMobileBootLoader = wMobileBootLoader;
        
        this.MOBILE = "Mobile";
        this.VIEW = "View";

        SUGAR.mobile.loadView = this.goToView.bind(this);
    }

    goToView(name, entityParams) {
        let _cleanedEntityParams = entityParams ? entityParams : {};
        let _entityName = this.getEntityName(name);
        let _globalEntityName = this.getGlobalName(name);
        let _viewToLoad = app.mobile.views[_globalEntityName];

        if (!_viewToLoad) {
            _globalEntityName = _entityName;
            _viewToLoad = app.mobile.views[_globalEntityName] || app.nomad.getViewClass(name);
            if (!_viewToLoad) {
                app.alert.show("wMobileApp-view-load-error", {
                    level     : "warning",
                    messages  : "The view: " + name + " cannot be loaded.",
                    autoClose : true
                });
                return false;
            }
        }

        if (!_cleanedEntityParams.skipRegistration) {
            let _currentUrl = app.navigation.manager.getCurrentStep().url;
            this.registerStepInHistory(_currentUrl);
        }

        _cleanedEntityParams["view"] = _viewToLoad;

        let _loadedView = app.controller.loadScreen(_cleanedEntityParams)[0];
        // set cached on false so that the layout gets disposed every time when leaving the screen
        _loadedView.layout.cached = false;

        //notifyButtonsChange
        SUGAR.customizationTools.mobileButtonsManager.handleViewChange();

        return _loadedView;
    }

    registerStepInHistory(url) {
    // this is a function that needs to be called if you navigate to another screen
    // simply call this to store the start page url in history so that you could go back to it
        var historyParams = {
            initiator: {
                name: "GENERIC"
            },
            url: url
        };
        historyParams = _.extend(historyParams, app.navigation.manager._getUrlInfo(historyParams.url));
        historyParams = _.extend({}, historyParams, {
            id             : ++app.navigation.manager._seedId,
            replaceCurrent : false
        });

        const upStepParams = app.navigation.manager._getUpStepParams(historyParams);

        _.extend(historyParams, upStepParams);

        app.navigation.history._previous = app.navigation.history._current;
        app.navigation.history._steps.push(app.navigation.history._current);
        app.navigation.history._current = _.omit(historyParams, "replaceCurrent");
        app.navigation.history._syncBrowserHistory();
    }

    routeRegisterView(globalViewName, templateName) {
        var self = this;

        let _viewRoute = {
            name  : templateName,
            steps : globalViewName,
            handler() {
                self.goToView(globalViewName);
            }
        };

        this.wMobileBootLoader.customizationTools.customization.registerRoutes([_viewRoute]);
    }

    reloadLoginView() {
        let _currentScreen = app.controller.getScreenContext();

        // reload current view
        if (_currentScreen.root === undefined) {
            app.controller.clean({
                disposeAll: true
            });

            app.controller.loadScreen({
                context: new app.Context({
                    module: "Login"
                }).prepare(),
                view: app.nomad.getViewClass("login")
            });
        } else {
            app.controller.navigate("#Search");
        }
    }

    getEntityName(name) {
        return (name.charAt(0).toUpperCase() + name.slice(1)).replace(/-/g, "");
    }

    getGlobalName(name) {
        return this.MOBILE + this.getEntityName(name) + this.VIEW;
    }
}
module.exports.wMobileRouteHandler = wMobileRouteHandler;