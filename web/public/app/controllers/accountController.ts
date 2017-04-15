/// <amd-dependency path="i18n!app/nls/executive" name="i18n"/>
/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="css!app/css/common"/>

import {Logger} from "../common/logger";
import {Patterns} from "../common/patterns";
import {AccountService} from "../services/accountService";

declare let i18n: any;
declare let angularAMD: any;

export class AccountController {

    public static i18n: Object;

    constructor($scope, appConfig, $http, parentScope, cardholder) {
        let accountService = AccountService.getInstance($http, appConfig);
        let logger = Logger.getLogger("AccountController");
        logger.info("Starting Controller");

        $scope.i18n = i18n;
        $scope.patterns = Patterns;

        $scope.cancel = function (event) {
            parentScope.modalViewCard.close(event);
        };

        $scope.getAll = function () {
            accountService.getByCardholder(cardholder).then(function(success) {
                $scope.gridCardOptions.data = [];
                for (let item in success.data) {
                    let account = success.data[item];
                    $scope.gridCardOptions.data = $scope.gridCardOptions.data.concat(account.cards)
                }
            });
        };

        $scope.gridCardOptions = {
            enableFiltering: true,
            showGridFooter: true,
            showColumnFooter: true,
            exporterMenuCsv: true,
            enableGridMenu: true,
            enableSelectAll: true,
            paginationPageSizes: [25, 50, 75],
            paginationPageSize: 25,
            columnDefs: [
                {field: "number", displayName: i18n.card.number },
                {field: "limit.toFixed(2)", displayName: i18n.card.limit},
                {field: "cardType.name", displayName: i18n.card.cardType },
                {field: "balance.toFixed(2)", displayName: i18n.card.balance },
                {field: "credit.toFixed(2)", displayName: i18n.card.credit }
            ],
            data: $scope.getAll()
        };
    }
}
