define(["require", "exports", "i18n!app/nls/executive", "angularAMD", "../common/logger", "../common/patterns", "../services/cardholderService", "./accountController", "./cardController", "./cardholderController", "css!app/css/common"], function (require, exports, i18n, angularAMD, logger_1, patterns_1, cardholderService_1, accountController_1, cardController_1, cardholderController_1) {
    "use strict";
    var ExecutiveController = (function () {
        function ExecutiveController($scope, appConfig, $http, $uibModal) {
            this.self = this;
            this.logger = logger_1.Logger.getLogger("ExecutiveController");
            this.logger.info("Starting Controller");
            this.$http = $http;
            this.$scope = $scope;
            this.$uibModal = $uibModal;
            var cardholderService = cardholderService_1.CardholderService.getInstance($http, appConfig);
            $scope.self = this;
            $scope.i18n = ExecutiveController.i18n;
            $scope.formValid = false;
            $scope.patterns = patterns_1.Patterns;
            $scope.getAll = function () {
                cardholderService.getAll().then(function (success) {
                    $scope.gridOptions.data = success.data;
                });
            };
            $scope.gridOptions = {
                enableFiltering: true,
                showGridFooter: true,
                showColumnFooter: true,
                exporterMenuCsv: true,
                enableGridMenu: true,
                enableSelectAll: true,
                paginationPageSizes: [25, 50, 75],
                paginationPageSize: 25,
                columnDefs: [
                    { field: "id", displayName: i18n.grid.id, width: 50 },
                    { field: "firstName", displayName: i18n.grid.firstName, width: 100 },
                    { field: "lastName", displayName: i18n.grid.firstName, width: 100 },
                    { field: "email", displayName: i18n.grid.email },
                    { field: "birthday.substring(0,10)", displayName: i18n.grid.birthday, width: 100 },
                    { field: "address", displayName: i18n.grid.address },
                    { field: "cp", displayName: i18n.grid.cp, width: 70 },
                    { field: "locale", displayName: i18n.grid.locale, width: 65 },
                    {
                        name: "view",
                        displayName: i18n.grid.viewCard,
                        enableFiltering: false,
                        width: 40,
                        cellTemplate: "<button id=\"viewBtn\" type=\"button\" class=\"btn btn-action\" ng-click=\"grid.appScope.view(row.entity)\" >" +
                            "<span class=\"glyphicon glyphicon-eye-open\"></span>" +
                            "</button>"
                    },
                    {
                        name: "add",
                        displayName: i18n.grid.addCard,
                        enableFiltering: false,
                        width: 40,
                        cellTemplate: "<button id=\"addBtn\" type=\"button\" class=\"btn btn-action\" ng-click=\"grid.appScope.add(row.entity)\" >" +
                            "<span class=\"glyphicon glyphicon-plus\"></span>" +
                            "</button>"
                    }
                ],
                data: $scope.getAll()
            };
            $scope.showModalAddCardholder = function () {
                $scope.modalAddCardholder = $uibModal.open({
                    animation: true,
                    templateUrl: appConfig.URL_BASE + "views/addCardholder.html",
                    controller: cardholderController_1.CardholderController,
                    resolve: {
                        parentScope: $scope
                    }
                });
            };
            $scope.add = function (entity) {
                $scope.modalViewCard = $uibModal.open({
                    animation: true,
                    templateUrl: appConfig.URL_BASE + "views/addCard.html",
                    controller: cardController_1.CardController,
                    resolve: {
                        parentScope: $scope,
                        cardholder: entity
                    }
                });
            };
            $scope.view = function (entity) {
                $scope.modalAddCard = $uibModal.open({
                    animation: true,
                    templateUrl: appConfig.URL_BASE + "views/cards.html",
                    controller: accountController_1.AccountController,
                    resolve: {
                        parentScope: $scope,
                        cardholder: entity
                    }
                });
            };
        }
        return ExecutiveController;
    }());
    ExecutiveController.i18n = i18n;
    cardholderController_1.CardholderController.i18n = i18n;
    accountController_1.AccountController.i18n = i18n;
    cardController_1.CardController.i18n = i18n;
    angularAMD.controller("executiveController", ["$scope", "appConfig", "$http", "$uibModal", ExecutiveController]);
});
//# sourceMappingURL=executiveController.js.map