/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
/**
 * MultiLineList supports more than one line of data per Model row. User can group
 * relevant data into the same column of the data-table.
 *
 * The view metadata of each field columns uses subfields property to determine the
 * actual data being shown. Each subfields entry contains field data.
 *
 * Example:
 * array(
 *     'fields' => array(
 *         array(
 *             'user' => 'user',
 *             'label' => 'LBL_USER',
 *             'width' => 'xlarge',
 *             'subfields' => array(
 *                 array(
 *                     'name' => 'user_name',
 *                     'label' => 'LBL_USER_NAME',
 *                     'enable' => true,
 *                     'default' => true,
 *                 ),
 *                 array(
 *                     'name' => 'user_id',
 *                     'label' => 'LBL_USER_ID',
 *                     'enable' => true,
 *                     'default' => true,
 *                 ),
 *             ),
 *         ),
 *     ),
 * )
 *
 * @class View.Views.Base.MultiLineListView
 * @alias SUGAR.App.view.views.BaseMultiLineListView
 * @extends View.Views.Base.ListView
 */
({
    extendsFrom: 'ListView',
    className: 'multi-line-list-view',
    drawerModelId: null,
    sideDrawer: null,
    plugins: ['ConfigDrivenList', 'ResizableColumns'],

    /**
     * Event handlers for left row actions.
     */
    rowEvents: {
        'list:openrow:fire': 'openClicked',
        'list:editrow:fire': 'editClicked',
        'list:copyrow:fire': 'copyClicked'
    },

    /**
     * metric data
     */
    metric: null,

    /**
     * indicates if the last metric tab is hidden
     */
    isMetricEmpty: false,

    /**
     * options
     */
    options: null,

    /**
     * @inheritdoc
     */
    loadData: function(options) {
        if (!this.metric) {
            // Don't load data until metric is ready
            return;
        }
        this._super('loadData', [options]);
    },

    /**
     * Metric data is ready
     * @param {Object} data metric record from event
     */
    metricDataReady: function(data) {
        this.metric = data;
        app.events.off('metric:ready');
        this.initialize(this.options);
        this.undelegateEvents();
        this.delegateEvents();
    },

    /**
     * Metric data is ready
     * @param {Object} data metric record from event
     */
    metricDataInitialize: function(data) {
        if (data) {
            this.metric = data;
            this.initialize(this.options);
            this.undelegateEvents();
            this.delegateEvents();
        }
    },

    /**
     * Process multi field column header labels
     * @param {Object} labels
     * @param {Object} meta
     */
    _setMetricLabels: function(labels, meta) {
        var metricLabels = {};
        _.each(labels, function(label) {
            metricLabels[label.label] = label.labelValue;
        }, this);
        _.each(meta.panels[0].fields, function(field) {
            if (metricLabels[field.label]) {
                field.labelValue = metricLabels[field.label]; // to be used by handlebar template
            }
        }, this);
    },

    /**
     * Adding focus drawer types from vardefs.php to mulit-line-list fields
     *
     * @param {Array} fields The field from vardefs.php
     * @param {Array} panels The mulit-line-list panels
     */
    setSubfieldType: function(fields, panels) {
        let allowedTypes = [
            'name',
            'parent',
            'relate',
            'int'
        ];

        _.each(fields, function(field) {
            _.each(panels[0].fields, function(fieldDefs, fieldsIndex) {
                var subFields = fieldDefs.subfields;
                _.each(subFields, function(subField, subFieldIndex) {
                    if (field.name === subField.name && allowedTypes.includes(field.type)) {
                        if (!subField.hasOwnProperty('type')) {
                            this.meta.panels[0].fields[fieldsIndex].subfields[subFieldIndex].type = field.type;
                        }

                        this.meta.panels[0].fields[fieldsIndex].subfields[subFieldIndex].link = true;
                    }
                }, this);
            }, this);
        }, this);
    },

    /**
     * @override
     */
    initialize: function(options) {
        if (!this.metric) {
            // do not proceed if metric data is not ready
            app.events.off('metric:ready');
            app.events.on('metric:ready', this.metricDataReady, this);
            app.events.off('metric:initialize');
            app.events.on('metric:initialize', this.metricDataInitialize, this);

            this.options = options;
            this._super('initialize', [options]);
            this.hasModuleAccess = _.contains(
                app.metadata.getModuleNames(),
                this.module
            );
            this.addContextListeners();
            return;
        }
        var defaultMeta = app.metadata.getView(null, 'multi-line-list') || {};
        var listViewMeta = app.metadata.getView(options.module, 'multi-line-list') || {};
        options.meta = _.extend({}, defaultMeta, listViewMeta, options.meta || {});
        options.meta.panels = this.metric.viewdefs.base.view['multi-line-list'].panels;
        this._setMetricLabels(this.metric.labels, options.meta);
        this._setConfig(options);
        this._setCollectionOption(options);

        this._super('initialize', [options]);

        this.hasModuleAccess = _.contains(
            app.metadata.getModuleNames(),
            this.module
        );
        this.addContextListeners();

        // Set fields on context to forcefully load these fields
        var fields = this._extractFieldNames(this.meta);
        this.context.set('fields', fields);

        this.context.resetLoadFlag();
        this.context.set('skipFetch', false);

        if (this.collection) {
            options.fields = fields;
            this.collection.fetch(options);

            this.stopListening(this.collection);
            this.listenTo(this.collection, 'sync', this._render);
        }

        this.leftColumns = [];
        this.addActions(this.meta);

        var leftColumnsEvents = {};
        //add an event delegate for left action dropdown buttons onclick events
        if (this.leftColumns.length) {
            leftColumnsEvents = {
                'hidden.bs.dropdown .actions': 'updateDropdownDirection',
                'shown.bs.dropdown .actions': 'updateDropdownDirection',
            };
        }
        this.events = _.extend({}, this.events, leftColumnsEvents, {
            'click .multi-line-row td:not(:first-child)': 'handleRowClick',
        });

        // Add event handlers for row actions
        _.each(this.rowEvents, function(callback, event) {
            this.context.off(event, this[callback], this);
            this.context.on(event, this[callback], this);
        }, this);

        if (this.hasFrozenColumn) {
            this.$el.on('scroll', _.bind(this.toggleFrozenColumnBorder, this));
        }

        this.autoRefresh(true);
        this._setResizableColumns();
        // Add focus drawer types from vardefs.php to mulit-line-list fields
        let moduleMetadataFields = app.metadata.getModule(this.module, 'fields');
        this.setSubfieldType(moduleMetadataFields, this.meta.panels);
    },

    /**
     * Sets configs for resizable columns.
     */
    _setResizableColumns: function() {
        this.meta = this.meta || {};
        this.meta.last_state = this.meta.last_state || {id: 'multi-line-list'};
        this._fieldSizesKey = app.user.lastState.key(this.metric.id + ':column-width', this);
        this._fieldSizes = null;
        this._fields = {visible:  _.flatten(_.pluck(this.meta.panels, 'fields'))};
        this.on('list:column:resize:save', this.saveCurrentWidths, this);
    },

    /**
     * Gets the widths for each field.
     *
     * @return {Array} The list of widths if found, `undefined` otherwise.
     */
    getCacheWidths: function() {
        let fieldSizes = this._fieldSizes ||
            app.user.lastState.get(this._fieldSizesKey);
        let visibleFields = _.pluck(this._fields.visible, 'name');

        if (!fieldSizes || !_.isEqual(visibleFields, fieldSizes.visible)) {
            return;
        }

        return fieldSizes.widths;
    },

    /**
     * Saves the field widths.
     *
     * @param {Array} columns The field widths
     */
    saveCurrentWidths: function(columns) {
        if (!this._fieldSizesKey || (this._fieldSizes && _.isEqual(this._fieldSizes.widths, columns))) {
            return;
        }
        let visibleFields = _.pluck(this._fields.visible, 'name');

        this._fieldSizes = {
            visible: visibleFields,
            widths: columns
        };

        app.user.lastState.set(this._fieldSizesKey, this._fieldSizes);
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        //Tells that the last metric tab is hidden
        this.stopListening(this.context);
        this.listenTo(this.context, 'metric:empty', this.handleLastMetricHide);
    },

    /**
     * Handle event of hiding last metric tab
     */
    handleLastMetricHide: function() {
        this.isMetricEmpty = true;
        this._render();
    },

    /**
     * Adds listeners for the context events
     */
    addContextListeners: function() {
        this.stopListening(this.context);

        this.listenTo(this.context, 'filter:fetch:start', _.bind(this.toggleSkeletonLoader, this, true));
        this.listenTo(this.context, 'filter:fetch:success filter:fetch:complete', function() {
            if (this.metric) {
                this.toggleSkeletonLoader(false);
            } else {
                this.toggleSkeletonLoader(true);
            }
        }, this);
        this.listenTo(this.context, 'active:metric:changed metric:empty', function() {
            this.toggleSkeletonLoader(true);
        }, this);
    },

    /**
     * Toggles the skeleton loader on/off on the multiline list view
     * @param show {boolean} determines if the loaders should be turned on/off. A true value will toggle on the
     * loaders and false will turn it off.
     */
    toggleSkeletonLoader: function(show) {
        const loaderElem = this.$('.multi-line-list-loader');

        if (loaderElem && !this.isMetricEmpty) {
            const dataTable = loaderElem.find('.dataTable');
            const footerElem = loaderElem.find('.block-footer');
            let hasLoader = loaderElem.find('.data-skeleton-loader').length !== 0;

            // if the loader is already in desired state then return
            if (hasLoader === show) {
                return;
            }

            if (footerElem) {
                footerElem.css('display', show ? 'none' : 'block');
            }

            if (dataTable) {
                dataTable.css('display', show ? 'none' : 'table');
            }

            loaderElem.toggleClass('data-skeleton-loader', show);
        }
    },

    /**
     * Show/hide border when scrolling horizontally if the first column is frozen.
     */
    toggleFrozenColumnBorder: _.throttle(function() {
        if (!this.hasFrozenColumn) {
            return;
        }

        let $firstColumns = this.$('.table tbody tr td:nth-child(2), .table thead tr th:nth-child(2)');
        $firstColumns.toggleClass('column-border', this.$el[0].scrollLeft > 0);
    }, 100),

    /**
     * Get fields names from metadata
     *
     * @param {Object} meta Metadata containing fields on view
     * @return {Array} Array of fields
     * @private
     */
    _extractFieldNames: function(meta) {
        var fields = [];
        _.each(meta.panels, function(panel) {
            var panelFields = panel.fields;
            _.each(panelFields, function(fieldDefs) {
                var subFields = fieldDefs.subfields;
                var relatedFields = _.flatten(_.compact(_.pluck(subFields, 'related_fields')));
                fields = _.union(fields, _.pluck(subFields, 'name'), relatedFields);
            }, this);
        }, this);

        return fields;
    },

    /**
     * Set filter_def and order_by from config.
     *
     * @param {Object} options object for the view
     */
    _setConfig: function(options) {
        options.meta = options.meta || {};
        if (this.metric.filter_def) {
            options.meta.filterDef = this.metric.filter_def;
        }
        if (this.metric.order_by_primary) {
            var orderBy =
                this.metric.order_by_primary.trim() +
                ':' +
                (this.metric.order_by_primary_direction ? this.metric.order_by_primary_direction : 'asc');
            if (this.metric.order_by_secondary) {
                orderBy +=
                    ',' +
                    this.metric.order_by_secondary.trim() +
                    ':' +
                    (this.metric.order_by_secondary_direction ? this.metric.order_by_secondary_direction : 'asc');
            }
            options.meta.collectionOptions = options.meta.collectionOptions || {};
            options.meta.collectionOptions.params = options.meta.collectionOptions.params || {};
            options.meta.collectionOptions.params.order_by = orderBy;
        }
        this.hasFrozenColumn = app.config.allowFreezeFirstColumn && this.metric.freeze_first_column;
    },

    /**
     * Set collection option and filterDef
     *
     * @param {Object} options object for the view
     */
    _setCollectionOption: function(options) {
        var collection = options.context.get('collection');
        if (!collection) {
            collection = app.data.createBeanCollection(options.module);
            options.context.set({collection: collection});
        }
        var meta = options.meta || {};
        if (meta.collectionOptions) {
            collection.setOption(meta.collectionOptions);
        }
        this.setFilterDef(options);
    },

    /**
     * Set the filter for the collection
     *
     * @param {Object} options object for the view
     */
    setFilterDef: function(options) {
        var meta = options.meta || {};
        let optionsCollection = options.context.get('collection');
        let filterComp = this.layout.getComponent('multi-line-filterpanel') ?
            this.layout.getComponent('multi-line-filterpanel').getComponent('filter') : {};

        if (meta.filterDef) {
            // filterDef maybe altered by other methods like applyFilter()
            // but defaultFilterDef always maintains a copy of original default filters
            optionsCollection.defaultFilterDef = meta.filterDef;
            optionsCollection.filterDef = _.union(
                meta.filterDef,
                optionsCollection.origFilterDef || []
            );
        }

        if (filterComp) {
            let searchComp = filterComp.getComponent('filter-quicksearch');

            if (!_.isEmpty(searchComp.currentSearch)) {
                optionsCollection.filterDef =
                    filterComp.buildFilterDef(optionsCollection.filterDef, searchComp.currentSearch, this.context);
            }
        }
    },

    /**
     * @inheritdoc
     */
    focusRow: function(id) {
        this.drawerModelId = id;
        this._super('focusRow', [id]);
    },

    /**
     * @inheritdoc
     */
    getRowDomForModelId: function(id) {
        return this.$(`.multi-line-row[data-id="${id}"]`);
    },

    /**
     * Highlights a row on the list and removes highlight from
     * the previously highlighted row
     *
     * @param {jQuery} $el Element to find the row to highlight
     */
    highlightRow: function($el) {
        this.unhighlightRows();
        if ($el.length) {
            $el.addClass('current highlighted');
        }
    },

    /**
     * @inheritdoc
     */
    unhighlightRows: function() {
        let highlightedRows = this.$('.multi-line-row.current.highlighted');
        if (highlightedRows.length) {
            highlightedRows.removeClass('current highlighted');
        }
    },

    /**
     * Trigger action when a model row is clicked
     *
     * @param {Object} event Click event that triggers the function
     */
    handleRowClick: function(event) {
        var $el = this.$(event.target);

        // ignore event triggered by dropdown-toggle or any action dropdown is open
        if (this.isDropdownToggle($el) || this.isActionsDropdownOpen()) {
            return;
        }

        var modelId = $el.closest('.multi-line-row').data('id');
        var model = this.collection.get(modelId);
        if (app.sideDrawer && model) {
            const openDrawer = _.bind(function() {
                let dataTitle = app.sideDrawer.getDataTitle(
                    model.get('_module'),
                    'LBL_FOCUS_DRAWER_DASHBOARD',
                    model.get('name')
                );
                app.sideDrawer.open({
                    layout: 'row-model-data',
                    dashboardName: model.get('name'),
                    context: {
                        model: model,
                        contentType: 'dashboard',
                        dataTitle: dataTitle,
                        module: model.get('_module'),
                        layout: 'multi-line',
                        modelId: model.id,
                        parentContext: this.context,
                        baseModelId: model.get('id'),
                        fieldDefs: this._getNameFieldDefs(model.get('_module'))
                    }
                });
                this.drawerModelId = modelId;
            }, this);

            if (app.sideDrawer.isOpen()) {
                // If the same row was selected again, don't re-open the drawer
                if (modelId === this.drawerModelId) {
                    return;
                }

                // If the decided to stay after the unsaved changes warning, don't open the drawer
                if (!app.sideDrawer.triggerBefore('side-drawer:content-changed', {callback: openDrawer})) {
                    return;
                }
            }

            openDrawer();
        }
    },

    /**
     * Gets the field defs for the given module's name field
     * @param module
     * @return {Object}
     * @private
     */
    _getNameFieldDefs: function(module) {
        return app.metadata.getModule(module, 'fields').name;
    },

    /**
     * Get side drawer.
     * @return {Object} The side drawer.
     * @private
     * @deprecated since 11.2.0, use app.sideDrawer instead
     */
    _getSideDrawer: function() {
        return app.sideDrawer;
    },

    /**
     * Open record view in edit mode when 'edit in new tab' is clicked.
     *
     * @param {Backbone.Model} model Selected row's model.
     */
    editClicked: function(model) {
        var route = app.router.buildRoute(model.module, model.id, 'edit');
        window.open('#' + route, '_blank');
    },

    /**
     * Open record view when 'open in new tab' is clicked.
     *
     * @param {Backbone.Model} model Selected row's model.
     */
    openClicked: function(model) {
        var route = app.router.buildRoute(model.module, model.id);
        window.open('#' + route, '_blank');
    },

    /**
     * Copy record url to clipboard when 'copy url' is clicked.
     *
     * This function is adaped from: https://gist.github.com/Chalarangelo/4ff1e8c0ec03d9294628efbae49216db
     * @param {Backbone.Model} model Selected row's model.
     */
    copyClicked: function(model) {
        var route = app.router.buildRoute(model.module, model.id);
        var el = document.createElement('textarea');
        el.value = app.utils.getSiteUrl() + '#' + route;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    },

    /**
     * Add rowactions to left column
     *
     * @param {Object} meta View metadata
     */
    addActions: function(meta) {
        if (meta && _.isObject(meta.rowactions)) {
            var _generateMeta = function(label, cssClass, buttons) {
                return {
                    'type': 'fieldset',
                    'css_class': 'overflow-visible',
                    'fields': [
                        {
                            'type': 'rowactions',
                            'no_default_action': true,
                            'label': label || '',
                            'css_class': cssClass,
                            'buttons': buttons || []
                        }
                    ],
                };
            };
            var def = meta.rowactions;
            this.leftColumns.push(_generateMeta(def.label, def.css_class, def.actions));
        }
    },

    /**
     * Check if any rowaction dropdown-menu is open
     *
     * @return {boolean} dropdown-menu open or not
     */
    isActionsDropdownOpen: function() {
        return !!this.$('.fieldset.actions.list.btn-group.open').length;
    },

    /**
     * Check if the event is triggered from dropdown-toggle
     *
     * @param {jQuery} $el element that trigger the event
     * @return {boolean} element is dropdown-toggle or not
     */
    isDropdownToggle: function($el) {
        return $el.hasClass('dropdown-toggle') || $el.parent().hasClass('dropdown-toggle');
    },

    /**
     * Update CSS class of dropdown-menu based on its vertical position
     *
     * @param {Event} event Shown/Hidden event
     */
    updateDropdownDirection: function(event) {
        var $buttonGroup = this.$(event.currentTarget).first();
        var windowHeight = $(window).height() - 65; // height of window less padding
        var menuHeight = $buttonGroup.height() + $buttonGroup.children('ul').first().height();
        if (windowHeight < $buttonGroup.offset().top + menuHeight) {
            $buttonGroup.toggleClass('dropup');
        }
    },

    /**
     * Auto refresh the list view every 5 minutes
     *
     * @param {boolean} start `true` to start the timer, `false` to stop it
     */
    autoRefresh: function(start) {
        if (start) {
            clearInterval(this._timerId);
            this._timerId = setInterval(_.bind(function() {
                this.refreshData();
            }, this), 5 * 1000 * 60); // 5 min default
        } else {
            clearInterval(this._timerId);
        }
    },

    /**
     * Reload the data
     */
    refreshData: function() {
        if (this.metric) {
            this.context.reloadData();
        }
    },

    /**
     * @inheritdoc
     */
    _render: function() {
        this._unbindResizableColumns();

        if (this.isMetricEmpty) {
            let emptyTemplate = app.template.getView('multi-line-list.multi-line-empty-list');
            let content = emptyTemplate();
            this.$el.html(content);
            return;
        }

        this._super('_render');
        this.$el.closest('.dashboard').css('overflow-y', 'hidden');
        this._makeColumnResizable();
        if (app.sideDrawer && app.sideDrawer.isOpen()) {
            let id = app.sideDrawer.getParentContextDef('baseModelId');
            if (id) {
                let $row = this.getRowDomForModelId(id);
                if ($row.length) {
                    this.focusRow(id);
                }
            }
        }
    },

    /**
     * @inheritdoc
     */
    _dispose: function() {
        this.autoRefresh(false);
        if (this.hasFrozenColumn) {
            this.$el.off('scroll', _.bind(this.toggleFrozenColumnBorder, this));
        }
        this.$el.closest('.dashboard').css('overflow-y', 'auto');
        this.stopListening();
        if (this.context) {
            _.each(this.rowEvents, function(callback, event) {
                this.context.off(event, this[callback], this);
            }, this);
        }
        this.metric = null;
        this.options = null;
        this._super('_dispose');
    }
})
