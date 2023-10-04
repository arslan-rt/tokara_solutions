/* eslint-disable require-jsdoc */
let _baseFilePath = "src/wsystems/mobile/include/require/wMobileApp/";
let _baseClassName = "wMobileEntityLoader";
let MobileEntityLoader = window.require(_baseFilePath + _baseClassName)[_baseClassName];

class wMobileViewLoader extends MobileEntityLoader {
    constructor(wMobileBootLoader) {
        super(wMobileBootLoader);

        this.BASE_ENTITY = wMobileBootLoader.customizationTools.nomadView;
        this.ENTITY_TYPE = "View";
    }

    extend(baseType, extensionData) {
        let _baseEntityData = app.nomad._getComponentViewCache()[baseType];
        let _targetModules = [];

        if (_baseEntityData 
            && _baseEntityData.custom.length > 0 
            && (extensionData.extendsFrom.module === undefined || extensionData.extendsFrom.module === "")) {
            _.each(_baseEntityData.custom, function getExtendedModules(moduleData) {
                _targetModules.push(moduleData.filter.module);
            });
        }

        _targetModules.push(extensionData.extendsFrom.module);

        _.each(_targetModules, function applyExtension(moduleName) {
            let _baseClass = app.nomad.getViewClass({
                baseType : baseType,
                module   : moduleName
            });

            if (_baseClass) {
                let _customEntity = app.nomad.extendComponent(_baseClass, extensionData, undefined);

                app.nomad.registerComponent({
                    cmp      : _customEntity,
                    baseType : baseType,
                    module   : moduleName
                });

                extensionData.applied = true;
            } 
        });
    }

    loadBaseEntity(data, name, baseClass, entityName, moduleType, baseType) {
        // extend base type if there is any extension to that entity
        baseClass = this.extendClass(baseType, baseClass);

        var customMobileEntity = app.nomad.extendComponent(baseClass, data.controller, undefined);

        // extend the current view
        customMobileEntity = this.extendClass(name, customMobileEntity);

        app.mobile.views[this.getGlobalName(entityName)] = this.addTemplateToEntity(
            customMobileEntity,
            data,
            name,
            moduleType
        );

        this.wMobileBootLoader.wMobileRouteHandler.routeRegisterView(
            this.getGlobalName(entityName), this.getTemplateName(name)
        );

        this.applyExtensions(name);
        this.wMobileBootLoader.customizationTools.customization.register(app.mobile.views[this.getGlobalName(entityName)], {
            baseType: name
        });
    }

    addTemplateToEntity(mobileEntity, data, name, moduleType) {
        let _templateName = this.getTemplateName(name);

        var baseInitFn = mobileEntity.prototype.initialize;

        mobileEntity = mobileEntity.extend({
            initialize: function (options) {
                if (moduleType !== "") {
                    options.module = moduleType;
                }

                if (!options.module) {
                    options.module = "About";
                }

                let _initResult = baseInitFn.call(this, options);

                if (data.templates[name]) {
                    this.template = Handlebars.templates[_templateName];
                }

                this.loadStyles();

                return _initResult;
            },

            loadStyles: function () {
                _.each(SUGAR.mobile.views[name].styles, function loadStyle(styleCss, styleKey) {
                    if (!app.mobile.styles[styleKey]) {
                        app.mobile.styles[styleKey] = true;
                        $("head").append("<style type='text/css'>" + styleCss + "</style>");
                    }
                });
            }
        });

        if (data.templates[name]) {
            mobileEntity.prototype.template = _templateName;

            if (!Handlebars.templates[_templateName]) {
                Handlebars.templates[_templateName] = Handlebars.compile(data.templates[name]);
            }
        }

        if (!mobileEntity.prototype.headerConfig) {
            mobileEntity.prototype.headerConfig = {};
        }
        _.each(data.controller.headerConfig, function addHeaderConfig(headerOptionValue, headerOptionName) {
            mobileEntity.prototype.headerConfig[headerOptionName] = headerOptionValue;
        });

        return mobileEntity;
    }

    loadExtendedEntity(data, name, entities) {
        let _entities = entities;
        let _globalViewName = this.getGlobalName(name);

        // check if the view exists already
        if (!app.mobile.views[_globalViewName]) {
            let _parentData = data.controller.extendsFrom;
            let _parentType = _parentData.baseType;
            let _moduleType = _parentData.module ? _parentData.module : "";

            // try getting the base class from the sugar framework
            let baseEntityClass = app.nomad.getViewClass({
                baseType : _parentType,
                module   : _moduleType
            });

            // try getting the base class from the sugar sdk
            if (baseEntityClass === undefined) {
                baseEntityClass = SUGAR.mobile.getView(_parentType);
            }

            // try getting the base class from our custom classes
            if (baseEntityClass === undefined) {
                let _parentEntityName = this.getEntityName(_parentType);
                let _parentTypeName = this.getGlobalName(_parentEntityName);

                baseEntityClass = app.mobile.views[_parentTypeName];

                // try getting the base class from our custom classes that have not been created yet
                if (baseEntityClass === undefined && _entities[_parentEntityName]) {
                    this.loadExtendedEntity(_entities[_parentEntityName].data, _parentType, _entities);

                    baseEntityClass = app.mobile.views[_parentTypeName];
                }

                if (data.templates[name] === undefined && _.isObject(SUGAR.mobile.views[_parentType]) === true) {
                    data.templates[name] = SUGAR.mobile.views[_parentType].templates[_parentType];
                }
            }

            if (baseEntityClass) {
                this.loadBaseEntity(data, name, baseEntityClass, this.getEntityName(name), _moduleType, _parentType);
            }
        }
    }

    extendClass(baseType, baseClass) {
        _.each(SUGAR.mobile.extensions, function goThroughExtensions(extensionData) {
            if (extensionData.extendsFrom.baseType === baseType && !extensionData.applied) {
                var customMobileEntity = app.nomad.extendComponent(baseClass, extensionData, undefined);

                app.nomad.registerComponent({
                    cmp      : customMobileEntity,
                    baseType : baseType
                });

                baseClass = customMobileEntity;
                extensionData.applied = true;
            }
        });

        return baseClass;
    }
}
module.exports.wMobileViewLoader = wMobileViewLoader;