export class Card {

    public id: number;
    public number: number;
    public yearExpiration: number;
    public monthExpiration: number;
    public cvv: string;
    public limit: number;
    public cardType: string;
    public balance: number;
    public nip: string;
    public account: number;
    public credit: number;

    constructor(
        id?: number,
        number?: number,
        yearExpiration?: number,
        monthExpiration?: number,
        cvv?: string,
        limit?: number,
        cardType?: string,
        balance?: number,
        nip?: string,
        account?: number,
        credit?: number
    ) {
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
}
