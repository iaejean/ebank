define(["require", "exports", "i18n!app/nls/executive", "angularAMD", "../common/logger", "../common/patterns", "../services/cardholderService", "../models/cardholder", "css!app/css/common"], function (require, exports, i18n, angularAMD, logger_1, patterns_1, cardholderService_1, cardholder_1) {
    "use strict";
    var CardholderController = (function () {
        function CardholderController($scope, appConfig, $http, parentScope) {
            this.self = this;
            this.logger = logger_1.Logger.getLogger("CardholderController");
            this.logger.info("Starting Controller");
            this.$http = $http;
            this.$scope = $scope;
            $scope.cardholder = new cardholder_1.Cardholder();
            $scope.self = this;
            $scope.i18n = CardholderController.i18n;
            $scope.formValid = false;
            $scope.cardholder = {};
            $scope.patterns = patterns_1.Patterns;
            $scope.i18n = i18n;
            $scope.cancel = function (event) {
                parentScope.modalAddCardholder.close(event);
            };
            $scope.dateOptions = {
                formatYear: "yyyy",
                maxDate: new Date(),
                minDate: new Date(1970),
                startingDay: 1
            };
            $scope.open = function () {
                $scope.popup.opened = true;
            };
            $scope.popup = {
                opened: false
            };
            $scope.validateForm = function () {
                $scope.formValid = true;
                return $scope.addCardholderForm.$valid;
            };
            $scope.addCardholder = function () {
                if ($scope.validateForm()) {
                    var cardholderService_2 = cardholderService_1.CardholderService.getInstance($http, appConfig);
                    cardholderService_2.add($scope.cardholder).then(function (success) {
                        cardholderService_2.getAll().then(function (success) {
                            parentScope.gridOptions.data = success.data;
                            $scope.cancel();
                        });
                    });
                }
            };
        }
        return CardholderController;
    }());
    exports.CardholderController = CardholderController;
    CardholderController.i18n = i18n;
});
//# sourceMappingURL=cardholderController.js.map