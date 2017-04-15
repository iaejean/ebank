/// <amd-dependency path="i18n!app/nls/executive" name="i18n"/>
/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="css!app/css/common"/>

import {Logger, LoggerInterface} from "../common/logger";
import {Patterns} from "../common/patterns";
import {CardholderService} from "../services/cardholderService";
import {Cardholder} from "../models/cardholder";

declare let i18n: any;
declare let angular: any;
declare let angularAMD: any;

export class CardholderController {

    public static i18n: Object;
    private static $scope: any;
    private self: any = this;
    private $scope;
    private $http;
    private gridOptions;
    private logger: LoggerInterface;

    constructor($scope, appConfig, $http, parentScope) {
        this.logger = Logger.getLogger("CardholderController");
        this.logger.info("Starting Controller");
        this.$http = $http;
        this.$scope = $scope;

        $scope.cardholder = new Cardholder();
        $scope.self = this;
        $scope.i18n = CardholderController.i18n;
        $scope.formValid = false;
        $scope.cardholder = {};
        $scope.patterns = Patterns;
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

        $scope.open = function() {
            $scope.popup.opened = true;
        };

        $scope.popup = {
            opened: false
        };

        $scope.validateForm = function() {
            $scope.formValid = true;
            return $scope.addCardholderForm.$valid;
        };

        $scope.addCardholder = function() {
            if ($scope.validateForm()) {
                let cardholderService = CardholderService.getInstance($http, appConfig);

                cardholderService.add($scope.cardholder).then(function (success) {
                    cardholderService.getAll().then(function(success) {
                        parentScope.gridOptions.data = success.data;
                        $scope.cancel();
                    });
                });
            }
        };
    }
}

CardholderController.i18n = i18n;
