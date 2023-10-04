/* eslint-disable require-jsdoc */
let _baseFilePath = "src/wsystems/mobile/include/require/wMobileApp/";
let _baseClassName = "wMobileEntityLoader";
let wMobileEntityLoader = window.require(_baseFilePath + _baseClassName)[_baseClassName];

class wMobileDashletLoader extends wMobileEntityLoader {
    constructor(wMobileBootLoader) {
        super(wMobileBootLoader);

        this.BASE_ENTITY = SUGAR.mobile.getDashlet("base-dashlet");
        this.ENTITY_TYPE = "Dashlet";
    }

    extend(baseType, extensionData) {
        let _baseEntity = SUGAR.mobile.getDashlet(baseType);

        Object.assign(_baseEntity.prototype, extensionData);
    }

    loadBaseEntity(data, name, baseEntity) {
        let _entityName = this.getEntityName(name);
        let _globalName = this.getGlobalName(_entityName);

        let _customEntity = this.wMobileBootLoader.customizationTools.customization.extend(baseEntity, data.controller);

        _customEntity = this.addTemplateToEntity(_customEntity, data, name);

        this.wMobileBootLoader.customizationTools.customization.register(_customEntity, {
            metadataType: name
        });

        if (data.controller.icon) {
            app.config.ui.icons.dashlets[name] = data.controller.icon;
        }

        this.applyExtensions(name);
        app.mobile.dashlets[_globalName] = SUGAR.mobile.getDashlet(name);
    }

    addTemplateToEntity(customEntity, data, name) {
        let _templateName = this.getTemplateName(name);
        let _customEntity = customEntity;

        _customEntity = this.wMobileBootLoader.customizationTools.customization.extend(_customEntity, {
            initialize: function (options) {
                options.module = "About";

                var initResult = this._super("initialize", arguments);

                if (data.templates[name]) {
                    this.template = Handlebars.templates[_templateName];
                }

                this.loadStyles();

                return initResult;
            },

            loadStyles: function () {
                _.each(SUGAR.mobile.dashlets[name].styles, function loadStyle(styleCss, styleKey) {
                    if (!app.mobile.styles[styleKey]) {
                        app.mobile.styles[styleKey] = true;
                        $("head").append("<style type='text/css'>" + styleCss + "</style>");
                    }
                });
            }
        });

        if (data.templates[name] && !Handlebars.templates[_templateName]) {
            Handlebars.templates[_templateName] = Handlebars.compile(data.templates[name]);
        } 

        return _customEntity;
    }
    
    loadExtendedEntity(data, name) {
        let _parentData = data.controller.extendsFrom;
        let _parentType = _parentData.baseType;

        let _baseEntity = SUGAR.mobile.getDashlet(_parentType);

        if (_baseEntity) {
            this.loadBaseEntity(data, name, _baseEntity);
        }
    }
}
module.exports.wMobileDashletLoader = wMobileDashletLoader;