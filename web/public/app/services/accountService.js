define(["require", "exports", "../common/logger"], function (require, exports, logger_1) {
    "use strict";
    var AccountService = (function () {
        function AccountService($http, appConfig) {
            this.logger = logger_1.Logger.getLogger("AccountService");
            this.logger.info("Starting Service");
            this.$http = $http;
            this.appConfig = appConfig;
        }
        AccountService.getInstance = function ($http, appConfig) {
            if (AccountService._instance instanceof AccountService) {
                return AccountService._instance;
            }
            return AccountService._instance = new AccountService($http, appConfig);
        };
        AccountService.prototype.getAll = function () {
            return this.$http.get(this.appConfig.URL_BASE_API_V1 + "account");
        };
        AccountService.prototype.add = function (account) {
            return this.$http.post(this.appConfig.URL_BASE_API_V1 + "account", account);
        };
        AccountService.prototype.getByCardholder = function (cardholder) {
            return this.$http.get(this.appConfig.URL_BASE_API_V1 + "account/cardholder/" + cardholder.id);
        };
        AccountService.prototype.update = function (account, amount) {
            return this.$http.put(this.appConfig.URL_BASE_API_V1 + "account/amount/" + amount, account);
        };
        return AccountService;
    }());
    exports.AccountService = AccountService;
});
//# sourceMappingURL=accountService.js.map