/* eslint-disable require-jsdoc */
let _baseFilePath = "src/wsystems/mobile/include/require/wMobileApp/";
let _baseClassName = "wMobileEntityLoader";
let wMobileEntityLoader = window.require(_baseFilePath + _baseClassName)[_baseClassName];

class wMobileFieldLoader extends wMobileEntityLoader {
    constructor(wMobileBootLoader) {
        super(wMobileBootLoader);

        this.BASE_ENTITY = app.view.NomadField;
        this.ENTITY_TYPE = "Field";
    }

    extend(baseType, extensionData) {
        let _baseEntity = app.nomad.getFieldClass({
            baseType: baseType
        });

        let _customEntity = app.nomad.extendComponent(_baseEntity, extensionData, undefined);

        app.nomad.registerComponent({
            cmp      : _customEntity,
            baseType : baseType
        });
    }

    loadBaseEntity(data, name, baseEntity) {
        let _customField = this.wMobileBootLoader.customizationTools.customization.extend(baseEntity, data.controller);

        this.wMobileBootLoader.customizationTools.customization.register(_customField, {
            metadataType: name
        });

        this.registerEntityTemplates(data.templates, name);
        this.applyExtensions(name);

        app.mobile.fields[this.getGlobalName(name)] = app.nomad.getFieldClass({
            baseType: name
        });
    }

    registerEntityTemplates(templates, name) {
        _.each(templates, function registerTemplate(templateData, templateName) {
            Handlebars.templates["f." + name + "." + templateName] = Handlebars.compile(templateData);
        });
    }

    loadExtendedEntity(data, name) {
        let _parentData = data.controller.extendsFrom;
        let _parentType = _parentData.baseType;
        let _moduleType = _parentData.module ? _parentData.module : "";

        let _baseFieldClass = app.nomad.getFieldClass({
            baseType            : _parentType,
            module              : _moduleType,
            shouldReturnDefault : true
        });

        if (_baseFieldClass) {
            this.loadBaseEntity(data, name, _baseFieldClass);
        }
    }
}
module.exports.wMobileFieldLoader = wMobileFieldLoader;