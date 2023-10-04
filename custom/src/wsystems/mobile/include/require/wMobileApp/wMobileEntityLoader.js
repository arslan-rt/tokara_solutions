/* eslint-disable require-jsdoc */
class wMobileEntityLoader {
    constructor(wMobileBootLoader) {
        this.wMobileBootLoader = wMobileBootLoader;

        this.ENTITY_TYPE = "Entity";
        this.MOBILE = "Mobile";
    }
    
    extend() {}

    load(entities) {
        var _extendedEntities = {};

        _.each(
            entities,
            function handleEntity(data, name) {
                let _entityName = this.getEntityName(name);
                
                let _complexEntity = this.loadEntity(name, data, _entityName);

                if (_complexEntity) {
                    _extendedEntities[_entityName] = _complexEntity;
                }
            },
            this
        );

        this.loadExtendedEntities(_extendedEntities);
    }

    loadEntity(name, data, entityName) {
        if (this.extendsBaseEntity(data)) {
            return {
                data : data,
                name : name
            };
        } else {
            this.loadBaseEntity(
                data,
                name,
                this.BASE_ENTITY,
                entityName,
            );
        }

        return false;
    }

    loadBaseEntity() {}

    loadExtendedEntities(entities) {
        let _entities = entities;

        _.each(
            entities,
            function handleEntity(data, name) {
                this.loadExtendedEntity(data.data, data.name, _entities);
            },
            this
        );
    }

    loadExtendedEntity() {}

    applyExtensions(name) {
        _.each(SUGAR.mobile.extensions, function getExtensionData(extensionData){
            if (extensionData.extendsFrom.baseType === name) {
                this.extend(name, extensionData);
            }
        }, this);
    }

    extendsBaseEntity(data) {
        return typeof data.controller.extendsFrom === "object";
    }

    getEntityName(name) {
        return (name.charAt(0).toUpperCase() + name.slice(1)).replace(/-/g, "");
    }

    getGlobalName(name) {
        return this.MOBILE + this.getEntityName(name) + this.ENTITY_TYPE;
    }

    getTemplateName(name) {
        return this.MOBILE.charAt(0).toLowerCase() + this.MOBILE.slice(1) + "-" + this.getEntityName(name) + "-" + this.ENTITY_TYPE.charAt(0).toLowerCase() + this.ENTITY_TYPE.slice(1);
    }
}
module.exports.wMobileEntityLoader = wMobileEntityLoader;