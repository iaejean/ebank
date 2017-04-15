/// <amd-dependency path="i18n!app/nls/executive" name="i18n"/>
/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="css!app/css/common"/>

import {Logger, LoggerInterface} from "../common/logger";
import {Patterns} from "../common/patterns";
import {CardholderService} from "../services/cardholderService";
import {AccountController} from "./accountController";
import {CardController} from "./cardController";
import {CardholderController} from "./cardholderController";

declare let i18n: any;
declare let angular: any;
declare let angularAMD: any;

class ExecutiveController {

    public static i18n: Object;
    private static $scope: any;
    private self: any = this;
    private $scope;
    private $http;
    private $uibModal;
    private logger: LoggerInterface;

    constructor($scope, appConfig, $http, $uibModal) {
        this.logger = Logger.getLogger("ExecutiveController");
        this.logger.info("Starting Controller");
        this.$http = $http;
        this.$scope = $scope;
        this.$uibModal = $uibModal;
        let cardholderService = CardholderService.getInstance($http, appConfig);

        $scope.self = this;
        $scope.i18n = ExecutiveController.i18n;
        $scope.formValid = false;
        $scope.patterns = Patterns;

        $scope.getAll = function () {
            cardholderService.getAll().then(function(success) {
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
                {field: "id", displayName: i18n.grid.id, width: 50 },
                {field: "firstName", displayName: i18n.grid.firstName, width: 100 },
                {field: "lastName", displayName: i18n.grid.firstName, width: 100 },
                {field: "email", displayName: i18n.grid.email },
                {field: "birthday.substring(0,10)", displayName: i18n.grid.birthday, width: 100 },
                {field: "address", displayName: i18n.grid.address },
                {field: "cp", displayName: i18n.grid.cp, width: 70 },
                {field: "locale", displayName: i18n.grid.locale, width: 65 },
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
                controller: CardholderController,
                resolve: {
                    parentScope: $scope
                }
            });
        };

        $scope.add = function (entity) {
            $scope.modalViewCard = $uibModal.open({
                animation: true,
                templateUrl: appConfig.URL_BASE + "views/addCard.html",
                controller: CardController,
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
                controller: AccountController,
                resolve: {
                    parentScope: $scope,
                    cardholder: entity
                }
            });
        };
    }
}

ExecutiveController.i18n = i18n;
CardholderController.i18n = i18n;
AccountController.i18n = i18n;
CardController.i18n = i18n;

angularAMD.controller("executiveController", ["$scope", "appConfig", "$http", "$uibModal", ExecutiveController]);
