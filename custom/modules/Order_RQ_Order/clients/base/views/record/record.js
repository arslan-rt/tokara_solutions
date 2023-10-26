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

({
    extendsFrom: 'RecordView',
    events: {
        'click a[name=sync_order]': 'syncOrderRelatedData',

    },
    initialize: function (options) {
        this._super('initialize', [options]);
        console.log('from Order');
    },

    syncOrderRelatedData: function() {
        console.log('Sync Order clicked', this.model.get('qualia_id'));
        if(!_.isUndefined(this.model.get('qualia_id'))) {
            app.api.call('read', app.api.buildURL('GetOrder/' + this.model.get("qualia_id")), {}, {
                success: function(data) {
                  if (data.success == true) {
                        app.alert.show('order-synced', {
                            level: 'success',
                            messages: 'This Order and its related modules records have been synced successfully!',
                            autoClose: false
                        })
                  }
                },
                error: function(e) {
                    console.log('Order API call failed.')
                }
            });
        }

    }
})