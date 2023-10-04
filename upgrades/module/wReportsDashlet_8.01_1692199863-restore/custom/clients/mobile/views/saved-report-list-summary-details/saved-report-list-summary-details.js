({
    initialize: function (options) {
        this._super("initialize", arguments);
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