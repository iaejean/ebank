define(["require", "exports", "../common/logger"], function (require, exports, logger_1) {
    "use strict";
    var CardService = (function () {
        function CardService($http, appConfig) {
            this.logger = logger_1.Logger.getLogger("CardService");
            this.logger.info("Starting Service");
            this.$http = $http;
            this.appConfig = appConfig;
        }
        CardService.getInstance = function ($http, appConfig) {
            if (CardService._instance instanceof CardService) {
                return CardService._instance;
            }
            return CardService._instance = new CardService($http, appConfig);
        };
        CardService.prototype.getAll = function () {
            return this.$http.get(this.appConfig.URL_BASE_API_V1 + "card");
        };
        CardService.prototype.add = function (card) {
            return this.$http.post(this.appConfig.URL_BASE_API_V1 + "card", card);
        };
        CardService.prototype.get = function (card) {
            return this.$http.post(this.appConfig.URL_BASE_API_V1 + "card/access", card);
        };
        CardService.prototype.update = function (card, nip) {
            return this.$http.put(this.appConfig.URL_BASE_API_V1 + "card/" + card.id + "/" + nip);
        };
        return CardService;
    }());
    exports.CardService = CardService;
});
//# sourceMappingURL=cardService.js.map