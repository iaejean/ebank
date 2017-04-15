define(["require", "exports"], function (require, exports) {
    "use strict";
    var Card = (function () {
        function Card(id, number, yearExpiration, monthExpiration, cvv, limit, cardType, balance, nip, account, credit) {
            this.id = id;
            this.number = number;
            this.yearExpiration = yearExpiration;
            this.monthExpiration = monthExpiration;
            this.cvv = cvv;
            this.limit = limit;
            this.cardType = cardType;
            this.balance = balance;
            this.nip = nip;
            this.account = account;
            this.credit = credit;
        }
        return Card;
    }());
    exports.Card = Card;
});
//# sourceMappingURL=card.js.map