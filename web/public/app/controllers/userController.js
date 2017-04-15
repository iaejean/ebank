define(["require", "exports", "i18n!app/nls/user", "angularAMD", "../common/logger", "../common/patterns", "../services/cardService", "../models/card", "../services/transactionService", "css!app/css/common"], function (require, exports, i18n, angularAMD, logger_1, patterns_1, cardService_1, card_1, transactionService_1) {
    "use strict";
    var UserController = (function () {
        function UserController($scope, appConfig, $http, $uibModal) {
            var logger = logger_1.Logger.getLogger("UserController");
            var cardService = cardService_1.CardService.getInstance($http, appConfig);
            var transactionService = transactionService_1.TransactionService.getInstance($http, appConfig);
            logger.info("Starting Controller");
            $scope.i18n = i18n;
            $scope.formValid = false;
            $scope.formChangeNipValid = false;
            $scope.patterns = patterns_1.Patterns;
            $scope.card = new card_1.Card();
            $scope.accessed = false;
            $scope.seccion = "menu";
            $scope.nip = "";
            $scope.validateForm = function () {
                $scope.formValid = true;
                return $scope.accessForm.$valid;
            };
            $scope.validateChangeNipForm = function () {
                $scope.formChangeNipValid = true;
                return $scope.changeNipForm.$valid;
            };
            $scope.access = function () {
                if ($scope.validateForm()) {
                    cardService.get($scope.card).then(function (success) {
                        if (success.status === 200) {
                            $scope.card = success.data;
                            $scope.accessed = true;
                        }
                    });
                }
            };
            $scope.changeNip = function () {
                $scope.seccion = "changeNip";
            };
            $scope.changeNipAction = function (changeNipForm) {
                cardService.update($scope.card, changeNipForm.nip.$modelValue).then(function (success) {
                    if (success.status === 200) {
                        alert("success");
                    }
                });
            };
            $scope.getTransactions = function () {
                $scope.seccion = "transactions";
                transactionService.getByCard($scope.card).then(function (response) {
                    console.log(response);
                    $scope.transactions = response.data;
                });
            };
            $scope.getBalance = function () {
                $scope.seccion = "balance";
            };
            $scope.goMenu = function () {
                $scope.seccion = "menu";
            };
            $scope.exit = function () {
                $scope.seccion = "menu";
                $scope.accessed = false;
                $scope.card = new card_1.Card();
            };
        }
        return UserController;
    }());
    angularAMD.controller("userController", ["$scope", "appConfig", "$http", "$uibModal", UserController]);
});
//# sourceMappingURL=userController.js.map