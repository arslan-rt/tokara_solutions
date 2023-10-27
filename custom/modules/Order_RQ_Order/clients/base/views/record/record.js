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

    syncOrderRelatedData: function() {
        if(!_.isUndefined(this.model.get('qualia_id'))) {
            app.api.call('read', app.api.buildURL('GetOrder/' + this.model.get("qualia_id")), {}, {
                success: function(data) {
                    app.alert.show('order-synced', {
                        level: 'success',
                        messages: app.lang.get('LBL_ORDER_SYNC_COMPLETE', 'Order_RQ_Order'),
                        autoClose: false
                    });
                },
                error: function(e) {
                     app.alert.show('order-sync-failed', {
                        level: 'error',
                        messages: app.lang.get('LBL_ORDER_SYNC_FAILED', 'Order_RQ_Order'),
                        autoClose: false
                    });
                }
            });
        }

    }
})