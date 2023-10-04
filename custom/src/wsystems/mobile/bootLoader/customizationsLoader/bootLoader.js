/* eslint-disable require-jsdoc */
(function bootLoad(app) {
    class wMobileBootLoader {
        constructor() {
            this.declareProperties();
        }

        declareProperties() {
            this.BASE_FILE_PATH = "src/wsystems/mobile/include/require/wMobileApp/";

            this.VIEW_LOADER = "wMobileViewLoader";
            this.FIELD_LOADER = "wMobileFieldLoader";
            this.DASHLET_LOADER = "wMobileDashletLoader";
            this.ROUTE_HANDLER = "wMobileRouteHandler";

            this.ENTITIES_MAPPING = {
                "views"    : "wMobileViewLoader",
                "fields"   : "wMobileFieldLoader",
                "dashlets" : "wMobileDashletLoader",
            };

            this.customizationTools = app.NomadController.prototype.getCustomizationTools();
        }

        applyExtensions(extensions) {
            const baseExtensions = _.filter(extensions, function getBaseExtensions(extensionData){
                return extensionData.extendsFrom.module === undefined;
            });
            
            const customExtensions = _.filter(extensions, function getBaseExtensions(extensionData){
                return typeof extensionData.extendsFrom.module === "string";
            });

            this.enhanceClasses(baseExtensions);
            this.enhanceClasses(customExtensions);
        }

        enhanceClasses(extensions) {
            _.each(extensions, function handleExtension(extensionData) {
                let _baseType = extensionData.extendsFrom.baseType;

                if (this.isBaseField(_baseType)) {
                    this.wMobileFieldLoader.extend(_baseType, extensionData);
                } else if (this.isBaseDashlet(_baseType)) {
                    this.wMobileDashletLoader.extend(_baseType, extensionData);
                } else if (this.isBaseView(_baseType)) {
                    this.wMobileViewLoader.extend(_baseType, extensionData);
                }
            }, this);
        }

        loadMobileCustomizations() {
            _.each(
                SUGAR.mobile,
                function handleEntity(entities, entityName) {
                    if (this.ENTITIES_MAPPING[entityName]) {
                        this[this.ENTITIES_MAPPING[entityName]].load(entities);
                    }
                },
                this
            );

            // reload main menu after all of our customizations have been loaded
            if (app.nomad.mainMenu) {
                app.nomad.mainMenu.dispose();
            }
            
            delete app.nomad.mainMenu;
            app.nomad._syncedAppStart();

            // trigger an event, notifying all the listeners that we have completely loaded the customizations
            app.controller.trigger("wmobile:customizations:loaded");
        }

        loadFloatingButtons() {
            let _widgets = SUGAR.mobile.widgets;
            let _buttonsTemplates = _widgets.mobileButtonsManager.templates;

            let _mobileButtonsManager = new _widgets.mobileButtonsManager.controller(
                _buttonsTemplates.mobileButtonsContainer,
                _buttonsTemplates.mobileMasterButton
            );

            SUGAR.customizationTools.mobileButtonsManager = _mobileButtonsManager;
        }

        loadManagers() {
            this.loadRequired(this.ROUTE_HANDLER);
            this.loadRequired(this.VIEW_LOADER);
            this.loadRequired(this.FIELD_LOADER);
            this.loadRequired(this.DASHLET_LOADER);
        }

        loadRequired(className) {
            let _requiredClass = window.require(this.BASE_FILE_PATH + className)[className];
            this[className] = new _requiredClass(this);
        }

        declareGlobals() {
            SUGAR.customizationTools = this.customizationTools;
            SUGAR.customizationTools.wMobileBootLoader = this;

            SUGAR.mobile.getView = function getView(viewName) {
                return SUGAR.customizationTools.sdkViews[viewName];
            };

            SUGAR.mobile.getField = function getField(fieldName) {
                return SUGAR.customizationTools.sdkFields[fieldName];
            };

            SUGAR.mobile.getDashlet = function getDashlet(dashletName) {
                return SUGAR.customizationTools.sdkDashlets[dashletName];
            };
        }

        hideLoadingScreen() {
            const _hideTimer = 3000;

            setTimeout(function hideLoadingScreen() {
                SUGAR.customizationTools.mobileButtonsManager.hideLoadingScreen();
            }, _hideTimer);
        }

        isBaseView(viewName) {
            return app.nomad.getViewClass({
                baseType: viewName
            });
        }

        isBaseField(fieldName) {
            return app.nomad.getFieldClass({
                baseType: fieldName
            });
        }

        isBaseDashlet(dashletName) {
            return SUGAR.mobile.getDashlet(dashletName);
        }
    }

    let _bootLoader = new wMobileBootLoader();

    _bootLoader.declareGlobals();
    _bootLoader.loadFloatingButtons();
    _bootLoader.hideLoadingScreen();
})(SUGAR.App);