// eslint-disable-next-line
; (function QualiaIntegration(app) {
    /**
     * Checks if the given component is defined.
     *
     * <code>
     * 
     * var view = app.view.fields.BaseAccountsRelateField;
     * var isDefined = componentDefined(view);
     * 
     * </code>
     * 
     * @param {Function} component
     *
     * @return {Boolean} 
     */
    function componentDefined(component) {
        return component instanceof Function === true;
    }

    /**
     * Returns the name of the component dictionary,
     * in order to search a certain component in app.view dictionary.
     * 
     * <code>
     * 
     * getCmpDictionaryName("field");
     * getCmpDictionaryName("view");
     * getCmpDictionaryName("layout");
     * 
     * </code>
     *
     * @param {String} componentType Any of [`field`, `view`, `layout`]
     *
     * @return {String} Any of [`fields`, `views`, `layouts`]
     * 
     * @throws {Exception}
     */
    function getCmpDictionaryName(componentType) {
        switch (componentType) {
            case "field":
                return "fields";

            case "view":
                return "views";

            case "layout":
                return "layouts";

            default:
                throw "ERROR. Unknown component type [" + componentType + "].";
        }
    }

    /**
     * Returns the full component name based on the given parameters.
     * 
     * <code>
     * 
     * buildComponentName("base", "Accounts", "field", "enum", false);
     * buildComponentName("base", "Accounts", "field", "enum", true);
     * 
     * </code>
     *
     * @example BaseAccountsEnumField, BaseAccountsCustomEnumField
     * 
     * @param {String} platform  
     * @param {String} moduleName   
     * @param {String} componentType Any of [`field`, `view`, `layout`]
     * @param {String} componentName 
     * @param {Boolean} isCustom If true, add `Custom` string in the component name.
     *
     * @return {String}          
     */
    function buildComponentName(platform, moduleName, componentType, componentName, isCustom) {
        var custom = "";

        if (_.isEmptyValue(moduleName) === true) {
            moduleName = "";
        }

        if (isCustom === true) {
            custom = "Custom";
        }

        componentName = capitalizeArrayItems(componentName.split("-")).join("");

        return capitalizeArrayItems([platform]).join("")
            + moduleName
            + capitalizeArrayItems([custom, componentName, componentType]).join("");
    }

    /**
     * Returns an array that contains the same elements as the given one,
     * but with each element capitalized.
     * 
     * <code>
     * 
     * capitalizeArrayItems(["base", "accounts", "record", "view"]);
     * capitalizeArrayItems(["base", "custom", "accounts", "record", "view"]);
     * 
     * </code>
     *
     * @param {Array} array
     *
     * @return {Array} [Base, Accounts, Record, View], [Base, Accounts, Custom, Record, View]
     */
    function capitalizeArrayItems(array) {
        var formattedArray = [];

        _.each(array, function upperCase(item) {
            if (_.isEmptyValue(item) === true) {
                return;
            }

            formattedArray.push(item.charAt(0).toUpperCase() + item.substr(1));
        });

        return formattedArray;
    }

    /**
     * Implements a mechanism designed to allow extend Sugar components (views/fields/layouts).
     * 
     * <code>
     * 
     * extendComponent("portal", "Accounts", "view", "record", {
     *     "initialize": function() {...}
     * })
     * 
     * extendComponent("base", null, "view", "record", {
     *     "initialize": function() {...}
     * })
     * 
     * extendComponent("portal", "Accounts", "field", "enum", {
     *     "initialize": function() {...}
     * })
     * 
     * extendComponent("portal", null, "layout", "records", {
     *     "initialize": function() {...}
     * })
     * 
     * </code>
     *
     * @param {String} platform   
     * @param {String} moduleName    
     * @param {String} componentType 
     * @param {String} componentName 
     * @param {Object} controller    
     *
     * @return {Undefined}               
     */
    function extendComponent(platform, moduleName, componentType, componentName, controller) {
        var fullCmpName;
        var cleanController;

        // EG: `fields` | `views` | `layouts`
        var dictionary = getCmpDictionaryName(componentType);

        // EG: BaseAccountsEnumField | BaseAccountsCustomEnumField
        var baseFullCmpName = buildComponentName(platform, moduleName, componentType, componentName, false);
        var cstmFullCmpName = buildComponentName(platform, moduleName, componentType, componentName, true);

        var baseController = app.view[dictionary][baseFullCmpName];
        var cstmController = app.view[dictionary][cstmFullCmpName];

        // Use base component, if defined
        fullCmpName = baseFullCmpName;

        if (componentDefined(cstmController) === true) {
            fullCmpName = cstmFullCmpName;
        } else {
            if (componentDefined(baseController) === true) {
                fullCmpName = baseFullCmpName;
            } else {
                app.view.declareComponent(componentType, componentName, moduleName, undefined, false, platform);
            }
        }

        cleanController = app.view[dictionary][fullCmpName];

        // Change component controller
        app.view[dictionary][fullCmpName] = cleanController.extend(controller);
    }

    app.wsystems = app.wsystems || {};
    app.wsystems.QualiaIntegration = app.wsystems.QualiaIntegration || {};
    app.wsystems.QualiaIntegration.extendComponent = extendComponent;
})(SUGAR.App);
