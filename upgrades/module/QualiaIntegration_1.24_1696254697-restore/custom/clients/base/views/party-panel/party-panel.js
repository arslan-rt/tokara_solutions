({
    events: {
        "click .record-panel-header": "togglePanel",
    },

    _loadTemplate(options) {
        let callParent = this._super("_loadTemplate", arguments);

        return callParent;
    },

    render() {
        let callParent = this._super("render", arguments);

        this.createPartyViews();

        return callParent;
    },

    createPartyViews() {
        this.options.rqPartiesData = _.sortBy(this.options.rqPartiesData, function sort(relatedParty) {
            return !relatedParty[relatedParty.partyType].is_primary;
        });

        _.each(this.options.rqPartiesData, function createPartyView(mainPartyData) {
            var partyViewName = this.options.manager.partyViewMappingTable[mainPartyData.partyType].viewName;

            var partyView = App.view.createView({
                name          : partyViewName,
                manager       : this.options.manager,
                rqPartiesData : mainPartyData,
                panel         : this,
            });
            partyView.render();
            this.$el.find("#qualiaContainer").append(partyView.$el);

        }.bind(this));
    },
});