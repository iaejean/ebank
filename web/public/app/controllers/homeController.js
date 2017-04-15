define(["require", "exports", "angularAMD", "i18n!app/nls/home", "../common/logger"], function (require, exports, angularAMD, messages, logger_1) {
    "use strict";
    var Controller;
    (function (Controller) {
        var HomeController = (function () {
            function HomeController($scope, appConfig) {
                this.self = this;
                this.logger = logger_1.Logger.getLogger("HomeController");
                this.logger.info("Starting Controller");
                this.$scope = $scope;
                this.appConfig = appConfig;
                $scope.myInterval = 5000;
                $scope.noWrapSlides = false;
                $scope.active = 0;
                $scope.slides = [];
                HomeController.getSlides($scope, appConfig);
            }
            HomeController.getSlides = function ($scope, appConfig) {
                var images = ["carrousel_1.jpg", "carrousel_2.jpg"];
                for (var index in images) {
                    $scope.slides.push({
                        id: parseInt(index),
                        text: Controller.HomeController.messages.slide[index],
                        image: appConfig.URL_BASE + "/images/" + images[index]
                    });
                }
            };
            return HomeController;
        }());
        Controller.HomeController = HomeController;
        Controller.HomeController.messages = messages;
        angularAMD.controller("homeController", ["$scope", "appConfig", Controller.HomeController]);
    })(Controller = exports.Controller || (exports.Controller = {}));
});
//# sourceMappingURL=homeController.js.map