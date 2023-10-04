/**
 * Class Description
 *
 * @class user-profiles
 */
({
    headerConfig: {
        title    : "User Profiles", // title that is going to be displayed on the header when the view is on screen
        back     : true, // show the back button in the header of the view
        mainMenu : false // show the main menu button in the header of the view
    },

    events() {
        return {
            "click #addProfile": "createUserProfile" // we can register events here
        };
    },

    render(options) {
        let _result = this._super("render", arguments);

        this._initProperties();
        this._loadProfiles();

        return _result;
    },
    
    createUserProfile(ev, profileId, profileData) {
        var profileElement = app.view.createView({
            name    : app.mobile.views.MobileUserprofileView,
            model   : this.model,
            context : this.context,
            manager : this,
        });

        if (typeof profileId === "string") {
            profileElement.fillProfile(profileId, profileData);
        }

        profileElement.render();

        this.$el.find(this.USER_PROFILES_CONTAINER).append(profileElement.$el);
    },

    updateProfileData(profileId, profileData) {
        this._profiles[profileId] = profileData;

        window.localStorage.setItem(this.LOCAL_STORAGE_KEY, JSON.stringify(this._profiles));
    },

    chooseProfile(profileId) {
        _.each(this._profiles, function createProfile(profileData, profId){
            this._profiles[profId].inUse = false;
        }, this);

        this._profiles[profileId].inUse = true;

        window.localStorage.setItem(this.LOCAL_STORAGE_KEY, JSON.stringify(this._profiles));

        const settings = {
            loginUrl  : this._profiles[profileId].url,
            loginName : this._profiles[profileId].user,
        };

        app.loginManager.applyLoginSettings(app.loginManager.setTempSetting(settings));

        app.loginManager.verifyLoginSettings((errorCode, error) => {
            if (
                // eslint-disable-next-line no-bitwise
                errorCode & app.loginManager.LoginSettingsErrorCode.SSO_NOT_SUPPORTED
            ) {
                app.error.handleExternalLoginNotAvailable();
            }

            if (
                // eslint-disable-next-line no-bitwise
                errorCode & app.loginManager.LoginSettingsErrorCode.SSL_NOT_SUPPORTED
            ) {
                app.alert.show("invalid_login_settings", {
                    level     : "error",
                    messages  : app.lang.get("ERR_MOBILE_HTTPS_CONNECTION_FAILED_LOGIN"),
                    autoClose : true,
                });
            }

            if (
                // eslint-disable-next-line no-bitwise
                errorCode & app.loginManager.LoginSettingsErrorCode.SSL_AVAILABLE
            ) {
                
                app.alert.show("invalid_login_settings", {
                    level     : "error",
                    messages  : app.lang.get("ERR_MOBILE_HTTP_CONNECTION_FAILED_LOGIN"),
                    autoClose : true,
                });
            }

            if (
                // eslint-disable-next-line no-bitwise
                errorCode & app.loginManager.LoginSettingsErrorCode.OTHER_HTTP_ERROR
            ) {
                app.error.handleHttpError(error);
            }

            this.trigger("settings:submit");
            this.layout._header.onBackClicked();
        });

    },

    _loadProfiles() {
        _.each(this._profiles, function createProfile(profileData, profileId){
            this.createUserProfile(false, profileId, profileData);
        }, this);
    },

    _initProperties() {
        this._profiles = {};
        this.USER_PROFILES_CONTAINER = "#profilesContainer";
        this.LOCAL_STORAGE_KEY = "wsysUserProfiles";

        let _profiles = window.localStorage.getItem(this.LOCAL_STORAGE_KEY);

        if (typeof _profiles === "string") {
            this._profiles = JSON.parse(_profiles);
        }

        let _loginTmpSettings = app.loginManager.getTempSetting();
        let _hasConfig = false;

        _.each(this._profiles, function searchProfile(profileData){
            if (profileData.url === _loginTmpSettings.loginUrl) {
                _hasConfig = true;
            }
        });

        if (_hasConfig == false) {
            this.updateProfileData(app.utils.generateUUID(), {
                url   : _loginTmpSettings.loginUrl,
                user  : _loginTmpSettings.loginName,
                inUse : true
            });
        }
    },
});
