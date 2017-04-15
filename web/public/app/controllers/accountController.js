define(["require", "exports", "i18n!app/nls/executive", "angularAMD", "../common/logger", "../common/patterns", "../services/accountService", "css!app/css/common"], function (require, exports, i18n, angularAMD, logger_1, patterns_1, accountService_1) {
    "use strict";
    var AccountController = (function () {
        function AccountController($scope, appConfig, $http, parentScope, cardholder) {
            var accountService = accountService_1.AccountService.getInstance($http, appConfig);
            var logger = logger_1.Logger.getLogger("AccountController");
            logger.info("Starting Controller");
            $scope.i18n = i18n;
            $scope.patterns = patterns_1.Patterns;
            $scope.cancel = function (event) {
                parentScope.modalViewCard.close(event);
            };
            $scope.getAll = function () {
                accountService.getByCardholder(cardholder).then(function (success) {
                    $scope.gridCardOptions.data = [];
                    for (var item in success.data) {
                        var account = success.data[item];
                        $scope.gridCardOptions.data = $scope.gridCardOptions.data.concat(account.cards);
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
                    { field: "number", displayName: i18n.card.number },
                    { field: "limit.toFixed(2)", displayName: i18n.card.limit },
                    { field: "cardType.name", displayName: i18n.card.cardType },
                    { field: "balance.toFixed(2)", displayName: i18n.card.balance },
                    { field: "credit.toFixed(2)", displayName: i18n.card.credit }
                ],
                data: $scope.getAll()
            };
        }
        return AccountController;
    }());
    exports.AccountController = AccountController;
});
//# sourceMappingURL=accountController.js.map