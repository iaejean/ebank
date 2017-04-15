define(["require", "exports"], function (require, exports) {
    "use strict";
    var Account = (function () {
        function Account(id, number, clave, balance) {
            this.id = id;
            this.number = number;
            this.clave = clave;
            this.balance = balance;
        }
        return Account;
    }());
    exports.Account = Account;
});
//# sourceMappingURL=account.js.map