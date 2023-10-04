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