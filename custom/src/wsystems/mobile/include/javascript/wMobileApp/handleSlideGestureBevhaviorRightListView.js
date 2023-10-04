(function jsExtensionListView(app) {
    SUGAR.mobile.extensions["addCheckBoxOnListView"] = {
        extendsFrom: {
            baseType: "context-menu"
        },

        /**
         * @onItemSwipeLeft
         *
         * @ev    {Object} - element event
         * @model {Object} - element model
         *
         * add functionality on swipe left for checkbox
         */
        onItemSwipeLeft(ev, model) {
            const shouldAddFunctionality = $(ev.currentTarget).find(".menu-container").length;

            if (shouldAddFunctionality === 0) {
                return true;
            }

            const checkbox = $(ev.currentTarget).find(".element-detector-input");

            if (checkbox.length > 0 && checkbox.prop("checked") === true) {
                checkbox.prop("checked", false);
                this.unMarkElementAsCheckedInBacked(ev);
            } else if (app.isTablet && $.__swipeHelper.swipeOrientation !== "vertical") {
                const $article = $(ev.currentTarget).closest("article");

                if (this.isItemHasContextMenuOpened($article.get(0))) {
                    return false;
                }

                if (this.isOpened()) {
                    this.hide();
                }

                this.show($article, model);
            }

            return true;
        },

        /**
         * @onItemSwipeRight
         *
         * @ev    {Object} - element event
         * @model {Object} - element model
         *
         * add functionality on swipe right for checkbox
         */
        onItemSwipeRight(ev, model) {
            const shouldAddFunctionality = $(ev.currentTarget).find(".menu-container").length;

            if (shouldAddFunctionality === 0) {
                return true;
            }

            const checkbox = $(ev.currentTarget).find(".element-detector-input");

            if (
                checkbox.length > 0 &&
                checkbox.prop("checked") === false &&
                !this.isItemHasContextMenuOpened(ev.currentTarget)
            ) {
                checkbox.prop("checked", true);
                this.markElementAsCheckedInBacked(ev);
            } else if (this.isItemHasContextMenuOpened(ev.currentTarget)) {
                this.hide();
            }

            return true;
        },

        /**
         * @markElementAsCheckedInBacked
         *
         *  {Object} el - click event
         *  Mark the item as checked in backend to be able
         *  to handle them later where we need them
         */
        markElementAsCheckedInBacked(el) {
            const listingElement = $(".listing");
            const checkedElements = listingElement.attr("checked_elements_list");
            const id = el.currentTarget.getAttribute("data-id");
            const jqCurrentEl = $(el.currentTarget);
            const jqInput = jqCurrentEl.find(".element-detector-input")[0];
            const isChecked = jqInput.checked;

            //eslint-disable-next-line
            if (!checkedElements) {
                let newCheckedElements = [id];

                listingElement.attr("checked_elements_list", newCheckedElements);
            } else {
                let currentRecordsToCheck = checkedElements.split(",");

                if (isChecked === true) {
                    currentRecordsToCheck.push(id);

                    listingElement.attr("checked_elements_list", currentRecordsToCheck);
                }
            }
        },

        /**
         * @unMarkElementAsCheckedInBacked
         *
         *  {Object} el - click event
         *  Unmark the item as unchecked in backend to be able
         *  to handle them later where we need them
         */
        unMarkElementAsCheckedInBacked(el) {
            const listingElement = $(".listing");
            const checkedElements = listingElement.attr("checked_elements_list");
            const id = el.currentTarget.getAttribute("data-id");

            if (checkedElements) {
                let currentRecordsToCheck = checkedElements.split(",");

                let newValues = currentRecordsToCheck.filter(item => item != id);

                listingElement.attr("checked_elements_list", newValues);
            }
        }
    };
})(SUGAR.App);