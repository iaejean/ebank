/// <amd-dependency path="i18n!app/nls/user" name="i18n"/>
/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="css!app/css/common"/>

import {Logger} from "../common/logger";
import {Patterns} from "../common/patterns";
import {CardService} from "../services/cardService";
import {Card} from "../models/card";
import {TransactionService} from "../services/transactionService";

declare let i18n: any;
declare let angularAMD: any;

class UserController {
    public static i18n;

    constructor($scope, appConfig, $http, $uibModal) {
        let logger = Logger.getLogger("UserController");
        let cardService = CardService.getInstance($http, appConfig)
        let transactionService = TransactionService.getInstance($http, appConfig)

        logger.info("Starting Controller");
        $scope.i18n = i18n;
        $scope.formValid = false;
        $scope.formChangeNipValid = false;
        $scope.patterns = Patterns;
        $scope.card = new Card();
        $scope.accessed = false;
        $scope.seccion = "menu";
        $scope.nip = "";

        $scope.validateForm = function() {
            $scope.formValid = true;
            return $scope.accessForm.$valid;
        };

        $scope.validateChangeNipForm = function() {
            $scope.formChangeNipValid = true;
            return $scope.changeNipForm.$valid;
        };

        $scope.access = function() {
            if ($scope.validateForm()) {
                cardService.get($scope.card).then(function(success){
                    if (success.status === 200) {
                        $scope.card = success.data;
                        $scope.accessed = true;
                    }
                });
            }
        };

        $scope.changeNip = function(){
            $scope.seccion = "changeNip";
        };

        $scope.changeNipAction = function (changeNipForm) {
            cardService.update($scope.card, changeNipForm.nip.$modelValue).then(function (success) {
                if (success.status === 200) {
                    alert("success");
                }
            });
        };

        $scope.getTransactions = function(){
            $scope.seccion = "transactions";
            transactionService.getByCard($scope.card).then(function (response) {
                console.log(response);
                $scope.transactions = response.data;
            });
        };

        $scope.getBalance = function () {
            $scope.seccion = "balance";
        };

        $scope.goMenu = function(){
            $scope.seccion = "menu";
        };

        $scope.exit = function(){
            $scope.seccion = "menu";
            $scope.accessed = false;
            $scope.card = new Card();
        };

        /*
        $scope.add = function (entity) {
            $scope.modalViewCard = $uibModal.open({
                animation: true,
                templateUrl: appConfig.URL_BASE + "views/addFounds.html",
                controller: CardController,
                resolve: {
                    parentScope: $scope,
                    cardholder: entity,
                }
            });
        };

        $scope.view = function (entity) {
            $scope.modalAddAmount = $uibModal.open({
                animation: true,
                templateUrl: appConfig.URL_BASE + "views/cards.html",
                controller: AccountController,
                resolve: {
                    parentScope: $scope,
                    cardholder: entity
                }
            });
        };
        */
    }
}

angularAMD.controller("userController", ["$scope", "appConfig", "$http", "$uibModal", UserController]);
