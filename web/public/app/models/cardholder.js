define(["require", "exports"], function (require, exports) {
    "use strict";
    var Cardholder = (function () {
        function Cardholder(id, firstName, lastName, email, birthday, locale, address, cp) {
            this.id = id;
            this.firstName = firstName;
            this.lastName = lastName;
            this.email = email;
            this.birthday = birthday;
            this.locale = locale;
            this.address = address;
            this.cp = cp;
        }
        return Cardholder;
    }());
    exports.Cardholder = Cardholder;
});
//# sourceMappingURL=cardholder.js.map