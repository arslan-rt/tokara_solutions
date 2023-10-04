(function jsExtensionListView(app) {
    const listType = "inner-list";
    const newTemplate =
        SUGAR.mobile.views["add-checkbox-view-on-inner-list"].templates[
            "add-checkbox-view-on-inner-list"
        ];
    const templateContent = Handlebars.compile(newTemplate)();

    SUGAR.mobile.extensions["addSlideRightListView"] = {
        extendsFrom: {
            baseType: listType
        },

        initialize(options) {
            let callParent = this._super("initialize", arguments);

            app.controller.on(
                "mobile-reset-inner-list-checboxes",
                this.resetAllCheckboxes
            );

            return callParent;
        },

        /**
         * @resetAllCheckboxes
         *
         * Reset all the checkboxes
         *
         * using example:
         * app.controller.trigger("mobile-reset-inner-list-checboxes", { reset: true, module: app.controller.layoutManager.getRootLayout().module })
         *
         * @param {Object} options  - params of object - reset - true
         *                                               module - name of the module for checkboxes to be reseted
         */
        resetAllCheckboxes(options) {
            const reset = options.reset;
            const resetModule = options.module;
            const currentModule = app.controller.layoutManager.getRootLayout().module;

            if (reset === true && resetModule === currentModule) {
                const children = this.$el.find(".items").children();

                children.forEach(item => {
                    const jqElement = $(item);
                    const checkbox = jqElement.find(".element-detector-input");
                    const checkboxState = checkbox.prop("checked");

                    if (checkboxState === true) {
                        checkbox.prop("checked", false);
                    }
                });

                this.$el.find(".listing").attr("checked_elements_list", []);
            }
        },

        render() {
            let callParent = this._super("render", arguments);

            this.wrapElementWithCheckbox();

            return callParent;
        },

        onItemAdded() {
            let callParent = this._super("onItemAdded", arguments);

            this.wrapElementWithCheckbox();

            return callParent;
        },

        /**
         * @unMarkElementAsCheckedInBacked
         *
         *  add the checkbox on the item on rendering time
         */
        wrapElementWithCheckbox() {
            const shouldAddFunctionality = this.$el.find(".menu-container").length;

            if (shouldAddFunctionality === 0) {
                return true;
            }

            const articles = this.$el.find("article");
            if (articles && articles.length > 0) {
                articles.forEach(art => {
                    const jqArt = $(art);

                    if (jqArt.find(".element-detector-input").length === 0) {
                        jqArt.prepend(templateContent);
                    }

                    const input = jqArt.find(".element-detector-input");
                    const label = jqArt.find(".element-detector-label");
                    const artId = "input-" + jqArt.attr("data-id");

                    if (input.length > 0 && label.length > 0) {
                        input.attr("id", artId);
                        label.attr("for", artId);
                        label.click(this.setActionOnClickCheckbox.bind(this));
                        input.click(this.setActionOnClickCheckboxSafe);
                    }
                });
            }

            return true;
        },

        setActionOnClickCheckboxSafe(e) {
            e.stopPropagation();
        },
        setActionOnClickCheckbox(e) {
            e.stopPropagation();
            e.preventDefault();

            const parentElement = $(e.currentTarget.parentElement);

            parentElement.find(".element-detector-input").prop("checked", false);

            this.unMarkElementAsCheckedInBacked(parentElement);
        },

        /**
         * @unMarkElementAsCheckedInBacked
         *
         *  {Object} parentElement - parent element of the clicked item
         *  Unmark the item as unchecked in backend to be able
         *  to handle them later where we need them
         */
        unMarkElementAsCheckedInBacked(parentElement) {
            const listingElement = $(".listing");
            const checkedElements = listingElement.attr("checked_elements_list");
            const recordId = parentElement.attr("data-id");

            if (checkedElements) {
                let currentRecordsToCheck = checkedElements.split(",");

                let newValues = currentRecordsToCheck.filter(item => item != recordId);

                listingElement.attr("checked_elements_list", newValues);
            }
        }
    };
})(SUGAR.App);