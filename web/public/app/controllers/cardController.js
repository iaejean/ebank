define(["require", "exports", "i18n!app/nls/executive", "angularAMD", "../services/accountService", "../services/cardTypeService", "../models/card", "../services/cardService", "../models/account", "css!app/css/common"], function (require, exports, i18n, angularAMD, accountService_1, cardTypeService_1, card_1, cardService_1, account_1) {
    "use strict";
    var CardController = (function () {
        function CardController($scope, $http, appConfig, parentScope, cardholder) {
            var cardTypeService = cardTypeService_1.CardTypeService.getInstance($http, appConfig);
            var cardService = cardService_1.CardService.getInstance($http, appConfig);
            var accountService = accountService_1.AccountService.getInstance($http, appConfig);
            $scope.i18n = i18n;
            $scope.card = new card_1.Card();
            $scope.account = new account_1.Account();
            $scope.amount = 0;
            $scope.validateUpdateForm = function () {
                $scope.formValid = true;
                return $scope.addCardForm.$valid;
            };
            $scope.update = function () {
                if ($scope.validateUpdateForm()) {
                    accountService.update($scope.account, $scope.amount).then(function (success) {
                        if (success.status === 200) {
                            alert("Success");
                        }
                    });
                }
            };
            accountService.getByCardholder(cardholder).then(function (success) {
                $scope.accounts = success.data;
                $scope.card.account = success.data[0];
            });
            cardTypeService.getAll().then(function (success) {
                $scope.cardTypes = success.data;
                $scope.card.cardType = success.data[0];
            });
            $scope.getCardTypeLabel = function (cardType) {
                var credit = cardType.credit ? "credit" : "debit";
                return cardType.name + " - " + credit;
            };
            $scope.selectCardType = function () {
                if ($scope.card.credit) {
                    $scope.card.balance = null;
                }
                else {
                    $scope.card.limit = null;
                }
            };
            $scope.validateForm = function () {
                $scope.formValid = true;
                return $scope.addCardForm.$valid;
            };
            $scope.addCard = function () {
                if ($scope.validateForm()) {
                    cardService.add($scope.card).then(function (success) {
                        if (success.status === 200) {
                            alert("success");
                        }
                    });
                }
            };
        }
        return CardController;
    }());
    exports.CardController = CardController;
});
//# sourceMappingURL=cardController.js.map