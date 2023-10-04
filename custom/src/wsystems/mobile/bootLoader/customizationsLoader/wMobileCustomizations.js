
(function(app){
    SUGAR.mobile = {
        widgets: {},
        views: {},
        fields: {},
        layouts: {},
        dashlets: {},
        extensions: {},
        styles: {},
    };
    app.mobile = {
        widgets: {},
        views: {},
        fields: {},
        layouts: {},
        dashlets: {},
        styles: {},
    };
   SUGAR.mobile.views["add-checkbox-view-on-inner-list"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };

    SUGAR.mobile.views["add-checkbox-view-on-inner-list"]["templates"]["add-checkbox-view-on-inner-list"] = "<style>\n  .left-menu {\n    width: 50px;\n    background-color: #f3f5f6; \n    display: inline-block; \n    position: absolute; \n    left: 0px; \n    top: 0px; \n    height: 100%;\n    -webkit-transition: width 12s, height 4s; \/* For Safari 3.1 to 6.0 *\/\n    transition: width 12s, height 4s;\n  }\n\n.boxes {\n  margin: auto;\n  padding: 50px;\n  background: #484848;\n}\n\n.fix-element-in-middle {\n  position: absolute;\n  left: 25%;\n  top: 30%;\n}\n\n.element-detector-input { display: none }\n.element-detector-label {}\n\ninput[class=\"element-detector-input\"]:checked ~ div {\n  padding-left: 45px;\n}\n\ninput[class=\"element-detector-input\"]:checked ~ label {\n  -webkit-transition:all 0.1s linear;\n  -moz-transition:all 0.1s linear;\n  -o-transition:all 0.1s linear;\n  -ms-transition:all 0.1s linear;\n  transition:all 0.1s linear;\n  display: block !important;\n  width: 50px;\n  margin-left: 0px;\n}\ninput[class=\"element-detector-input\"] ~ label {\n  \/* we have to keep unset display when the checkbox is hidden\n  to be able to get the slow show effect *\/\n  display: unset; \n  margin-left: -50px;\n}\n\ninput[class=\"element-detector-input\"] ~ div {\n  padding-left: 0px;\n}\n\n.element-hide {\n  display: none;\n}\n<\/style>\n\n<input type=\"checkbox\" attrfordetection=\"checkbox\" class=\"element-detector-input\"><\/input>\n<label class=\"left-menu element-detector-label\">\n  <i style=\"color: #2b79c8;position: absolute;left: 50%;top: 50%;-webkit-transform: translate(-50%, -50%);transform: translate(-50%, -50%);background-color: transparent;\/* border-radius: 10px; *\/font-size: 1.30em;\"\n    class=\"fas fa-check\" aria-hidden=\"true\"><\/i>\n<\/label>";   SUGAR.mobile.views["user-profile"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };

    SUGAR.mobile.views["user-profile"]["templates"]["user-profile"] = "<div id=\"userProfileView\">\n    <div class=\"field\" field-name=\"url\" field-type=\"url\" style=\"margin-left: 5px;margin-top: 10px;\">\n        <div class=\"field__controls\">\n            <label class=\"field__label settings__control_label_url\">Server URL<\/label>\n            <span class=\"input-wrapper\">\n                <input id=\"urlInput\" type=\"url\" class=\"login_settings_server_url\"\n                    placeholder=\"your-wMobileForSugarCRM-instance.com\" value=\"{{_url}}\" autocapitalize=\"off\"\n                    autocorrect=\"off\" autocomplete=\"off\">\n                <i class=\"icondefault icon icon-remove clear-button\"><\/i>\n            <\/span>\n        <\/div>\n        <div class=\"field__controls\">\n            <label class=\"field__label settings__control_label_url\">User<\/label>\n            <span class=\"input-wrapper\">\n                <input id=\"userInput\" type=\"text\" class=\"login_settings_server_url\" placeholder=\"username\"\n                    value=\"{{_user}}\" autocapitalize=\"off\" autocorrect=\"off\" autocomplete=\"off\">\n                <i class=\"icondefault icon icon-remove clear-button\"><\/i>\n            <\/span>\n        <\/div>\n    <\/div>\n    {{#if _canChoose}}\n        <a id=\"chooseProfile\" class=\"btn\" style=\"float: right;color: green;\"><i class=\"fas fa-check\"\n                style=\"color: green;\"><\/i>&nbsp; Use\n            Profile<\/a>\n    {{else}}\n        <a id=\"chooseProfile\" class=\"btn\" style=\"float: right;color: green;\">In Use...<\/a>\n    {{\/if}}\n<\/div>";
    SUGAR.mobile.views["user-profile"]["controller"] = /**
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
;   SUGAR.mobile.views["uMaps-route-collection"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };
   SUGAR.mobile.views["user-profiles"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };

    SUGAR.mobile.views["user-profiles"]["controller"] = /**
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
;
    SUGAR.mobile.views["user-profiles"]["templates"]["user-profiles"] = "<a id=\"addProfile\" class=\"btn\" style=\"float: right;\"><i class=\"fas fa-plus\" style=\"color: #6b7479;\"><\/i>&nbsp; Add\n    Profile<\/a>\n<div id=\"profilesContainer\">\n<\/div>";   SUGAR.mobile.views["uMaps-mobile"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };
   SUGAR.mobile.widgets["mobileButton"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };
   SUGAR.mobile.widgets["mobileMasterButton"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };

    SUGAR.mobile.widgets["mobileMasterButton"]["templates"]["wSystemsLogo"] = "<img class=\"masterButtonIconLogo\" id=\"masterButtonIcon\" src=\"data:image\/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAABCFBMVEVHcEz\/\/\/\/\/\/\/\/\/\/\/\/8\/Pz8\/Pz\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/5+fn\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/MzMzOzs7MzMzh4eHLy8vz8\/PMzMz\/\/\/\/MzMz\/\/\/\/Ly8v6+vrPz8\/+\/v7X19fT09Pb29vv7+\/h4eHq6url5eX29vby8vKCN9xWAAAASHRSTlMA9wUfCwMI\/WHGAvvM5cAU9CcQGQ6fduDRQO1M8q7wuFy8Reo3cy1kXrOVOwGaaiol16hvHFGG24t+M6OCWNWPVvRNseGd4bc0fC53AAAF10lEQVR42u1a2VriShBmkwAhrAZQdgQVgYiIqON69soXxVFR3\/9NDnGSQEhXNwlMcpO6pdJVdG1\/\/92BgC+++OKLL7744ou3EvLW+vCo4aH53dagOBp7Zj4fa2YgFfbMvJTkAUqnHpnPHSU5ABBa3piPllM8AEDmyBPz\/UOxAt9y5UkJ5jrFX+ahnvbAfKJX5zX7xR9eVH5H0MxD0IsEOKzqfx9AjLrfdx\/PDPNQGrqffZPKwn7mznX72Sq3sA8D1wOwl1wyD\/dZt8PfEJbtu14BkUJt2T5UIy6n30PQZF9ouzx5Rc5kH277rtoPV83mIekuCBrWV+wH3UWB2dSKfejuemt\/f89b+3DiJgoZNi32i4du5n\/dYh9uXcR+6arV\/r2L54Bd0Wqf6xAUG7FlaVy0DsfmWXlqUjh+LLezuR029r7irA4k8wRNc6JwfPDgsn7bW\/Jhr2ZW4CtCUjwO0\/vpTidotc8Tp2CMoAm1ai9h7GWToMCdFaioulEjfBQnfjIuAUkEyShYiajA1SkHu70i4Qv+mKw8Ia4PmY7uQbZI1oijHmSTJP1Ujqzdq5HXrz3q8RTJCtBFopDukrR5bApF6sj6BnK7CJIVuGtiJoZIBYBvwDzGHOKB3rfTSUSBjG1iGVsbMG\/ZSIwXk+saUYAbArxuk5fDNyCwM0DX17bgxwGiULMO13yTqMnHKEVbDmJb0NPaWpXl4lICICVDaxvpOLb+idaOYliaHKxmwV2FnK8StXGiMS5qpR6+xDSuVjoAua1BKU91AI0xFLTZeoIpnJkGbFSkr4OOLjTGeuhaGUSBO2IOFoubBDnmkfWDZW0ipTAX60vnrOwZosQEQmHsSxC1NO8Ao1LUjcTqmY0E+w9oGmr9+FDANCbGKhcVRjHRzu\/Yt3Cu1fcIUzASPB9nbxKO4NAYN7UYP2Jpwut0SwFrFqN1+JBzYHTbfAnTGH2nyc7wb+T3THkdEHsqsFrNBFMQvlMs9M\/LE7KHa50GQzfY+vfacbq3T+1Wf\/7x\/EkO0ZqEDIY6jEGOAhdIzf9i5C9Z\/nLShRdjNAmMHEKBS6alboAsz4i\/Xq97lLmlx5gCXOAkEPlPlpV34tdr34q09xkTKYECl8uxugHK65Tw22BnXQciXXQiaWiqjE0kXppngKz8JJRBxca1zBHHKGQcuPw73wBZJpVB3QYniKOOQYIBXJ5+KqoHb\/agoOU6A0Udl0MWcHlXHVA+HNfgmqgDBy5fz6oDrxsyIjk0xl0tkg1sIk1fFFlWLM34wObFUAFFHRr4Hd9jGjNiFo7scWJ9NupAgcunGoPVZhy8sMvrM1EHDlzUNFRmNk4jRLlDwekFC7i8ydZmXLBPrZdYZzAUuDzN01B5mTobAwu5Yp2RsuhE+lBWm7HogJbF6BIAjeILibQ0fP4inCns0YtNGuqgApfpq2JuxvGcE4JTwhzQxxpKl6itwNSMC07sU2L80GeA0\/lEWoYEgjNiHKXEjANmmzKRlpvxjcObAZQu0XnGaJcykRbN2HYXNOgSNMbVKAO4qK3AyMKk4wcSKOrQRxsOXGbKohk7v5rAUcc1C7h8PhvN+MD5Cw0mXdJHgcu8FejNuLrBBf0xx6BLcODyJmvNGGPG1wOnKF2iY\/wC3go0SHC2yeUQhS4Zso7SH1oWPmz23AGdSBLrKP0lfyAUrq0HB10WXYKekaYv3824u+ETBRT81jS2J4cCo5mahfymN+T4Uf2Kdcfw+fKJXM\/Zkg7HAKe4i+9vwJ1vfO05LrEosXPMxbcZlLbwRkLiqZQYhRR8mvHSFm5+000GXRK4wwrhazsPBfcEBvGOEcNTYTtvJPpShk6XBMLkUsxIW3qlE+pUUEoMfaABUOls7Y1G6LHEoL7DA4uPpbttvhEJF+L7HEqXqHnQEi8XEJLbjxe2\/UIi145NxG4zbpJl3isULndORvVUsytOYu3f80QoEYpGTGLZ5LlCNJQI+OKLL7744osvvjiT\/wFqVhC31sfrswAAAABJRU5ErkJggg==\" style=\"width:  38px;\">";
    SUGAR.mobile.widgets["mobileMasterButton"]["templates"]["mobileMasterButton"] = "<input id=\"masterButton\" class=\"masterButton masterButtonInputPlaceHolder\" type=\"checkbox\" \/>\n<label id=\"masterButtonLabel\" class=\"masterButtonLabelPlaceHolder\" style=\"box-shadow: 0 3px 5px -1px rgba(0,0,0,.2), 0 6px 10px 0 rgba(0,0,0,.14), 0 1px 18px 0 rgba(0,0,0,.12);\">\n    <div id=\"masterButtonIcon\" class=\"masterButtonIcon masterButtonIconPlaceHolder\" style=\"font-size:  25px\"><\/div>\n<\/label>";
    SUGAR.mobile.widgets["mobileMasterButton"]["controller"] = /*eslint-disable*/
class MobileMasterButton {
    constructor(masterButtonConfig, id, manager) {
        this.manager = manager;
        this.id = id;
        this.config = masterButtonConfig;
        this.html = SUGAR.mobile.widgets.mobileMasterButton.templates.mobileMasterButton;

        this.buttons = {};
        this.buttonsConfig = {};
        this.buttonHeight = 3.2;
        this.buttonDelay = 0.0;
        this.initialHeight = 1.5;

        this.createMasterButton();
        this.createNewButtons();
    }

    createMasterButton() {
        this.manager.container.append(this.html);

        $(".masterButtonInputPlaceHolder")
            .addClass("masterButtonInput" + this.id)
            .removeClass("masterButtonInputPlaceHolder");
        $(".masterButtonLabelPlaceHolder")
            .addClass("masterButtonLabel" + this.id)
            .removeClass("masterButtonLabelPlaceHolder");
        $(".masterButtonIconPlaceHolder")
            .addClass("masterButtonIcon" + this.id)
            .removeClass("masterButtonIconPlaceHolder");

        this.masterButton = $(".masterButtonInput" + this.id);
        this.masterButtonLabel = $(".masterButtonLabel" + this.id);
        this.masterButtonIcon = $(".masterButtonIcon" + this.id);

        this.masterButtonIcon.addClass(this.config.icon);
        this.masterButtonIcon.css("color", this.config.color);
        this.masterButtonLabel.css("background-color", this.config.backgroundColor);

        if (this.config.isMainButton) {
            this.masterButtonLabel.empty();
            this.masterButtonLabel.append(SUGAR.mobile.widgets.mobileMasterButton.templates.wSystemsLogo);
            this.masterButtonIcon = $(".masterButtonIconLogo");

            if (SUGAR.rebrandedLogo) {
                $(".masterButtonIconLogo").attr("src", SUGAR.rebrandedLogo);

            }

            if (SUGAR.rebrandedLogoSize) {
                $(".masterButtonIconLogo").css("width", SUGAR.rebrandedLogoSize);
            }

            if (SUGAR.rebrandedLogoMarginRight) {
                $(".masterButtonIconLogo").css("margin-right", SUGAR.rebrandedLogoMarginLeft);
            }

            if (SUGAR.rebrandedLogoMarginLeft) {
                $(".masterButtonIconLogo").css("margin-left", SUGAR.rebrandedLogoMarginLeft);
            }

            if (SUGAR.rebrandedLogoBackground) {
                $("#masterButtonLabel").css("background-color", SUGAR.rebrandedLogoBackground);
            }
        }

        var newIconWidth = this.masterButtonIcon.width();
        var newIconHeight = this.masterButtonIcon.height();

        if (newIconHeight === 0) {
            newIconHeight = newIconWidth;
        }

        this.masterButtonIcon.css("margin-left", this.masterButtonLabel.width() / 2 - newIconWidth / 2 + "px");
        this.masterButtonIcon.css("margin-top", this.masterButtonLabel.height() / 2 - newIconHeight / 2 + "px");

        this.masterButtonIcon.on("click", function triggerChange() {
            var nextCheckedValue = !this.masterButton.prop('checked');
            this.masterButton.prop('checked', nextCheckedValue);

            this.showPressedFeedback();
            if (!nextCheckedValue) {
                if (this.config.isMainButton) {
                    this.manager.hideOverlay();
                } else {
                    this.hideWidget();

                    this.config.mainButton.showWidget();
                }
            }

            this.notifyButtons(nextCheckedValue);
        }.bind(this));

        this.dragItem = document.querySelector("#mobileButtonsContainer");
        this.dragItemLabel = document.querySelector("#masterButtonLabel");
        this.dragItemIcon = document.querySelector("#masterButtonIcon");
        this.active = false;
    }

    createNewButtons() {
        _.each(this.config.children, this.createButton, this);
    }

    createButton(buttonConfig, buttonId) {
        var buttonsNumber = 1;
        _.each(this.buttons, function getButtonsNumber(button) {
            if (button.config.horizontalButton === buttonConfig.horizontalButton) {
                buttonsNumber = buttonsNumber + 1;
            }
        });

        var currentButtonConfig = _.clone(buttonConfig);

        if (!isNaN(buttonId)) {
            buttonId = app.utils.generateUUID();
        }

        currentButtonConfig.transform = this.initialHeight + buttonsNumber * this.buttonHeight;
        currentButtonConfig.delay = buttonsNumber * this.buttonDelay;
        currentButtonConfig.manager = this;

        var button = new SUGAR.mobile.widgets.mobileButton.controller(
            currentButtonConfig,
            this.manager.container,
            buttonId,
            buttonsNumber
        );
        this.buttons[buttonId] = button;
    }

    setEnabledHorizontalButtonsData(horizontalButtonsData) {
        if (horizontalButtonsData && horizontalButtonsData.length > 0) {
            _.each(this.buttons, function setNewData(buttonData) {
                if (buttonData.config.data && buttonData.config.data.module) {
                    var buttonStateModified = false;

                    _.each(horizontalButtonsData, function getCorrectModule(moduleData) {
                        if (moduleData.module === buttonData.config.data.module) {
                            buttonData.checked = true;
                            buttonStateModified = true;
                        }
                    });

                    if (!buttonStateModified) {
                        buttonData.checked = false;
                    }
                }
            });
        }
    }

    getEnabledHorizontalButtonsData() {
        var enabledHorizontalButtons = [];

        _.each(this.buttons, function getButtons(button) {
            if (button.config.horizontalButton && button.checked) {
                enabledHorizontalButtons.push(button.config.data);
            }
        });

        return enabledHorizontalButtons;
    }

    enableHorizontalButtons() {
        _.each(this.buttons, function getButtons(button) {
            if (button.config.horizontalButton) {
                button.checked = true;
            }
        });
    }

    disableHorizontalButtons() {
        _.each(this.buttons, function getButtons(button) {
            if (button.config.horizontalButton && button.checked) {
                button.checked = false;
            }
        });
    }

    createNewMasterButton(buttonConfig) {
        if (this.currentButtonConfig) {
            var currentButtonConfig = _.clone(this.currentButtonConfig);

            currentButtonConfig.children = buttonConfig;
            currentButtonConfig.mainButton = this;

            var masterId = app.utils.generateUUID();
            var newMasterButton = this.manager.createMasterButton(currentButtonConfig, masterId);

            currentButtonConfig.masterButton = newMasterButton;
            this.currentButtonConfig.masterButton = newMasterButton;

            this.hideWidget(true);
            newMasterButton.showWidget();
        }
    }

    getFinalPosition(buttonEntity) {
        var buttonsNumber = 1;
        var buttonFound = false;

        _.each(this.buttons, function getButtonsNumber(button, buttonId) {
            if (buttonId === buttonEntity.buttonId) {
                buttonFound = true;
            } else if (
                !buttonFound &&
                button.config.horizontalButton === buttonEntity.config.horizontalButton &&
                button.canShow()
            ) {
                buttonsNumber = buttonsNumber + 1;
            }
        });

        return {
            transform: this.initialHeight + buttonsNumber * this.buttonHeight,
            delay: buttonsNumber * this.buttonDelay
        };
    }

    showLoadingScreen(loadingScreenSettings) {
        this.manager.handleLoadingScreen(loadingScreenSettings);
    }

    showPressedFeedback() {
        this.manager.mobileButtonsOverlay.show();
        var transitionSpeed = 150;
        var targetOpacity = 0.8;

        this.manager.container.animate({
                opacity: targetOpacity
            },
            transitionSpeed,
            function wiggle() {
                this.manager.container.animate({
                        opacity: 1
                    },
                    transitionSpeed
                );
            }.bind(this)
        );
    }

    notifyButtons(checked) {
        _.each(this.buttons, function destroyMasterButton(button) {
            button.masterButtonPressed(checked);
        });
    }

    closeWidget(keepOverlay) {
        this.masterButton.prop("checked", false);

        if (!keepOverlay) {
            this.manager.mobileButtonsOverlay.hide();
        }

        this.notifyButtons(false);
    }

    hideWidget(keepOverlay) {
        this.masterButton.attr("disabled", true);
        this.masterButtonLabel.hide();
        this.closeWidget(keepOverlay);

        _.each(this.buttons, function hideAllButtons(button) {
            button.hide();
        });
    }

    showWidget() {
        this.masterButton.removeAttr("disabled");
        this.masterButtonLabel.show();
        this.manager.container.prepend(this.masterButtonLabel);
        this.manager.container.prepend(this.masterButton);
        this.masterButton.prop("checked", true);

        _.each(this.buttons, function destroyMasterButton(button) {
            button.show();
        });
    }

    goToMainWidget() {
        this.manager.goToMainWidget();
    }

    destroy() {
        _.each(this.buttons, function destroyMasterButton(button) {
            button.destroy();
        });
    }
};   SUGAR.mobile.widgets["mobileButtonsManager"] = {
        controller: {},
        meta: {},
        templates: {},
        styles: {},
    };

    SUGAR.mobile.widgets["mobileButtonsManager"]["templates"]["mobileButtonsContainer"] = "<div style=\"position:absolute;width:100%;height:100%;z-index:9000;display:none;\" id=\"mobileButtonsOverlay\"><\/div>\n<div id=\"mobileButtonsContainer\" style=\"position:absolute;z-index:9999;height:100px;width:100px;\"><\/div>\n<link rel=\"stylesheet\" href=\"https:\/\/use.fontawesome.com\/releases\/v5.4.1\/css\/all.css\" integrity=\"sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz\" crossorigin=\"anonymous\">\n<style>\nbody {\n--l: 4em;\n}\n\n.masterButton {\ndisplay: none;\n}\n\n.masterButton + label {\ncursor: pointer;\nposition: absolute;\nright: 1em; bottom: 1em;\nbackground-color: tomato;\nheight: var(--l); width: var(--l);\nborder-radius: 50%;\nz-index: 2;\n}\n\n.masterButton:checked + label:before { transform: rotatez(-45deg); }\n\n.masterButton:checked + label:after { transform: rotatez(-45deg); }\n\n.mobileButton {\ncursor: pointer;\nposition: absolute;\nright: 1em; bottom: 1em;\npadding: 1em;\nwidth: 1em; height: 1em;\nborder-radius: 50%;\nopacity: 0;\nz-index: 1;\ntransform: rotateZ(90deg);\nfont-size: 1em;\ncolor: #fff;\ntransition-property: all;\ntransition-duration: .35s;\ntransition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);\n}\n\n.masterButton:checked ~ .mobileButton {\nopacity: 1;\n}\n\n.masterButton:checked ~.mobileButton:hover {\nopacity: .9;\n}\n<\/style>";
    SUGAR.mobile.widgets["mobileButtonsManager"]["controller"] = /*eslint-disable*/
class MobileButtonsManager {
    constructor(containerHtml, masterButtonHtml) {
        this.masterButtons = {};
        this.masterButtonsConfig = {};

        this.createContainer(containerHtml);
        this.initialize();
    }

    initialize() {
        app.on("app:orientation:changed", this.handleDeviceOrientationChanged.bind(this));
        if (!app.controller.navigationExtended) {
            app.controller.navigationExtended = true;
            var navFunction = app.controller.navigate;
            var buttonsManager = this;

            app.controller.navigate = function (url, options) {
                navFunction.call(app.controller, url, options);

                buttonsManager.handleViewChange();
            };
        }

        document.getElementById("nomad").appendChild(document.getElementById("customizationsLoadingScreen"));
    }

    createContainer(containerHtml) {
        $("#nomad").append(containerHtml);
        this.container = $("#mobileButtonsContainer");
        this.mobileButtonsOverlay = $("#mobileButtonsOverlay");
        this.mobileButtonsLoadingScreen = $("#customizationsLoadingScreen");
        this.loadingScreenLabel = $("#customizationsLoadingScreenLabel");
        this.mobileButtonsOverlay.on("click", this.closeMasterButtons.bind(this));
        this.mobileButtonsOverlay.on("touchmove", this.closeMasterButtons.bind(this));

        this.initContainerPosition();
    }

    getInitialContainerPosition() {
        var containerSize = 100;
        var containerXPos = window.innerWidth - containerSize;
        var containerYPos = window.innerHeight - containerSize;

        var initialContainerPosition = "translate3d(" + containerXPos + "px, " + containerYPos + "px, 0px)";

        return initialContainerPosition;
    }

    initContainerPosition() {
        this.container.css("transform", this.getInitialContainerPosition());
    }

    closeMasterButtons() {
        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                masterButton.closeWidget();
            }.bind(this)
        );
        this.hideOverlay();
    }

    hideOverlay() {
        this.mobileButtonsOverlay.hide();
    }

    dragStart(e) {
        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                if (e.target === masterButton.dragItemLabel || e.target.id === masterButton.dragItemIcon.id) {
                    this.active = true;
                }
            }.bind(this)
        );
    }

    dragEnd(e) {
        var transitionActivated = false;

        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                var container = masterButton.manager.container;
                var containerPosition = container.position();
                var masterButtonPosition = masterButton.masterButtonLabel.position();
                if (
                    !transitionActivated &&
                    container &&
                    this.active &&
                    (containerPosition.left + masterButtonPosition.left < 0 ||
                        containerPosition.left + masterButtonPosition.left + masterButton.masterButtonLabel.width() >
                        window.innerWidth ||
                        containerPosition.top + masterButtonPosition.top < 0 ||
                        containerPosition.top + masterButtonPosition.top + masterButton.masterButtonLabel.height() >
                        window.innerHeight)
                ) {
                    transitionActivated = true;
                    var transitionSpeed = 100;
                    var containerSize = 100;
                    var wiggleWidth = 20;
                    var containerXPos = window.innerWidth - containerSize;
                    var containerYPos = window.innerHeight - containerSize;

                    container.animate({
                            transform: "translate3d(" + containerXPos + "px, " + containerYPos + "px, 0px)"
                        },
                        transitionSpeed,
                        function wiggle() {
                            container.animate({
                                    transform: "translate3d(" +
                                        (containerXPos - wiggleWidth) +
                                        "px, " +
                                        containerYPos +
                                        "px, 0px)"
                                },
                                transitionSpeed,
                                function wiggleBack() {
                                    container.animate({
                                            transform: "translate3d(" + containerXPos + "px, " + containerYPos + "px, 0px)"
                                        },
                                        transitionSpeed
                                    );
                                }
                            );
                        }
                    );
                }
            }.bind(this)
        );

        this.active = false;
    }

    drag(e) {
        if (this.active) {
            e.preventDefault();
            var currentX = 0;
            var currentY = 0;

            if (e.type === "touchmove") {
                currentX = e.touches[0].clientX;
                currentY = e.touches[0].clientY;
            } else {
                currentX = e.clientX;
                currentY = e.clientY;
            }

            _.each(
                this.masterButtons,
                function goThroughMasterButtons(masterButton) {
                    if (masterButton.masterButton.attr("checked")) {
                        masterButton.masterButton.prop("checked", false);
                        masterButton.notifyButtons(false);
                    }
                }.bind(this)
            );

            this.setTranslate(currentX, currentY);
        }
    }

    setTranslate(xPos, yPos) {
        var buttonRadius = 50;

        xPos = xPos - buttonRadius;
        yPos = yPos - buttonRadius;
        this.container.css("transform", "translate3d(" + xPos + "px, " + yPos + "px, 0)");
    }

    setEnabledHorizontalButtonsData(data) {
        return this.masterButtons.mainButton.setEnabledHorizontalButtonsData(data);
    }

    getEnabledHorizontalButtonsData() {
        return this.masterButtons.mainButton.getEnabledHorizontalButtonsData();
    }

    enableHorizontalButtons() {
        return this.masterButtons.mainButton.enableHorizontalButtons();
    }

    disableHorizontalButtons() {
        return this.masterButtons.mainButton.disableHorizontalButtons();
    }

    registerMobileButtons(newButtons) {
        _.each(
            newButtons,
            function registerButtons(buttonConfig) {
                this.masterButtonsConfig[app.utils.generateUUID()] = buttonConfig;
            },
            this
        );
    }

    createMasterButtons() {
        if (Object.keys(this.masterButtonsConfig).length > 0) {
            $("#mobileButtonsContainer").show();
            this.initContainerPosition();
            var mainButtonId = "mainButton";
            var mainButtonConfig = {
                isMainButton: true,
                masterButton: true,
                name: "d",
                label: "Forth Button",
                icon: "fab fa-wikipedia-w",
                color: "white",
                backgroundColor: "rgb(0,66,121)",
                children: this.masterButtonsConfig
            };

            this.createMasterButton(mainButtonConfig, mainButtonId, true);
            this.wrapperContainer = document.querySelector("#nomad");

            this.wrapperContainer.addEventListener("touchstart", this.dragStart.bind(this), false);
            this.wrapperContainer.addEventListener("touchend", this.dragEnd.bind(this), false);
            this.wrapperContainer.addEventListener("touchmove", this.drag.bind(this), false);

            this.wrapperContainer.addEventListener("mousedown", this.dragStart.bind(this), false);
            this.wrapperContainer.addEventListener("mouseup", this.dragEnd.bind(this), false);
            this.wrapperContainer.addEventListener("mousemove", this.drag.bind(this), false);
        } else {
            $("#mobileButtonsContainer").hide();
        }
    }

    createMasterButton(masterButtonConfig, buttonId, mainButton) {
        this.masterButtons[buttonId] = new SUGAR.mobile.widgets.mobileMasterButton.controller(
            masterButtonConfig,
            buttonId,
            this
        );

        return this.masterButtons[buttonId];
    }

    goToMainWidget() {
        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                masterButton.hideWidget();
            }.bind(this)
        );

        if (this.masterButtons.mainButton) {
            this.masterButtons.mainButton.showWidget();
            this.masterButtons.mainButton.closeWidget();
        }
    }

    destroyExistingButtons() {
        this.container.empty();
        this.masterButtonsConfig = {};
        _.each(this.masterButtons, function destroyMasterButton(masterButton) {
            masterButton.destroy();
        });
        delete this.masterButtons;
        this.masterButtons = {};
    }

    cleanButtons() {
        var duplicatedIds = [];
        _.each(
            this.buttonsConfig,
            function getDuplicatedButtons(buttonConfig, buttonId) {
                _.each(
                    this.buttonsConfig,
                    function checkDuplicatedButtons(dupeButtonConfig, dupeButtonId) {
                        if (
                            dupeButtonConfig.name == buttonConfig.name &&
                            dupeButtonConfig.icon == buttonConfig.icon &&
                            dupeButtonConfig.color == buttonConfig.color &&
                            dupeButtonConfig.backgroundColor == buttonConfig.backgroundColor &&
                            dupeButtonConfig.label == buttonConfig.label &&
                            buttonId !== dupeButtonId &&
                            duplicatedIds.indexOf(dupeButtonId) < 0 &&
                            duplicatedIds.indexOf(buttonId) < 0
                        ) {
                            duplicatedIds.push(dupeButtonId);
                        }
                    },
                    this
                );
            },
            this
        );

        for (var idIndex = 0; idIndex < duplicatedIds.length; idIndex++) {
            delete this.buttonsConfig[duplicatedIds[idIndex]];
        }
    }

    hideLoadingScreen(hideTimer) {
        if (hideTimer) {
            setTimeout(
                function hideLoadingScreenWidget() {
                    this.mobileButtonsLoadingScreen.css("display", "none");

                    if (app.rebrandingManager) {
                        app.rebrandingManager.handleLoadingScreen(false);
                    }
                }.bind(this),
                hideTimer
            );
        } else {
            this.mobileButtonsLoadingScreen.css("display", "none");

            if (app.rebrandingManager) {
                app.rebrandingManager.handleLoadingScreen(false);
            }
        }
    }

    handleLoadingScreen(loadingScreenSettings) {
        var loadingScreenMessage = loadingScreenSettings.message ? loadingScreenSettings.message : "Loading ...";
        this.loadingScreenLabel.text(loadingScreenMessage);

        var loadingScreenOpacity = loadingScreenSettings.opacity ? loadingScreenSettings.opacity : 0.85;
        this.mobileButtonsLoadingScreen.css("opacity", loadingScreenOpacity);

        this.showLoadingScreen();

        if (loadingScreenSettings.autoHide) {
            setTimeout(
                function hideLoadingScreenWidget() {
                    this.hideLoadingScreen();
                }.bind(this),
                loadingScreenSettings.hideTimer
            );
        }
    }

    showLoadingScreen() {
        if (app.rebrandingManager) {
            app.rebrandingManager.handleLoadingScreen(true);
        }
        this.mobileButtonsLoadingScreen.css("display", "flex");
    }

    handleDeviceOrientationChanged() {
        this.initContainerPosition();
    }

    handleViewChange() {
        this.destroyExistingButtons();
        app.controller.trigger("mobile-context-changed", this);
        this.cleanButtons();
        this.createMasterButtons();

        if (app.rebrandingManager) {
            app.rebrandingManager.handleViewChange(App.controller.getScreenContext());
        }
    }
};
})(SUGAR.App);
/* eslint-disable require-jsdoc */
(function bootLoad(app) {
    class wMobileBootLoader {
        constructor() {
            this.declareProperties();
        }

        declareProperties() {
            this.BASE_FILE_PATH = "src/wsystems/mobile/include/require/wMobileApp/";

            this.VIEW_LOADER = "wMobileViewLoader";
            this.FIELD_LOADER = "wMobileFieldLoader";
            this.DASHLET_LOADER = "wMobileDashletLoader";
            this.ROUTE_HANDLER = "wMobileRouteHandler";

            this.ENTITIES_MAPPING = {
                "views"    : "wMobileViewLoader",
                "fields"   : "wMobileFieldLoader",
                "dashlets" : "wMobileDashletLoader",
            };

            this.customizationTools = app.NomadController.prototype.getCustomizationTools();
        }

        applyExtensions(extensions) {
            const baseExtensions = _.filter(extensions, function getBaseExtensions(extensionData){
                return extensionData.extendsFrom.module === undefined;
            });
            
            const customExtensions = _.filter(extensions, function getBaseExtensions(extensionData){
                return typeof extensionData.extendsFrom.module === "string";
            });

            this.enhanceClasses(baseExtensions);
            this.enhanceClasses(customExtensions);
        }

        enhanceClasses(extensions) {
            _.each(extensions, function handleExtension(extensionData) {
                let _baseType = extensionData.extendsFrom.baseType;

                if (this.isBaseField(_baseType)) {
                    this.wMobileFieldLoader.extend(_baseType, extensionData);
                } else if (this.isBaseDashlet(_baseType)) {
                    this.wMobileDashletLoader.extend(_baseType, extensionData);
                } else if (this.isBaseView(_baseType)) {
                    this.wMobileViewLoader.extend(_baseType, extensionData);
                }
            }, this);
        }

        loadMobileCustomizations() {
            _.each(
                SUGAR.mobile,
                function handleEntity(entities, entityName) {
                    if (this.ENTITIES_MAPPING[entityName]) {
                        this[this.ENTITIES_MAPPING[entityName]].load(entities);
                    }
                },
                this
            );

            // reload main menu after all of our customizations have been loaded
            if (app.nomad.mainMenu) {
                app.nomad.mainMenu.dispose();
            }
            
            delete app.nomad.mainMenu;
            app.nomad._syncedAppStart();

            // trigger an event, notifying all the listeners that we have completely loaded the customizations
            app.controller.trigger("wmobile:customizations:loaded");
        }

        loadFloatingButtons() {
            let _widgets = SUGAR.mobile.widgets;
            let _buttonsTemplates = _widgets.mobileButtonsManager.templates;

            let _mobileButtonsManager = new _widgets.mobileButtonsManager.controller(
                _buttonsTemplates.mobileButtonsContainer,
                _buttonsTemplates.mobileMasterButton
            );

            SUGAR.customizationTools.mobileButtonsManager = _mobileButtonsManager;
        }

        loadManagers() {
            this.loadRequired(this.ROUTE_HANDLER);
            this.loadRequired(this.VIEW_LOADER);
            this.loadRequired(this.FIELD_LOADER);
            this.loadRequired(this.DASHLET_LOADER);
        }

        loadRequired(className) {
            let _requiredClass = window.require(this.BASE_FILE_PATH + className)[className];
            this[className] = new _requiredClass(this);
        }

        declareGlobals() {
            SUGAR.customizationTools = this.customizationTools;
            SUGAR.customizationTools.wMobileBootLoader = this;

            SUGAR.mobile.getView = function getView(viewName) {
                return SUGAR.customizationTools.sdkViews[viewName];
            };

            SUGAR.mobile.getField = function getField(fieldName) {
                return SUGAR.customizationTools.sdkFields[fieldName];
            };

            SUGAR.mobile.getDashlet = function getDashlet(dashletName) {
                return SUGAR.customizationTools.sdkDashlets[dashletName];
            };
        }

        hideLoadingScreen() {
            const _hideTimer = 3000;

            setTimeout(function hideLoadingScreen() {
                SUGAR.customizationTools.mobileButtonsManager.hideLoadingScreen();
            }, _hideTimer);
        }

        isBaseView(viewName) {
            return app.nomad.getViewClass({
                baseType: viewName
            });
        }

        isBaseField(fieldName) {
            return app.nomad.getFieldClass({
                baseType: fieldName
            });
        }

        isBaseDashlet(dashletName) {
            return SUGAR.mobile.getDashlet(dashletName);
        }
    }

    let _bootLoader = new wMobileBootLoader();

    _bootLoader.declareGlobals();
    _bootLoader.loadFloatingButtons();
    _bootLoader.hideLoadingScreen();
})(SUGAR.App);
(function(modules) {
    let _modules = new Map();
    let _requireSpecific = function(modData) {
        let _module = {};
        _module.exports = {};

        modData.functionName(_module, _require);

        _modules.set(_module.name, _module.exports);
    };

    let _require = window.require = function(name) {
        var moduleData = _modules.get(name);

        if (!moduleData) {
            for (const module of modules) {
                if (module.requireName === name) {
                    _requireSpecific(module);
		    moduleData = _modules.get(name);
                }
            }
        }

        return moduleData;
    }

    for (const module of modules) {
        _requireSpecific(module);
    }
})(
[{'requireName': 'src/wsystems/mobile/include/javascript/wMobileApp/handleSlideGestureBevhaviorRightListView', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/javascript/wMobileApp/handleSlideGestureBevhaviorRightListView';
(function jsExtensionListView(app) {
    SUGAR.mobile.extensions["addCheckBoxOnListView"] = {
        extendsFrom: {
            baseType: "context-menu"
        },

        /**
         * @onItemSwipeLeft
         *
         * @ev    {Object} - element event
         * @model {Object} - element model
         *
         * add functionality on swipe left for checkbox
         */
        onItemSwipeLeft(ev, model) {
            const shouldAddFunctionality = $(ev.currentTarget).find(".menu-container").length;

            if (shouldAddFunctionality === 0) {
                return true;
            }

            const checkbox = $(ev.currentTarget).find(".element-detector-input");

            if (checkbox.length > 0 && checkbox.prop("checked") === true) {
                checkbox.prop("checked", false);
                this.unMarkElementAsCheckedInBacked(ev);
            } else if (app.isTablet && $.__swipeHelper.swipeOrientation !== "vertical") {
                const $article = $(ev.currentTarget).closest("article");

                if (this.isItemHasContextMenuOpened($article.get(0))) {
                    return false;
                }

                if (this.isOpened()) {
                    this.hide();
                }

                this.show($article, model);
            }

            return true;
        },

        /**
         * @onItemSwipeRight
         *
         * @ev    {Object} - element event
         * @model {Object} - element model
         *
         * add functionality on swipe right for checkbox
         */
        onItemSwipeRight(ev, model) {
            const shouldAddFunctionality = $(ev.currentTarget).find(".menu-container").length;

            if (shouldAddFunctionality === 0) {
                return true;
            }

            const checkbox = $(ev.currentTarget).find(".element-detector-input");

            if (
                checkbox.length > 0 &&
                checkbox.prop("checked") === false &&
                !this.isItemHasContextMenuOpened(ev.currentTarget)
            ) {
                checkbox.prop("checked", true);
                this.markElementAsCheckedInBacked(ev);
            } else if (this.isItemHasContextMenuOpened(ev.currentTarget)) {
                this.hide();
            }

            return true;
        },

        /**
         * @markElementAsCheckedInBacked
         *
         *  {Object} el - click event
         *  Mark the item as checked in backend to be able
         *  to handle them later where we need them
         */
        markElementAsCheckedInBacked(el) {
            const listingElement = $(".listing");
            const checkedElements = listingElement.attr("checked_elements_list");
            const id = el.currentTarget.getAttribute("data-id");
            const jqCurrentEl = $(el.currentTarget);
            const jqInput = jqCurrentEl.find(".element-detector-input")[0];
            const isChecked = jqInput.checked;

            //eslint-disable-next-line
            if (!checkedElements) {
                let newCheckedElements = [id];

                listingElement.attr("checked_elements_list", newCheckedElements);
            } else {
                let currentRecordsToCheck = checkedElements.split(",");

                if (isChecked === true) {
                    currentRecordsToCheck.push(id);

                    listingElement.attr("checked_elements_list", currentRecordsToCheck);
                }
            }
        },

        /**
         * @unMarkElementAsCheckedInBacked
         *
         *  {Object} el - click event
         *  Unmark the item as unchecked in backend to be able
         *  to handle them later where we need them
         */
        unMarkElementAsCheckedInBacked(el) {
            const listingElement = $(".listing");
            const checkedElements = listingElement.attr("checked_elements_list");
            const id = el.currentTarget.getAttribute("data-id");

            if (checkedElements) {
                let currentRecordsToCheck = checkedElements.split(",");

                let newValues = currentRecordsToCheck.filter(item => item != id);

                listingElement.attr("checked_elements_list", newValues);
            }
        }
    };
})(SUGAR.App);
    }
},
{'requireName': 'src/wsystems/mobile/include/javascript/wMobileApp/addSildeRightListView', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/javascript/wMobileApp/addSildeRightListView';
(function jsExtensionListView(app) {
    const listType = "inner-list";
    const newTemplate =
        SUGAR.mobile.views["add-checkbox-view-on-inner-list"].templates[
            "add-checkbox-view-on-inner-list"
        ];
    const templateContent = Handlebars.compile(newTemplate)();

    SUGAR.mobile.extensions["addSlideRightListView"] = {
        extendsFrom: {
            baseType: listType
        },

        initialize(options) {
            let callParent = this._super("initialize", arguments);

            app.controller.on(
                "mobile-reset-inner-list-checboxes",
                this.resetAllCheckboxes
            );

            return callParent;
        },

        /**
         * @resetAllCheckboxes
         *
         * Reset all the checkboxes
         *
         * using example:
         * app.controller.trigger("mobile-reset-inner-list-checboxes", { reset: true, module: app.controller.layoutManager.getRootLayout().module })
         *
         * @param {Object} options  - params of object - reset - true
         *                                               module - name of the module for checkboxes to be reseted
         */
        resetAllCheckboxes(options) {
            const reset = options.reset;
            const resetModule = options.module;
            const currentModule = app.controller.layoutManager.getRootLayout().module;

            if (reset === true && resetModule === currentModule) {
                const children = this.$el.find(".items").children();

                children.forEach(item => {
                    const jqElement = $(item);
                    const checkbox = jqElement.find(".element-detector-input");
                    const checkboxState = checkbox.prop("checked");

                    if (checkboxState === true) {
                        checkbox.prop("checked", false);
                    }
                });

                this.$el.find(".listing").attr("checked_elements_list", []);
            }
        },

        render() {
            let callParent = this._super("render", arguments);

            this.wrapElementWithCheckbox();

            return callParent;
        },

        onItemAdded() {
            let callParent = this._super("onItemAdded", arguments);

            this.wrapElementWithCheckbox();

            return callParent;
        },

        /**
         * @unMarkElementAsCheckedInBacked
         *
         *  add the checkbox on the item on rendering time
         */
        wrapElementWithCheckbox() {
            const shouldAddFunctionality = this.$el.find(".menu-container").length;

            if (shouldAddFunctionality === 0) {
                return true;
            }

            const articles = this.$el.find("article");
            if (articles && articles.length > 0) {
                articles.forEach(art => {
                    const jqArt = $(art);

                    if (jqArt.find(".element-detector-input").length === 0) {
                        jqArt.prepend(templateContent);
                    }

                    const input = jqArt.find(".element-detector-input");
                    const label = jqArt.find(".element-detector-label");
                    const artId = "input-" + jqArt.attr("data-id");

                    if (input.length > 0 && label.length > 0) {
                        input.attr("id", artId);
                        label.attr("for", artId);
                        label.click(this.setActionOnClickCheckbox.bind(this));
                        input.click(this.setActionOnClickCheckboxSafe);
                    }
                });
            }

            return true;
        },

        setActionOnClickCheckboxSafe(e) {
            e.stopPropagation();
        },
        setActionOnClickCheckbox(e) {
            e.stopPropagation();
            e.preventDefault();

            const parentElement = $(e.currentTarget.parentElement);

            parentElement.find(".element-detector-input").prop("checked", false);

            this.unMarkElementAsCheckedInBacked(parentElement);
        },

        /**
         * @unMarkElementAsCheckedInBacked
         *
         *  {Object} parentElement - parent element of the clicked item
         *  Unmark the item as unchecked in backend to be able
         *  to handle them later where we need them
         */
        unMarkElementAsCheckedInBacked(parentElement) {
            const listingElement = $(".listing");
            const checkedElements = listingElement.attr("checked_elements_list");
            const recordId = parentElement.attr("data-id");

            if (checkedElements) {
                let currentRecordsToCheck = checkedElements.split(",");

                let newValues = currentRecordsToCheck.filter(item => item != recordId);

                listingElement.attr("checked_elements_list", newValues);
            }
        }
    };
})(SUGAR.App);
    }
},
{'requireName': 'src/wsystems/mobile/include/javascript/wMobileApp/addGoToConfigButton', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/javascript/wMobileApp/addGoToConfigButton';
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

    }
},
{'requireName': 'src/wsystems/mobile/include/javascript/wMobileApp/wMobileCustomizationsReloader', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/javascript/wMobileApp/wMobileCustomizationsReloader';
(function jsExtension(app) {
    SUGAR.mobile.extensions["wMobileCustomizationsReloader"] = {
        extendsFrom: {
            baseType: "login",
        },

        render() {
            let _renderResult = this._super("render", arguments);

            if (app.reloadCustomizationsNeeded) {
                app.reloadCustomizationsNeeded = false;
                window.location.reload();
            }

            return _renderResult;
        }
    };
})(SUGAR.App);
    }
},
{'requireName': 'src/wsystems/mobile/include/javascript/wMobileApp/addHeaderViewEvents', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/javascript/wMobileApp/addHeaderViewEvents';
(function jsExtensionListView(app) {
    let headerViews = ["header", "headerEdit"];

    headerViews.forEach(headerViewName => {
        let uniqueViewId = app.utils.generateUUID();

        SUGAR.mobile.extensions["addHeaderViewActionEvents" + uniqueViewId] = {
            extendsFrom: {
                baseType: headerViewName
            },

            _processAction(e, actionName, options) {
                app.controller.trigger("header-view-action", { name: actionName, options });

                return this._super("_processAction", arguments);
            },

            onAfterShow() {
                app.controller.trigger("header-view-attached", { headerView: this });

                return this._super("onAfterShow", arguments);
            }
        };
    });
})(SUGAR.App);
    }
},
{'requireName': 'src/wsystems/mobile/include/require/wMobileApp/wMobileRouteHandler', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/require/wMobileApp/wMobileRouteHandler';
/* eslint-disable require-jsdoc */
class wMobileRouteHandler {
    constructor(wMobileBootLoader) {
        this.wMobileBootLoader = wMobileBootLoader;
        
        this.MOBILE = "Mobile";
        this.VIEW = "View";

        SUGAR.mobile.loadView = this.goToView.bind(this);
    }

    goToView(name, entityParams) {
        let _cleanedEntityParams = entityParams ? entityParams : {};
        let _entityName = this.getEntityName(name);
        let _globalEntityName = this.getGlobalName(name);
        let _viewToLoad = app.mobile.views[_globalEntityName];

        if (!_viewToLoad) {
            _globalEntityName = _entityName;
            _viewToLoad = app.mobile.views[_globalEntityName] || app.nomad.getViewClass(name);
            if (!_viewToLoad) {
                app.alert.show("wMobileApp-view-load-error", {
                    level     : "warning",
                    messages  : "The view: " + name + " cannot be loaded.",
                    autoClose : true
                });
                return false;
            }
        }

        if (!_cleanedEntityParams.skipRegistration) {
            let _currentUrl = app.navigation.manager.getCurrentStep().url;
            this.registerStepInHistory(_currentUrl);
        }

        _cleanedEntityParams["view"] = _viewToLoad;

        let _loadedView = app.controller.loadScreen(_cleanedEntityParams)[0];
        // set cached on false so that the layout gets disposed every time when leaving the screen
        _loadedView.layout.cached = false;

        //notifyButtonsChange
        SUGAR.customizationTools.mobileButtonsManager.handleViewChange();

        return _loadedView;
    }

    registerStepInHistory(url) {
    // this is a function that needs to be called if you navigate to another screen
    // simply call this to store the start page url in history so that you could go back to it
        var historyParams = {
            initiator: {
                name: "GENERIC"
            },
            url: url
        };
        historyParams = _.extend(historyParams, app.navigation.manager._getUrlInfo(historyParams.url));
        historyParams = _.extend({}, historyParams, {
            id             : ++app.navigation.manager._seedId,
            replaceCurrent : false
        });

        const upStepParams = app.navigation.manager._getUpStepParams(historyParams);

        _.extend(historyParams, upStepParams);

        app.navigation.history._previous = app.navigation.history._current;
        app.navigation.history._steps.push(app.navigation.history._current);
        app.navigation.history._current = _.omit(historyParams, "replaceCurrent");
        app.navigation.history._syncBrowserHistory();
    }

    routeRegisterView(globalViewName, templateName) {
        var self = this;

        let _viewRoute = {
            name  : templateName,
            steps : globalViewName,
            handler() {
                self.goToView(globalViewName);
            }
        };

        this.wMobileBootLoader.customizationTools.customization.registerRoutes([_viewRoute]);
    }

    reloadLoginView() {
        let _currentScreen = app.controller.getScreenContext();

        // reload current view
        if (_currentScreen.root === undefined) {
            app.controller.clean({
                disposeAll: true
            });

            app.controller.loadScreen({
                context: new app.Context({
                    module: "Login"
                }).prepare(),
                view: app.nomad.getViewClass("login")
            });
        } else {
            app.controller.navigate("#Search");
        }
    }

    getEntityName(name) {
        return (name.charAt(0).toUpperCase() + name.slice(1)).replace(/-/g, "");
    }

    getGlobalName(name) {
        return this.MOBILE + this.getEntityName(name) + this.VIEW;
    }
}
module.exports.wMobileRouteHandler = wMobileRouteHandler;
    }
},
{'requireName': 'src/wsystems/mobile/include/require/wMobileApp/wMobileViewLoader', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/require/wMobileApp/wMobileViewLoader';
/* eslint-disable require-jsdoc */
let _baseFilePath = "src/wsystems/mobile/include/require/wMobileApp/";
let _baseClassName = "wMobileEntityLoader";
let MobileEntityLoader = window.require(_baseFilePath + _baseClassName)[_baseClassName];

class wMobileViewLoader extends MobileEntityLoader {
    constructor(wMobileBootLoader) {
        super(wMobileBootLoader);

        this.BASE_ENTITY = wMobileBootLoader.customizationTools.nomadView;
        this.ENTITY_TYPE = "View";
    }

    extend(baseType, extensionData) {
        let _baseEntityData = app.nomad._getComponentViewCache()[baseType];
        let _targetModules = [];

        if (_baseEntityData 
            && _baseEntityData.custom.length > 0 
            && (extensionData.extendsFrom.module === undefined || extensionData.extendsFrom.module === "")) {
            _.each(_baseEntityData.custom, function getExtendedModules(moduleData) {
                _targetModules.push(moduleData.filter.module);
            });
        }

        _targetModules.push(extensionData.extendsFrom.module);

        _.each(_targetModules, function applyExtension(moduleName) {
            let _baseClass = app.nomad.getViewClass({
                baseType : baseType,
                module   : moduleName
            });

            if (_baseClass) {
                let _customEntity = app.nomad.extendComponent(_baseClass, extensionData, undefined);

                app.nomad.registerComponent({
                    cmp      : _customEntity,
                    baseType : baseType,
                    module   : moduleName
                });

                extensionData.applied = true;
            } 
        });
    }

    loadBaseEntity(data, name, baseClass, entityName, moduleType, baseType) {
        // extend base type if there is any extension to that entity
        baseClass = this.extendClass(baseType, baseClass);

        var customMobileEntity = app.nomad.extendComponent(baseClass, data.controller, undefined);

        // extend the current view
        customMobileEntity = this.extendClass(name, customMobileEntity);

        app.mobile.views[this.getGlobalName(entityName)] = this.addTemplateToEntity(
            customMobileEntity,
            data,
            name,
            moduleType
        );

        this.wMobileBootLoader.wMobileRouteHandler.routeRegisterView(
            this.getGlobalName(entityName), this.getTemplateName(name)
        );

        this.applyExtensions(name);
        this.wMobileBootLoader.customizationTools.customization.register(app.mobile.views[this.getGlobalName(entityName)], {
            baseType: name
        });
    }

    addTemplateToEntity(mobileEntity, data, name, moduleType) {
        let _templateName = this.getTemplateName(name);

        var baseInitFn = mobileEntity.prototype.initialize;

        mobileEntity = mobileEntity.extend({
            initialize: function (options) {
                if (moduleType !== "") {
                    options.module = moduleType;
                }

                if (!options.module) {
                    options.module = "About";
                }

                let _initResult = baseInitFn.call(this, options);

                if (data.templates[name]) {
                    this.template = Handlebars.templates[_templateName];
                }

                this.loadStyles();

                return _initResult;
            },

            loadStyles: function () {
                _.each(SUGAR.mobile.views[name].styles, function loadStyle(styleCss, styleKey) {
                    if (!app.mobile.styles[styleKey]) {
                        app.mobile.styles[styleKey] = true;
                        $("head").append("<style type='text/css'>" + styleCss + "</style>");
                    }
                });
            }
        });

        if (data.templates[name]) {
            mobileEntity.prototype.template = _templateName;

            if (!Handlebars.templates[_templateName]) {
                Handlebars.templates[_templateName] = Handlebars.compile(data.templates[name]);
            }
        }

        if (!mobileEntity.prototype.headerConfig) {
            mobileEntity.prototype.headerConfig = {};
        }
        _.each(data.controller.headerConfig, function addHeaderConfig(headerOptionValue, headerOptionName) {
            mobileEntity.prototype.headerConfig[headerOptionName] = headerOptionValue;
        });

        return mobileEntity;
    }

    loadExtendedEntity(data, name, entities) {
        let _entities = entities;
        let _globalViewName = this.getGlobalName(name);

        // check if the view exists already
        if (!app.mobile.views[_globalViewName]) {
            let _parentData = data.controller.extendsFrom;
            let _parentType = _parentData.baseType;
            let _moduleType = _parentData.module ? _parentData.module : "";

            // try getting the base class from the sugar framework
            let baseEntityClass = app.nomad.getViewClass({
                baseType : _parentType,
                module   : _moduleType
            });

            // try getting the base class from the sugar sdk
            if (baseEntityClass === undefined) {
                baseEntityClass = SUGAR.mobile.getView(_parentType);
            }

            // try getting the base class from our custom classes
            if (baseEntityClass === undefined) {
                let _parentEntityName = this.getEntityName(_parentType);
                let _parentTypeName = this.getGlobalName(_parentEntityName);

                baseEntityClass = app.mobile.views[_parentTypeName];

                // try getting the base class from our custom classes that have not been created yet
                if (baseEntityClass === undefined && _entities[_parentEntityName]) {
                    this.loadExtendedEntity(_entities[_parentEntityName].data, _parentType, _entities);

                    baseEntityClass = app.mobile.views[_parentTypeName];
                }

                if (data.templates[name] === undefined && _.isObject(SUGAR.mobile.views[_parentType]) === true) {
                    data.templates[name] = SUGAR.mobile.views[_parentType].templates[_parentType];
                }
            }

            if (baseEntityClass) {
                this.loadBaseEntity(data, name, baseEntityClass, this.getEntityName(name), _moduleType, _parentType);
            }
        }
    }

    extendClass(baseType, baseClass) {
        _.each(SUGAR.mobile.extensions, function goThroughExtensions(extensionData) {
            if (extensionData.extendsFrom.baseType === baseType && !extensionData.applied) {
                var customMobileEntity = app.nomad.extendComponent(baseClass, extensionData, undefined);

                app.nomad.registerComponent({
                    cmp      : customMobileEntity,
                    baseType : baseType
                });

                baseClass = customMobileEntity;
                extensionData.applied = true;
            }
        });

        return baseClass;
    }
}
module.exports.wMobileViewLoader = wMobileViewLoader;
    }
},
{'requireName': 'src/wsystems/mobile/include/require/wMobileApp/wMobileEntityLoader', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/require/wMobileApp/wMobileEntityLoader';
/* eslint-disable require-jsdoc */
class wMobileEntityLoader {
    constructor(wMobileBootLoader) {
        this.wMobileBootLoader = wMobileBootLoader;

        this.ENTITY_TYPE = "Entity";
        this.MOBILE = "Mobile";
    }
    
    extend() {}

    load(entities) {
        var _extendedEntities = {};

        _.each(
            entities,
            function handleEntity(data, name) {
                let _entityName = this.getEntityName(name);
                
                let _complexEntity = this.loadEntity(name, data, _entityName);

                if (_complexEntity) {
                    _extendedEntities[_entityName] = _complexEntity;
                }
            },
            this
        );

        this.loadExtendedEntities(_extendedEntities);
    }

    loadEntity(name, data, entityName) {
        if (this.extendsBaseEntity(data)) {
            return {
                data : data,
                name : name
            };
        } else {
            this.loadBaseEntity(
                data,
                name,
                this.BASE_ENTITY,
                entityName,
            );
        }

        return false;
    }

    loadBaseEntity() {}

    loadExtendedEntities(entities) {
        let _entities = entities;

        _.each(
            entities,
            function handleEntity(data, name) {
                this.loadExtendedEntity(data.data, data.name, _entities);
            },
            this
        );
    }

    loadExtendedEntity() {}

    applyExtensions(name) {
        _.each(SUGAR.mobile.extensions, function getExtensionData(extensionData){
            if (extensionData.extendsFrom.baseType === name) {
                this.extend(name, extensionData);
            }
        }, this);
    }

    extendsBaseEntity(data) {
        return typeof data.controller.extendsFrom === "object";
    }

    getEntityName(name) {
        return (name.charAt(0).toUpperCase() + name.slice(1)).replace(/-/g, "");
    }

    getGlobalName(name) {
        return this.MOBILE + this.getEntityName(name) + this.ENTITY_TYPE;
    }

    getTemplateName(name) {
        return this.MOBILE.charAt(0).toLowerCase() + this.MOBILE.slice(1) + "-" + this.getEntityName(name) + "-" + this.ENTITY_TYPE.charAt(0).toLowerCase() + this.ENTITY_TYPE.slice(1);
    }
}
module.exports.wMobileEntityLoader = wMobileEntityLoader;
    }
},
{'requireName': 'src/wsystems/mobile/include/require/wMobileApp/wMobileFieldLoader', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/require/wMobileApp/wMobileFieldLoader';
/* eslint-disable require-jsdoc */
let _baseFilePath = "src/wsystems/mobile/include/require/wMobileApp/";
let _baseClassName = "wMobileEntityLoader";
let wMobileEntityLoader = window.require(_baseFilePath + _baseClassName)[_baseClassName];

class wMobileFieldLoader extends wMobileEntityLoader {
    constructor(wMobileBootLoader) {
        super(wMobileBootLoader);

        this.BASE_ENTITY = app.view.NomadField;
        this.ENTITY_TYPE = "Field";
    }

    extend(baseType, extensionData) {
        let _baseEntity = app.nomad.getFieldClass({
            baseType: baseType
        });

        let _customEntity = app.nomad.extendComponent(_baseEntity, extensionData, undefined);

        app.nomad.registerComponent({
            cmp      : _customEntity,
            baseType : baseType
        });
    }

    loadBaseEntity(data, name, baseEntity) {
        let _customField = this.wMobileBootLoader.customizationTools.customization.extend(baseEntity, data.controller);

        this.wMobileBootLoader.customizationTools.customization.register(_customField, {
            metadataType: name
        });

        this.registerEntityTemplates(data.templates, name);
        this.applyExtensions(name);

        app.mobile.fields[this.getGlobalName(name)] = app.nomad.getFieldClass({
            baseType: name
        });
    }

    registerEntityTemplates(templates, name) {
        _.each(templates, function registerTemplate(templateData, templateName) {
            Handlebars.templates["f." + name + "." + templateName] = Handlebars.compile(templateData);
        });
    }

    loadExtendedEntity(data, name) {
        let _parentData = data.controller.extendsFrom;
        let _parentType = _parentData.baseType;
        let _moduleType = _parentData.module ? _parentData.module : "";

        let _baseFieldClass = app.nomad.getFieldClass({
            baseType            : _parentType,
            module              : _moduleType,
            shouldReturnDefault : true
        });

        if (_baseFieldClass) {
            this.loadBaseEntity(data, name, _baseFieldClass);
        }
    }
}
module.exports.wMobileFieldLoader = wMobileFieldLoader;
    }
},
{'requireName': 'src/wsystems/mobile/include/require/wMobileApp/wMobileDashletLoader', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/include/require/wMobileApp/wMobileDashletLoader';
/* eslint-disable require-jsdoc */
let _baseFilePath = "src/wsystems/mobile/include/require/wMobileApp/";
let _baseClassName = "wMobileEntityLoader";
let wMobileEntityLoader = window.require(_baseFilePath + _baseClassName)[_baseClassName];

class wMobileDashletLoader extends wMobileEntityLoader {
    constructor(wMobileBootLoader) {
        super(wMobileBootLoader);

        this.BASE_ENTITY = SUGAR.mobile.getDashlet("base-dashlet");
        this.ENTITY_TYPE = "Dashlet";
    }

    extend(baseType, extensionData) {
        let _baseEntity = SUGAR.mobile.getDashlet(baseType);

        Object.assign(_baseEntity.prototype, extensionData);
    }

    loadBaseEntity(data, name, baseEntity) {
        let _entityName = this.getEntityName(name);
        let _globalName = this.getGlobalName(_entityName);

        let _customEntity = this.wMobileBootLoader.customizationTools.customization.extend(baseEntity, data.controller);

        _customEntity = this.addTemplateToEntity(_customEntity, data, name);

        this.wMobileBootLoader.customizationTools.customization.register(_customEntity, {
            metadataType: name
        });

        if (data.controller.icon) {
            app.config.ui.icons.dashlets[name] = data.controller.icon;
        }

        this.applyExtensions(name);
        app.mobile.dashlets[_globalName] = SUGAR.mobile.getDashlet(name);
    }

    addTemplateToEntity(customEntity, data, name) {
        let _templateName = this.getTemplateName(name);
        let _customEntity = customEntity;

        _customEntity = this.wMobileBootLoader.customizationTools.customization.extend(_customEntity, {
            initialize: function (options) {
                options.module = "About";

                var initResult = this._super("initialize", arguments);

                if (data.templates[name]) {
                    this.template = Handlebars.templates[_templateName];
                }

                this.loadStyles();

                return initResult;
            },

            loadStyles: function () {
                _.each(SUGAR.mobile.dashlets[name].styles, function loadStyle(styleCss, styleKey) {
                    if (!app.mobile.styles[styleKey]) {
                        app.mobile.styles[styleKey] = true;
                        $("head").append("<style type='text/css'>" + styleCss + "</style>");
                    }
                });
            }
        });

        if (data.templates[name] && !Handlebars.templates[_templateName]) {
            Handlebars.templates[_templateName] = Handlebars.compile(data.templates[name]);
        } 

        return _customEntity;
    }
    
    loadExtendedEntity(data, name) {
        let _parentData = data.controller.extendsFrom;
        let _parentType = _parentData.baseType;

        let _baseEntity = SUGAR.mobile.getDashlet(_parentType);

        if (_baseEntity) {
            this.loadBaseEntity(data, name, _baseEntity);
        }
    }
}
module.exports.wMobileDashletLoader = wMobileDashletLoader;
    }
},
{'requireName': 'src/wsystems/mobile/widgets/mobileMasterButton/mobileMasterButton', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/widgets/mobileMasterButton/mobileMasterButton';
/*eslint-disable*/
class MobileMasterButton {
    constructor(masterButtonConfig, id, manager) {
        this.manager = manager;
        this.id = id;
        this.config = masterButtonConfig;
        this.html = SUGAR.mobile.widgets.mobileMasterButton.templates.mobileMasterButton;

        this.buttons = {};
        this.buttonsConfig = {};
        this.buttonHeight = 3.2;
        this.buttonDelay = 0.0;
        this.initialHeight = 1.5;

        this.createMasterButton();
        this.createNewButtons();
    }

    createMasterButton() {
        this.manager.container.append(this.html);

        $(".masterButtonInputPlaceHolder")
            .addClass("masterButtonInput" + this.id)
            .removeClass("masterButtonInputPlaceHolder");
        $(".masterButtonLabelPlaceHolder")
            .addClass("masterButtonLabel" + this.id)
            .removeClass("masterButtonLabelPlaceHolder");
        $(".masterButtonIconPlaceHolder")
            .addClass("masterButtonIcon" + this.id)
            .removeClass("masterButtonIconPlaceHolder");

        this.masterButton = $(".masterButtonInput" + this.id);
        this.masterButtonLabel = $(".masterButtonLabel" + this.id);
        this.masterButtonIcon = $(".masterButtonIcon" + this.id);

        this.masterButtonIcon.addClass(this.config.icon);
        this.masterButtonIcon.css("color", this.config.color);
        this.masterButtonLabel.css("background-color", this.config.backgroundColor);

        if (this.config.isMainButton) {
            this.masterButtonLabel.empty();
            this.masterButtonLabel.append(SUGAR.mobile.widgets.mobileMasterButton.templates.wSystemsLogo);
            this.masterButtonIcon = $(".masterButtonIconLogo");

            if (SUGAR.rebrandedLogo) {
                $(".masterButtonIconLogo").attr("src", SUGAR.rebrandedLogo);

            }

            if (SUGAR.rebrandedLogoSize) {
                $(".masterButtonIconLogo").css("width", SUGAR.rebrandedLogoSize);
            }

            if (SUGAR.rebrandedLogoMarginRight) {
                $(".masterButtonIconLogo").css("margin-right", SUGAR.rebrandedLogoMarginLeft);
            }

            if (SUGAR.rebrandedLogoMarginLeft) {
                $(".masterButtonIconLogo").css("margin-left", SUGAR.rebrandedLogoMarginLeft);
            }

            if (SUGAR.rebrandedLogoBackground) {
                $("#masterButtonLabel").css("background-color", SUGAR.rebrandedLogoBackground);
            }
        }

        var newIconWidth = this.masterButtonIcon.width();
        var newIconHeight = this.masterButtonIcon.height();

        if (newIconHeight === 0) {
            newIconHeight = newIconWidth;
        }

        this.masterButtonIcon.css("margin-left", this.masterButtonLabel.width() / 2 - newIconWidth / 2 + "px");
        this.masterButtonIcon.css("margin-top", this.masterButtonLabel.height() / 2 - newIconHeight / 2 + "px");

        this.masterButtonIcon.on("click", function triggerChange() {
            var nextCheckedValue = !this.masterButton.prop('checked');
            this.masterButton.prop('checked', nextCheckedValue);

            this.showPressedFeedback();
            if (!nextCheckedValue) {
                if (this.config.isMainButton) {
                    this.manager.hideOverlay();
                } else {
                    this.hideWidget();

                    this.config.mainButton.showWidget();
                }
            }

            this.notifyButtons(nextCheckedValue);
        }.bind(this));

        this.dragItem = document.querySelector("#mobileButtonsContainer");
        this.dragItemLabel = document.querySelector("#masterButtonLabel");
        this.dragItemIcon = document.querySelector("#masterButtonIcon");
        this.active = false;
    }

    createNewButtons() {
        _.each(this.config.children, this.createButton, this);
    }

    createButton(buttonConfig, buttonId) {
        var buttonsNumber = 1;
        _.each(this.buttons, function getButtonsNumber(button) {
            if (button.config.horizontalButton === buttonConfig.horizontalButton) {
                buttonsNumber = buttonsNumber + 1;
            }
        });

        var currentButtonConfig = _.clone(buttonConfig);

        if (!isNaN(buttonId)) {
            buttonId = app.utils.generateUUID();
        }

        currentButtonConfig.transform = this.initialHeight + buttonsNumber * this.buttonHeight;
        currentButtonConfig.delay = buttonsNumber * this.buttonDelay;
        currentButtonConfig.manager = this;

        var button = new SUGAR.mobile.widgets.mobileButton.controller(
            currentButtonConfig,
            this.manager.container,
            buttonId,
            buttonsNumber
        );
        this.buttons[buttonId] = button;
    }

    setEnabledHorizontalButtonsData(horizontalButtonsData) {
        if (horizontalButtonsData && horizontalButtonsData.length > 0) {
            _.each(this.buttons, function setNewData(buttonData) {
                if (buttonData.config.data && buttonData.config.data.module) {
                    var buttonStateModified = false;

                    _.each(horizontalButtonsData, function getCorrectModule(moduleData) {
                        if (moduleData.module === buttonData.config.data.module) {
                            buttonData.checked = true;
                            buttonStateModified = true;
                        }
                    });

                    if (!buttonStateModified) {
                        buttonData.checked = false;
                    }
                }
            });
        }
    }

    getEnabledHorizontalButtonsData() {
        var enabledHorizontalButtons = [];

        _.each(this.buttons, function getButtons(button) {
            if (button.config.horizontalButton && button.checked) {
                enabledHorizontalButtons.push(button.config.data);
            }
        });

        return enabledHorizontalButtons;
    }

    enableHorizontalButtons() {
        _.each(this.buttons, function getButtons(button) {
            if (button.config.horizontalButton) {
                button.checked = true;
            }
        });
    }

    disableHorizontalButtons() {
        _.each(this.buttons, function getButtons(button) {
            if (button.config.horizontalButton && button.checked) {
                button.checked = false;
            }
        });
    }

    createNewMasterButton(buttonConfig) {
        if (this.currentButtonConfig) {
            var currentButtonConfig = _.clone(this.currentButtonConfig);

            currentButtonConfig.children = buttonConfig;
            currentButtonConfig.mainButton = this;

            var masterId = app.utils.generateUUID();
            var newMasterButton = this.manager.createMasterButton(currentButtonConfig, masterId);

            currentButtonConfig.masterButton = newMasterButton;
            this.currentButtonConfig.masterButton = newMasterButton;

            this.hideWidget(true);
            newMasterButton.showWidget();
        }
    }

    getFinalPosition(buttonEntity) {
        var buttonsNumber = 1;
        var buttonFound = false;

        _.each(this.buttons, function getButtonsNumber(button, buttonId) {
            if (buttonId === buttonEntity.buttonId) {
                buttonFound = true;
            } else if (
                !buttonFound &&
                button.config.horizontalButton === buttonEntity.config.horizontalButton &&
                button.canShow()
            ) {
                buttonsNumber = buttonsNumber + 1;
            }
        });

        return {
            transform: this.initialHeight + buttonsNumber * this.buttonHeight,
            delay: buttonsNumber * this.buttonDelay
        };
    }

    showLoadingScreen(loadingScreenSettings) {
        this.manager.handleLoadingScreen(loadingScreenSettings);
    }

    showPressedFeedback() {
        this.manager.mobileButtonsOverlay.show();
        var transitionSpeed = 150;
        var targetOpacity = 0.8;

        this.manager.container.animate({
                opacity: targetOpacity
            },
            transitionSpeed,
            function wiggle() {
                this.manager.container.animate({
                        opacity: 1
                    },
                    transitionSpeed
                );
            }.bind(this)
        );
    }

    notifyButtons(checked) {
        _.each(this.buttons, function destroyMasterButton(button) {
            button.masterButtonPressed(checked);
        });
    }

    closeWidget(keepOverlay) {
        this.masterButton.prop("checked", false);

        if (!keepOverlay) {
            this.manager.mobileButtonsOverlay.hide();
        }

        this.notifyButtons(false);
    }

    hideWidget(keepOverlay) {
        this.masterButton.attr("disabled", true);
        this.masterButtonLabel.hide();
        this.closeWidget(keepOverlay);

        _.each(this.buttons, function hideAllButtons(button) {
            button.hide();
        });
    }

    showWidget() {
        this.masterButton.removeAttr("disabled");
        this.masterButtonLabel.show();
        this.manager.container.prepend(this.masterButtonLabel);
        this.manager.container.prepend(this.masterButton);
        this.masterButton.prop("checked", true);

        _.each(this.buttons, function destroyMasterButton(button) {
            button.show();
        });
    }

    goToMainWidget() {
        this.manager.goToMainWidget();
    }

    destroy() {
        _.each(this.buttons, function destroyMasterButton(button) {
            button.destroy();
        });
    }
}
    }
},
{'requireName': 'src/wsystems/mobile/widgets/mobileButtonsManager/mobileButtonsManager', 'functionName': function(module, require) {
    module.name = 'src/wsystems/mobile/widgets/mobileButtonsManager/mobileButtonsManager';
/*eslint-disable*/
class MobileButtonsManager {
    constructor(containerHtml, masterButtonHtml) {
        this.masterButtons = {};
        this.masterButtonsConfig = {};

        this.createContainer(containerHtml);
        this.initialize();
    }

    initialize() {
        app.on("app:orientation:changed", this.handleDeviceOrientationChanged.bind(this));
        if (!app.controller.navigationExtended) {
            app.controller.navigationExtended = true;
            var navFunction = app.controller.navigate;
            var buttonsManager = this;

            app.controller.navigate = function (url, options) {
                navFunction.call(app.controller, url, options);

                buttonsManager.handleViewChange();
            };
        }

        document.getElementById("nomad").appendChild(document.getElementById("customizationsLoadingScreen"));
    }

    createContainer(containerHtml) {
        $("#nomad").append(containerHtml);
        this.container = $("#mobileButtonsContainer");
        this.mobileButtonsOverlay = $("#mobileButtonsOverlay");
        this.mobileButtonsLoadingScreen = $("#customizationsLoadingScreen");
        this.loadingScreenLabel = $("#customizationsLoadingScreenLabel");
        this.mobileButtonsOverlay.on("click", this.closeMasterButtons.bind(this));
        this.mobileButtonsOverlay.on("touchmove", this.closeMasterButtons.bind(this));

        this.initContainerPosition();
    }

    getInitialContainerPosition() {
        var containerSize = 100;
        var containerXPos = window.innerWidth - containerSize;
        var containerYPos = window.innerHeight - containerSize;

        var initialContainerPosition = "translate3d(" + containerXPos + "px, " + containerYPos + "px, 0px)";

        return initialContainerPosition;
    }

    initContainerPosition() {
        this.container.css("transform", this.getInitialContainerPosition());
    }

    closeMasterButtons() {
        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                masterButton.closeWidget();
            }.bind(this)
        );
        this.hideOverlay();
    }

    hideOverlay() {
        this.mobileButtonsOverlay.hide();
    }

    dragStart(e) {
        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                if (e.target === masterButton.dragItemLabel || e.target.id === masterButton.dragItemIcon.id) {
                    this.active = true;
                }
            }.bind(this)
        );
    }

    dragEnd(e) {
        var transitionActivated = false;

        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                var container = masterButton.manager.container;
                var containerPosition = container.position();
                var masterButtonPosition = masterButton.masterButtonLabel.position();
                if (
                    !transitionActivated &&
                    container &&
                    this.active &&
                    (containerPosition.left + masterButtonPosition.left < 0 ||
                        containerPosition.left + masterButtonPosition.left + masterButton.masterButtonLabel.width() >
                        window.innerWidth ||
                        containerPosition.top + masterButtonPosition.top < 0 ||
                        containerPosition.top + masterButtonPosition.top + masterButton.masterButtonLabel.height() >
                        window.innerHeight)
                ) {
                    transitionActivated = true;
                    var transitionSpeed = 100;
                    var containerSize = 100;
                    var wiggleWidth = 20;
                    var containerXPos = window.innerWidth - containerSize;
                    var containerYPos = window.innerHeight - containerSize;

                    container.animate({
                            transform: "translate3d(" + containerXPos + "px, " + containerYPos + "px, 0px)"
                        },
                        transitionSpeed,
                        function wiggle() {
                            container.animate({
                                    transform: "translate3d(" +
                                        (containerXPos - wiggleWidth) +
                                        "px, " +
                                        containerYPos +
                                        "px, 0px)"
                                },
                                transitionSpeed,
                                function wiggleBack() {
                                    container.animate({
                                            transform: "translate3d(" + containerXPos + "px, " + containerYPos + "px, 0px)"
                                        },
                                        transitionSpeed
                                    );
                                }
                            );
                        }
                    );
                }
            }.bind(this)
        );

        this.active = false;
    }

    drag(e) {
        if (this.active) {
            e.preventDefault();
            var currentX = 0;
            var currentY = 0;

            if (e.type === "touchmove") {
                currentX = e.touches[0].clientX;
                currentY = e.touches[0].clientY;
            } else {
                currentX = e.clientX;
                currentY = e.clientY;
            }

            _.each(
                this.masterButtons,
                function goThroughMasterButtons(masterButton) {
                    if (masterButton.masterButton.attr("checked")) {
                        masterButton.masterButton.prop("checked", false);
                        masterButton.notifyButtons(false);
                    }
                }.bind(this)
            );

            this.setTranslate(currentX, currentY);
        }
    }

    setTranslate(xPos, yPos) {
        var buttonRadius = 50;

        xPos = xPos - buttonRadius;
        yPos = yPos - buttonRadius;
        this.container.css("transform", "translate3d(" + xPos + "px, " + yPos + "px, 0)");
    }

    setEnabledHorizontalButtonsData(data) {
        return this.masterButtons.mainButton.setEnabledHorizontalButtonsData(data);
    }

    getEnabledHorizontalButtonsData() {
        return this.masterButtons.mainButton.getEnabledHorizontalButtonsData();
    }

    enableHorizontalButtons() {
        return this.masterButtons.mainButton.enableHorizontalButtons();
    }

    disableHorizontalButtons() {
        return this.masterButtons.mainButton.disableHorizontalButtons();
    }

    registerMobileButtons(newButtons) {
        _.each(
            newButtons,
            function registerButtons(buttonConfig) {
                this.masterButtonsConfig[app.utils.generateUUID()] = buttonConfig;
            },
            this
        );
    }

    createMasterButtons() {
        if (Object.keys(this.masterButtonsConfig).length > 0) {
            $("#mobileButtonsContainer").show();
            this.initContainerPosition();
            var mainButtonId = "mainButton";
            var mainButtonConfig = {
                isMainButton: true,
                masterButton: true,
                name: "d",
                label: "Forth Button",
                icon: "fab fa-wikipedia-w",
                color: "white",
                backgroundColor: "rgb(0,66,121)",
                children: this.masterButtonsConfig
            };

            this.createMasterButton(mainButtonConfig, mainButtonId, true);
            this.wrapperContainer = document.querySelector("#nomad");

            this.wrapperContainer.addEventListener("touchstart", this.dragStart.bind(this), false);
            this.wrapperContainer.addEventListener("touchend", this.dragEnd.bind(this), false);
            this.wrapperContainer.addEventListener("touchmove", this.drag.bind(this), false);

            this.wrapperContainer.addEventListener("mousedown", this.dragStart.bind(this), false);
            this.wrapperContainer.addEventListener("mouseup", this.dragEnd.bind(this), false);
            this.wrapperContainer.addEventListener("mousemove", this.drag.bind(this), false);
        } else {
            $("#mobileButtonsContainer").hide();
        }
    }

    createMasterButton(masterButtonConfig, buttonId, mainButton) {
        this.masterButtons[buttonId] = new SUGAR.mobile.widgets.mobileMasterButton.controller(
            masterButtonConfig,
            buttonId,
            this
        );

        return this.masterButtons[buttonId];
    }

    goToMainWidget() {
        _.each(
            this.masterButtons,
            function goThroughMasterButtons(masterButton) {
                masterButton.hideWidget();
            }.bind(this)
        );

        if (this.masterButtons.mainButton) {
            this.masterButtons.mainButton.showWidget();
            this.masterButtons.mainButton.closeWidget();
        }
    }

    destroyExistingButtons() {
        this.container.empty();
        this.masterButtonsConfig = {};
        _.each(this.masterButtons, function destroyMasterButton(masterButton) {
            masterButton.destroy();
        });
        delete this.masterButtons;
        this.masterButtons = {};
    }

    cleanButtons() {
        var duplicatedIds = [];
        _.each(
            this.buttonsConfig,
            function getDuplicatedButtons(buttonConfig, buttonId) {
                _.each(
                    this.buttonsConfig,
                    function checkDuplicatedButtons(dupeButtonConfig, dupeButtonId) {
                        if (
                            dupeButtonConfig.name == buttonConfig.name &&
                            dupeButtonConfig.icon == buttonConfig.icon &&
                            dupeButtonConfig.color == buttonConfig.color &&
                            dupeButtonConfig.backgroundColor == buttonConfig.backgroundColor &&
                            dupeButtonConfig.label == buttonConfig.label &&
                            buttonId !== dupeButtonId &&
                            duplicatedIds.indexOf(dupeButtonId) < 0 &&
                            duplicatedIds.indexOf(buttonId) < 0
                        ) {
                            duplicatedIds.push(dupeButtonId);
                        }
                    },
                    this
                );
            },
            this
        );

        for (var idIndex = 0; idIndex < duplicatedIds.length; idIndex++) {
            delete this.buttonsConfig[duplicatedIds[idIndex]];
        }
    }

    hideLoadingScreen(hideTimer) {
        if (hideTimer) {
            setTimeout(
                function hideLoadingScreenWidget() {
                    this.mobileButtonsLoadingScreen.css("display", "none");

                    if (app.rebrandingManager) {
                        app.rebrandingManager.handleLoadingScreen(false);
                    }
                }.bind(this),
                hideTimer
            );
        } else {
            this.mobileButtonsLoadingScreen.css("display", "none");

            if (app.rebrandingManager) {
                app.rebrandingManager.handleLoadingScreen(false);
            }
        }
    }

    handleLoadingScreen(loadingScreenSettings) {
        var loadingScreenMessage = loadingScreenSettings.message ? loadingScreenSettings.message : "Loading ...";
        this.loadingScreenLabel.text(loadingScreenMessage);

        var loadingScreenOpacity = loadingScreenSettings.opacity ? loadingScreenSettings.opacity : 0.85;
        this.mobileButtonsLoadingScreen.css("opacity", loadingScreenOpacity);

        this.showLoadingScreen();

        if (loadingScreenSettings.autoHide) {
            setTimeout(
                function hideLoadingScreenWidget() {
                    this.hideLoadingScreen();
                }.bind(this),
                loadingScreenSettings.hideTimer
            );
        }
    }

    showLoadingScreen() {
        if (app.rebrandingManager) {
            app.rebrandingManager.handleLoadingScreen(true);
        }
        this.mobileButtonsLoadingScreen.css("display", "flex");
    }

    handleDeviceOrientationChanged() {
        this.initContainerPosition();
    }

    handleViewChange() {
        this.destroyExistingButtons();
        app.controller.trigger("mobile-context-changed", this);
        this.cleanButtons();
        this.createMasterButtons();

        if (app.rebrandingManager) {
            app.rebrandingManager.handleViewChange(App.controller.getScreenContext());
        }
    }
}
    }
},
{'requireName': 'custom/clients/mobile/views/user-profile/user-profile', 'functionName': function(module, require) {
    module.name = 'custom/clients/mobile/views/user-profile/user-profile';
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

    }
},
{'requireName': 'custom/clients/mobile/views/user-profiles/user-profiles', 'functionName': function(module, require) {
    module.name = 'custom/clients/mobile/views/user-profiles/user-profiles';
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

    }
},]
);
    SUGAR.customizationTools.mobileButtonsManager.handleViewChange();
    SUGAR.customizationTools.wMobileBootLoader.loadManagers();
    SUGAR.customizationTools.wMobileBootLoader.applyExtensions(SUGAR.mobile.extensions);
    SUGAR.customizationTools.wMobileBootLoader.loadMobileCustomizations();
    SUGAR.customizationTools.wMobileBootLoader.wMobileRouteHandler.reloadLoginView();
    SUGAR.customizationTools.wMapsFilteringDistancesList = [];