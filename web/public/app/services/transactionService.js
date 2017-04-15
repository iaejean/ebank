define(["require", "exports", "../common/logger"], function (require, exports, logger_1) {
    "use strict";
    var TransactionService = (function () {
        function TransactionService($http, appConfig) {
            this.logger = logger_1.Logger.getLogger("TransactionService");
            this.logger.info("Starting Service");
            this.$http = $http;
            this.appConfig = appConfig;
        }
        TransactionService.getInstance = function ($http, appConfig) {
            if (TransactionService._instance instanceof TransactionService) {
                return TransactionService._instance;
            }
            return TransactionService._instance = new TransactionService($http, appConfig);
        };
        TransactionService.prototype.getByCard = function (card) {
            return this.$http.get(this.appConfig.URL_BASE_API_V1 + "transaction/card/" + card.id);
        };
        return TransactionService;
    }());
    exports.TransactionService = TransactionService;
});
//# sourceMappingURL=transactionService.js.map