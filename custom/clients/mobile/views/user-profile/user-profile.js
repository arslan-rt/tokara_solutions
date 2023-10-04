/**
 * Class Description
 *
 * @class user-profiles
 */
({
    events() {
        return {
            "click #chooseProfile" : "chooseUserProfile", // we can register events here
            "change #urlInput"     : "urlChanged",
            "change #userInput"    : "userChanged"
        };
    },

    initialize(options) {
        let _initResult = this._super("initialize", arguments);

        this._initProperties();

        return _initResult;
    },
    
    chooseUserProfile(ev) {
        this._manager.chooseProfile(this._id);
    },

    userChanged(ev) {
        this._user = ev.currentTarget.value;

        this._manager.updateProfileData(this._id, {
            user : this._user,
            url  : this._url
        });
    },
    
    urlChanged(ev) {
        this._url = ev.currentTarget.value;

        this._manager.updateProfileData(this._id, {
            user : this._user,
            url  : this._url
        });
    },

    fillProfile(profileId, profileData) {
        this._url = profileData.url;
        this._user = profileData.user;
        this._canChoose = !profileData.inUse;
        this._id = profileId;
    },

    _initProperties() {
        this._manager = this.options.manager;
        this._canChoose = true;
        this._url = "";
        this._user = "";
        this._id = app.utils.generateUUID();
    },
});
