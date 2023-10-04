(function jsExtension(app) {
    const _extensionUniqueName = "addGoToConfigButton"; 
    const _entityToBeExtended = "login"; 

    SUGAR.mobile.extensions[_extensionUniqueName] = {
        extendsFrom: {
            baseType: _entityToBeExtended,
        },

        initialize() {
            let _initResult = this._super("initialize", arguments);

            this._initProperties();

            return _initResult;
        },

        render() {
            let _renderResult = this._super("render", arguments);

            this._addUserProfileButton();
            this._storeProfile();

            return _renderResult;
        },

        goToUserProfileView() {
            let userProfilesView = SUGAR.mobile.loadView(this.USER_PROFILES_VIEW, {
                isDynamic        : true,
                skipRegistration : true
            });

            userProfilesView.once("settings:submit", options => {
                this.render();
            });
        },

        _addUserProfileButton() {
            this.$el.find(this.SETTINGS_DIV).prepend(this.USER_PROFILES_HTML);
            this.$el.find(this.CONFIG_BTN).on("click", this.goToUserProfileView.bind(this));
        },

        _storeProfile() {
            let _profiles = {};
            const LOCAL_STORAGE_KEY = "wsysUserProfiles";
    
            let _lsProfiles = window.localStorage.getItem(LOCAL_STORAGE_KEY);
    
            if (typeof _lsProfiles === "string") {
                _profiles = JSON.parse(_lsProfiles);
            }
    
            let _loginTmpSettings = app.loginManager.getTempSetting();
            let _hasConfig = false;
    
            _.each(_profiles, function searchProfile(profileData){
                if (profileData.url === _loginTmpSettings.loginUrl) {
                    _hasConfig = true;
                }
            });
    
            if (_hasConfig == false) {
                let _profileId = app.utils.generateUUID();
                
                _profiles[_profileId] = {
                    url  : _loginTmpSettings.loginUrl,
                    user : _loginTmpSettings.loginName
                };
                
                _.each(_profiles, function createProfile(profileData, profId){
                    _profiles[profId].inUse = false;
                }, this);
        
                _profiles[_profileId].inUse = true;
        
                window.localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(_profiles));
            }
        },

        _initProperties() {
            this.USER_PROFILES_VIEW = "user-profiles";
            this.SETTINGS_DIV = ".login__settings_div";
            this.CONFIG_BTN = ".userConfig";
            this.USER_PROFILES_HTML = 
`
<a class="fast-click-highlighted">
    <i class="userConfig icondefault icon icon-user icon-size-md"></i>
</a>            
`;
        },
    };
})(SUGAR.App);
