define(["require", "exports", "moment", "../common/logger"], function (require, exports, moment, logger_1) {
    "use strict";
    var CardholderService = (function () {
        function CardholderService($http, appConfig) {
            this.logger = logger_1.Logger.getLogger("CardholderService");
            this.logger.info("Starting Service");
            this.$http = $http;
            this.appConfig = appConfig;
        }
        CardholderService.getInstance = function ($http, appConfig) {
            if (CardholderService._instance instanceof CardholderService) {
                return CardholderService._instance;
            }
            return CardholderService._instance = new CardholderService($http, appConfig);
        };
        CardholderService.prototype.getAll = function () {
            return this.$http.get(this.appConfig.URL_BASE_API_V1 + "cardholder");
        };
        CardholderService.prototype.add = function (cardholder) {
            cardholder.birthday = moment(cardholder.birthday).format("YYYY-MM-DD");
            return this.$http.post(this.appConfig.URL_BASE_API_V1 + "cardholder", cardholder);
        };
        return CardholderService;
    }());
    exports.CardholderService = CardholderService;
});
//# sourceMappingURL=cardholderService.js.map