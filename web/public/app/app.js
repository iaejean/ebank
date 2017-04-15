/*global require, angular, environment, locale, PROD */

var dependencies = [
    "app/common",
    "app/common/logger",
    "app/controllers/headerController",
    "app/controllers/footerController",
    "moment",
    "i18n!app/nls/common"
];

require(dependencies, function (angularAMD, Logger, HeaderController, FooterController, moment, i18n) {
    "use strict";

    var logger;
    var app;

    // Loading plugins
    app = angular.module("app", [
        "ui.router",
        "ngResource",
        "ui.bootstrap",
        "ngAnimate",
        "ngSanitize",
        "angular-loading-bar",
        "ui.grid",
        "ui.grid.edit",
        "ui.grid.selection"
    ]);

    // Const
    app.constant("appConfig", {
        "ENV": environment,
        "LOCALE": locale,
        "LOCALES": ["es", "en"],
        "URL_BASE": "../public/app/",
        "URL_BASE_API_V1": "../api/v1/"
    });

    // Setup app
    app.config([
        "$stateProvider",
        "$urlRouterProvider",
        "cfpLoadingBarProvider",
        "$httpProvider",
        "$logProvider",
        "appConfig",
        function (
            $stateProvider,
            $urlRouterProvider,
            cfpLoadingBarProvider,
            $httpProvider,
            $logProvider,
            appConfig
        ) {
            // Setup moment locale
            moment.locale(appConfig.LOCALE);

            // Setup $logProvider
            $logProvider.debugEnabled(appConfig.ENV !== PROD);
            Logger.Logger.setLogger(angular.injector(["ng"]).get("$log"));
            logger = Logger.Logger.getLogger("App");
            logger.info("Starting APP");

            // Setup $httpProvider
            $httpProvider.defaults.timeout = 10000;
            $httpProvider.interceptors.push(function ($injector) {
                return {
                    responseError: function (response) {
                        logger.error("status: " + response.status + ", statusText: " + response.statusText);

                        var $modalInstance;
                        var $modal = $injector.get("$uibModal");

                        $modalInstance = $modal.open({
                            animation: true,
                            templateUrl: appConfig.URL_BASE + "views/modal.html",
                            controller: function ($scope) {
                                $scope.i18n = i18n;
                                $scope.message = response.statusText;
                                $scope.code = response.status;
                                $scope.time = moment().format("LLLL");
                                $scope.details = response.details;
                                $scope.showDetail = false;

                                $scope.ok = function (event) {
                                    $modalInstance.close(event);
                                };

                                $scope.toggleDetail = function () {
                                    $scope.showDetail = !$scope.showDetail;
                                };
                            }
                        });
                        return response;
                    }
                };
            });

            // Setup Router
            $stateProvider.state("home", angularAMD.route({
                url: "/home",
                templateUrl: appConfig.URL_BASE + "views/home.html",
                controller: "homeController",
                controllerUrl: "app/controllers/homeController"
            })).state("user", angularAMD.route({
                url: "/user",
                templateUrl: appConfig.URL_BASE + "views/user.html",
                controller: "userController",
                controllerUrl: "app/controllers/userController"
            })).state("executive", angularAMD.route({
                url: "/executive",
                templateUrl: appConfig.URL_BASE + "views/executive.html",
                controller: "executiveController",
                controllerUrl: "app/controllers/executiveController"
            })).state("cashier", angularAMD.route({
                url: "/cashier",
                templateUrl: appConfig.URL_BASE + "views/cashier.html",
                controller: "cashierController",
                controllerUrl: "app/controllers/cashierController"
            }));

            $urlRouterProvider.otherwise("home");
        }
    ]);
    return angularAMD.bootstrap(app);
});
