({
    initialize: function (options) {
        this._super("initialize", arguments);
        if (typeof options.dashletParent.sort != "undefined") {
            this.sortName = options.dashletParent.sort.name;
            this.sortTableKey = options.dashletParent.sort.table_key;
            this.sortDir = options.dashletParent.sort.sort_dir;
        }
    },

    render: function () {
        this.ServerResults = this.options.dashletParent.serverResults;
        this._super("render", arguments);

        this.fixBwcLinks();
    },

    fixBwcLinks: function () {
        this.$el
            .find("a[href*=\"module=\"]")
            .each(function goThroughElements(i, elem) {
                // App.view.views.BaseBwcView.prototype.convertToSidecarLink(elem);
            });
    }
});