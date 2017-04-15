define(["require", "exports", "../common/logger"], function (require, exports, logger_1) {
    "use strict";
    var CardTypeService = (function () {
        function CardTypeService($http, appConfig) {
            this.logger = logger_1.Logger.getLogger("CardTypeService");
            this.logger.info("Starting Service");
            this.$http = $http;
            this.appConfig = appConfig;
        }
        CardTypeService.getInstance = function ($http, appConfig) {
            if (CardTypeService._instance instanceof CardTypeService) {
                return CardTypeService._instance;
            }
            return CardTypeService._instance = new CardTypeService($http, appConfig);
        };
        CardTypeService.prototype.getAll = function () {
            return this.$http.get(this.appConfig.URL_BASE_API_V1 + "cardType");
        };
        return CardTypeService;
    }());
    exports.CardTypeService = CardTypeService;
});
//# sourceMappingURL=cardTypeService.js.map