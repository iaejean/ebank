define(["require", "exports", "i18n!app/nls/header", "angularAMD", "../common/logger", "css!app/css/menu"], function (require, exports, i18n, angularAMD, logger_1) {
    "use strict";
    var HeaderController = (function () {
        function HeaderController($scope, appConfig, $http) {
            this.self = this;
            this.logger = logger_1.Logger.getLogger("HeaderController");
            this.logger.info("Starting Controller");
            this.$http = $http;
            this.$scope = $scope;
            $scope.self = this;
            $scope.i18n = { menu: HeaderController.i18n };
            $scope.languages = appConfig.LOCALES;
            $scope.locale = appConfig.LOCALE;
            $scope.changeLocale = HeaderController.changeLocale;
        }
        HeaderController.changeLocale = function (locale) {
            location.pathname = "/" + locale + "/";
        };
        return HeaderController;
    }());
    exports.HeaderController = HeaderController;
    HeaderController.i18n = i18n;
    angularAMD.controller("headerController", ["$scope", "appConfig", "$http", HeaderController]);
});
//# sourceMappingURL=headerController.js.map