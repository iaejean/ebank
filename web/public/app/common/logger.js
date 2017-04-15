define(["require", "exports", "moment"], function (require, exports, moment) {
    "use strict";
    var Logger = (function () {
        function Logger() {
            this.channel = "Default";
        }
        Logger.setLogger = function (logger) {
            this.logger = logger;
        };
        Logger.getLogger = function (channel) {
            var logger = new Logger();
            logger.channel = channel;
            return logger;
        };
        Logger.prototype.log = function (message) {
            this.validMessage(message, "log");
        };
        Logger.prototype.info = function (message) {
            this.validMessage(message, "info");
        };
        Logger.prototype.error = function (message) {
            this.validMessage(message, "error");
        };
        Logger.prototype.debug = function (message) {
            this.validMessage(message, "debug");
        };
        Logger.prototype.warn = function (message) {
            this.validMessage(message, "warn");
        };
        Logger.prototype.validMessage = function (message, level) {
            if ((/string|number|boolean/).test(typeof message)) {
                Logger.logger[level]("[" + moment().format() + "] " + this.channel + " - " + message);
            }
            else {
                Logger.logger[level]("[" + moment().format() + "] " + this.channel, message);
            }
        };
        return Logger;
    }());
    exports.Logger = Logger;
});
//# sourceMappingURL=logger.js.map