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