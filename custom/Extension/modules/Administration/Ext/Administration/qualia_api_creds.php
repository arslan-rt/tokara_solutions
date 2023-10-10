<?php

$admin_option_defs = array();
$admin_option_defs['Administration']['qualia_api_creds'] = array(
    //Icon name. Available icons are located in ./themes/default/images
    'Administration',

    //Link name label
    'LBL_LINK_QUALIA_API_NAME',

    //Link description label
    'LBL_LINK_QUALIA_API_DESCRIPTION',

    //Link URL - For Sidecar modules
    'javascript:parent.SUGAR.App.router.navigate("Home/layout/qualia_api_layout", {trigger: true});',

    //Alternatively, if you are linking to BWC modules
    //'./index.php?module=<module>&action=<action>',
);

$admin_group_header[] = array(
    //Section header label
    'LBL_SECTION_QUALIA_API_HEADER',

    //$other_text parameter for get_form_header()
    '',

    //$show_help parameter for get_form_header()
    false,

    //Section links
    $admin_option_defs,

    //Section description label
    'LBL_SECTION_QUALIA_API_DESCRIPTION'
);
