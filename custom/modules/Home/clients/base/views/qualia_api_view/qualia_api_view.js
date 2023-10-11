({
    extendsFrom: 'RecordView',
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.action = "edit";
        this._render();
        this.ReteriveAutherizationCreds();
    },

    events: {
        'click .btn-primary': 'SaveAutherizationCreds',
    },

    SaveAutherizationCreds: function () {
        app.alert.show('Autherization-Loading', {level: 'process', title: app.lang.getAppString("LBL_LOADING")});
        var self = this;
        if (!this.model.isEmpty())
        {
        	app.api.call('create', app.api.buildURL('AutherizationCreds/Save'), {"data":this.model,"DBfields":this.meta.panels[1].fields}, {
            	success: function (data) {
                	app.alert.dismiss('Autherization-Loading');
                	app.alert.show('AutherizationTest-Success', { level: 'success', messages: app.lang.get('LBL_CONNECTION_SUCCESS',self.module), autoClose: true });
                	app.router.redirect("#Administration");
            	},
            	error: function (e) {
                	app.alert.dismiss('Autherization-Loading');
                	self.result = "Error";
                	app.alert.show('AutherizationTest-Error', {
                    	level: 'error',
                    	messages: app.lang.get('LBL_CONNECTION_FAILED',self.module),
                    	autoClose: false,
                	});
            	}
        	});
        }	
    },
    ReteriveAutherizationCreds : function () {
        var self = this;
        app.api.call('read', app.api.buildURL('AutherizationCreds/Reterive'), {}, {
            success: function (data) {
                for (var key in data) {
                    self.model.set(key,data[key]);
                }
            },
            error: function (e) {
                self.result = "Error";
                app.alert.show('AutherizationTest-Error', {
                    level: 'error',
                    messages: app.lang.get('LBL_AUTHERIZATION_RETERIVE_ERROR',self.module),
                    autoClose: false,
                });
            }
        });
    }
})



