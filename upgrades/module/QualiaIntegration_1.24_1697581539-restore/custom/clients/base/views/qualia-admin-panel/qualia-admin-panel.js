({
    plugins: [
        "QualiaIntegration_Alert",
        "ErrorDecoration"
    ],

    /**
     * @inheritdoc
     */
    initialize: function () {
        var parent = this._super("initialize", arguments);

        this.initModel();
        this.initProperties();
        this.initEvents();
        this.initDefaults();

        return parent;
    },

    /**
     * @inheritdoc
     */
    render: function () {
        this.initMetaGrids();

        var parent = this._super("render", arguments);

        this.showRadioBtnsInline();

        return parent;
    },

    /**
     * @inheritdoc
     */
    loadData: function () {
        this.model.fetch();
    },

    /**
     * Proceeds with model saving if it is valid.
     * 
     * @param {Boolean} isValid True if the model validation is succesful
     * 
     * @return {Undefined}
     */
    saveData: function (isValid) {
        if (isValid === true) {
            this.model.save();
        }
    },

    /**
     * Prepares the new model to be used to fetch/save data configuration.
     * Creates a new bean by extending `beanModel` and defines custom endpoints for both retrieve and set actions.
     *
     * @return {Undefined}
     */
    initModel: function () {
        var self = this;

        var fetchEndpoint = function () {
            var url = app.api.buildURL("QualiaIntegration", "settings/get");
            var callbacks = {
                "success": function loadDataSuccess(data, request) {
                    if (self.disposed === true) {
                        return;
                    }

                    if (_.isObject(data) === true
                        && _.isEmpty(data) === false
                        && _.isObject(data[self.name]) === true
                        && _.isEmpty(data[self.name]) === false
                    ) {
                        self.populateFields(data[self.name]);
                        self.setModelSyncedData();
                    }
                },
                "error": function loadDataError() {
                    if (self.disposed === true) {
                        return;
                    }

                    self.loadDataErr = true;
                },
                "complete": function loadDataComplete() {
                    if (self.disposed === true) {
                        return;
                    }

                    self.model.changed = {};
                    self.dataFetched = true;
                    self.render();
                }
            };
            var options = {
                "skipMetadataHash": true
            };

            app.api.call("read", url, {}, callbacks, options);
        };

        var saveEndpoint = function () {
            self.alertLoading("settings-set-pending", "LBL_QUALIAINTEGRATION_SAVE_SETTINGS_PROCESS");

            var url = app.api.buildURL("QualiaIntegration", "settings/set");
            var data = {
                "data": {}
            };

            data["data"][self.name] = self.formatApiSaveData();

            if (_.isEmpty(data["data"][self.name]) === true) {
                self.alertDismissAll();
                self.alertInfo("settings-set-info", "LBL_QUALIAINTEGRATION_SAVE_SETTINGS_NO_DATA");
                self.exitPage();

                return;
            }

            var callbacks = {
                "success": function saveDataSuccess() {
                    if (self.disposed === true) {
                        return;
                    }

                    self.alertDismissAll();
                    self.alertSuccess("settings-set-success", "LBL_QUALIAINTEGRATION_SAVE_SETTINGS_SUCCESS");
                    self.exitPage();
                },
                "error": function saveDataError() {
                    if (self.disposed === true) {
                        return;
                    }

                    self.alertDismissAll();
                    self.alertError("settings-set-success", "LBL_QUALIAINTEGRATION_SAVE_SETTINGS_ERROR");
                },
            };
            var options = {
                "skipMetadataHash": true
            };

            app.api.call("create", url, data, callbacks, options);
        };

        var ConfigBean = app.data.beanModel.extend({
            "constructor": function () {
                var plugins = [];

                this.plugins = this.plugins || [];
                this.plugins = _.unique(this.plugins.concat(plugins));

                app.data.beanModel.prototype.constructor.apply(this, arguments);

                this.fields = self.getMetaFields();
            },
            "initialize": function () {
                var parent = app.data.beanModel.prototype.initialize.apply(this, arguments);

                this.setOption({
                    "endpoint": fetchEndpoint
                });

                return parent;
            },
            "save": function () {
                var options = {
                    "endpoint": saveEndpoint
                };

                return app.data.beanModel.prototype.save.call(this, this.attributes, options);
            }
        });

        var model = new ConfigBean();

        this.model = model;
        this.context.set("model", model);
    },

    /**
     * Sets the model synced attributes.
     * This would refer to the information stored to and coming from the database.
     *
     * @return {Undefined}
     */
    setModelSyncedData: function () {
        this.model.setSyncedAttributes(this.model.attributes);
    },

    /**
     * Initializes global properties.
     * 
     * @return {Undefined}
     */
    initProperties: function () {
        /**
         * @var {Boolean}
         */
        this.dataFetched = false;

        /**
         * @var {Boolean}
         */
        this.loadDataErr = false;

        /**
         * @var {String}
         */
        this.hideCssClass = "hidden";

        /**
         * @var {String}
         */
        this.visibleFields = this.getMetaFields();
    },

    /**
     * Initializes default values for model fields.
     * 
     * @return {Undefined}
     */
    initDefaults: function () {
        var metaFields = this.getMetaFields();

        _.each(metaFields, function setDefault(field) {
            this.model.set(field.name, field.default);
        }.bind(this));
    },

    /**
     * Fills-in model fields with specific data.
     * 
     * @param {Object}
     *
     * @return {Undefined}
     */
    populateFields: function (data) {
        _.each(data, function updateModel(fieldValue, fieldName) {
            var fieldMeta = this.getFieldMeta(fieldName);

            if (_.isObject(fieldMeta) === false) {
                return;
            }

            if (fieldMeta.isMultiSelect === true) {
                this.model.set(fieldName, fieldValue.replace(/\^/g, "").split(","));

                return;
            }

            if (fieldMeta.type === "relate") {
                this.model.set(fieldMeta.id_name, data[fieldMeta.id_name]);
            }

            this.model.set(fieldName, fieldValue);
        }.bind(this));
    },

    /**
     * Retrieves all fields metadata.
     * 
     * @param {Object} meta
     * 
     * @return {Object}
     */
    getMetaFields: function (meta) {
        var panels;
        var panelFields;
        var metaFields = {};

        meta = meta || this.meta;

        panels = meta.panels.filter(function excludeHeader(panel) {
            return panel.header !== true;
        });

        panelFields = _.flatten(_.pluck(panels, "fields"));

        _.each(panelFields, function filterFields(fieldDef) {
            metaFields[fieldDef.name] = fieldDef;
        });

        return metaFields;
    },

    /**
     * @return {Undefined}
     */
    initEvents: function () {
        this.listenTo(this.model, "error:validation", this.handleValidationError.bind(this));
        this.listenTo(this.context, "button:cancel_button:click", this.handleCancelClick.bind(this));
        this.listenTo(this.context, "button:save_button:click", this.handleSaveClick.bind(this));
    },

    /**
     * Builds fields grid based on the metadata.
     * 
     * For example, if we like to have one field on a row:
     * 
     * -- Before ---
     * 
     * fields = [
     *     [
     *         'name' => '...'
     *     ],
     *     [
     *         'name' => '...'
     *     ],
     *     [
     *         'name' => '...'
     *     ],
     * ]
     * 
     * -- After --
     * 
     * grids = [
     *     [
     *         [
     *             'name' => '...'
     *             'span' => 12
     *         ]
     *     ],
     *     [
     *         [
     *             'name' => '...'
     *             'span' => 12
     *         ]
     *     ],
     *     [
     *         [
     *             'name' => '...'
     *             'span' => 12
     *         ]
     *     ],
     * ]
     * 
     * @return {Undefined}
     */
    initMetaGrids: function () {
        var spanMax = 12;

        _.each(this.meta.panels, function buildGrid(panel) {
            if (panel.header === true) {
                return;
            }

            var fields = panel.fields || [];

            if (_.isArray(fields) === true && fields.length > 0) {
                var grids = [];
                var groupIndex = 0;
                var countAdded = 0;
                var columns = panel.columns || this.meta.columns;

                _.each(fields, function setSpan(field) {
                    if (_.isNull(field.view) === true
                        || _.isUndefined(field.view) === true
                        || _.isEmptyValue(field.view) === true
                    ) {
                        return;
                    }

                    if (countAdded === columns) {
                        groupIndex++;
                        countAdded = 0;
                    }

                    grids[groupIndex] = grids[groupIndex] || [];

                    switch (this.meta.style) {
                        case "horizontal":
                            var labelSpan = field.dismiss_label === true ? 0 : 2; //eslint-disable-line no-magic-numbers
                            var fieldSpan = Math.round(spanMax / columns) - labelSpan;

                            field.labelSpan = labelSpan;
                            field.span = fieldSpan;

                            break;

                        default:
                            field.span = Math.round(spanMax / columns);

                            break;
                    }

                    grids[groupIndex].push(field);

                    countAdded++;
                }.bind(this));

                panel.grids = grids;
            }
        }.bind(this));
    },

    /**
     * @return {Undefined}
     */
    handleCancelClick: function () {
        this.exitPage();
    },

    /**
     * @return {Undefined}
     */
    exitPage: function () {
        if (this.drawerIsOpened() === true) {
            app.drawer.close();
        } else {
            var fragment = app.router._previousFragment || app.router.buildRoute("Administration");

            app.router.navigate(fragment, {
                "trigger": true
            });
        }
    },

    /**
     * @return {Boolean}
     */
    drawerIsOpened: function () {
        var drawer = app.drawer.getActive();

        if (drawer instanceof app.view.Layout === true) {
            return this.closestComponent(drawer.name) instanceof app.view.Layout === true;
        }

        return false;
    },

    /**
     * @return {Undefined}
     */
    handleSaveClick: function () {
        this.model.doValidate(this.visibleFields, this.saveData.bind(this));
    },

    /**
     * Parses fields value accordingly before commiting them to database.
     * 
     * @return {Object}
     */
    formatApiSaveData: function () {
        var data = app.utils.deepCopy(this.getModelChanges());

        _.each(data, function formatData(fieldValue, fieldName) {
            var fieldMeta = this.getFieldMeta(fieldName);

            // Meta is empty for `id_name` fields
            if (_.isObject(fieldMeta) === false) {
                return;
            }

            // Format data accordingly for multi-select fields
            if (fieldMeta.isMultiSelect === true) {
                data[fieldName] = "^" + fieldValue.join("^,^") + "^";
            }

            // Also stores the `id_name` field values to database
            if (fieldMeta.type === "relate") {
                data[fieldMeta.id_name] = this.model.get(fieldMeta.id_name);
            }

            // Cast bool values to integer
            if (fieldMeta.type === "bool") {
                data[fieldName] = +fieldValue;
            }
        }.bind(this));

        return data;
    },

    /**
     * Retrieves model changed attributes.
     * 
     * @return {Object}
     */
    getModelChanges: function () {
        var changes = {};
        var currentAttrs = this.model.attributes;
        var syncedAttrs = this.model.getSynced();

        _.each(currentAttrs, function findChanges(value, key) {
            if (_.isEqual(syncedAttrs[key], value) === false) {
                changes[key] = value;
            }
        }.bind(this));

        return changes;
    },

    /**
     * Takes care of radio button fields to be displayed inline.
     * 
     * @return {Undefined}
     */
    showRadioBtnsInline: function () {
        _.each(this.fields, function setInline(field) {
            if (field.type === "radioenum" && field.def.inline === true) {
                field.getFieldElement().css({
                    "display": "inline-flex"
                });
            }
        });
    },

    /**
     * Pops-up an error alert if the model is invalid.
     * 
     * @return {Undefined}
     */
    handleValidationError: function () {
        this.alertError("invalid-data", "ERR_RESOLVE_ERRORS", false);
    },
});
