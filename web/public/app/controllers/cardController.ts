/// <amd-dependency path="i18n!app/nls/executive" name="i18n"/>
/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="css!app/css/common"/>

import {AccountService} from "../services/accountService";
import {CardTypeService} from "../services/cardTypeService";
import {Card} from "../models/card";
import {CardService} from "../services/cardService";
import {Account} from "../models/account";

declare let i18n: any;
declare let angularAMD: any;

export class CardController {

    public static i18n;

    constructor ($scope, $http, appConfig, parentScope, cardholder) {
        let cardTypeService = CardTypeService.getInstance($http, appConfig);
        let cardService = CardService.getInstance($http, appConfig);
        let accountService = AccountService.getInstance($http, appConfig);

        $scope.i18n = i18n;
        $scope.card = new Card();
        $scope.account = new Account();
        $scope.amount = 0;

        $scope.validateUpdateForm = function() {
            $scope.formValid = true;
            return $scope.addCardForm.$valid;
        };

        $scope.update = function() {
            if ($scope.validateUpdateForm ()) {
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
            let credit = cardType.credit ? "credit" : "debit" ;
            return cardType.name  + " - " + credit;
        };

        $scope.selectCardType = function () {
            if ($scope.card.credit) {
                $scope.card.balance = null;
            } else {
                $scope.card.limit = null;
            }
        };

        $scope.validateForm = function() {
            $scope.formValid = true;
            return $scope.addCardForm.$valid;
        };

        $scope.addCard = function() {
            if ($scope.validateForm()) {
                cardService.add($scope.card).then(function (success) {
                    if (success.status === 200) {
                        alert("success");
                    }
                });
            }
        };
    }
}
