define(["require", "exports"], function (require, exports) {
    "use strict";
    var Patterns = (function () {
        function Patterns() {
        }
        Patterns.USERNAME = /^[a-z0-9-_]{5,15}$/;
        Patterns.PASSWORD = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
        Patterns.EMAIL = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
        Patterns.SLUG = /^[a-z0-9-]+$/;
        Patterns.URL = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
        Patterns.IP = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        Patterns.HTML_TAG = /^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/;
        Patterns.NUMBER = /\d/;
        Patterns.EXTENSION_IMAGES = /([^\\s]+(?=\\.(jpg|gif|png))\\.\\2)/;
        Patterns.NIP = /\d{4}/;
        Patterns.CVV = /\d{3,4}/;
        Patterns.CARD_NUMBER_SLUG = /\d{4}-d{4}-d{4}-d{2,4}/;
        Patterns.CARD_NUMBER = /\d{14,16}/;
        Patterns.CP = /\d{5}/;
        Patterns.ADDRESS = /\w{2}/;
        Patterns.DATE_FORMAT = "yyyy-MM-dd";
        Patterns.DATE_FORMAT_C = "YYYY-MM-DD[T]HH:mm:ssZZ";
        return Patterns;
    }());
    exports.Patterns = Patterns;
});
//# sourceMappingURL=patterns.js.map