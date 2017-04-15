export class Account {

    public id: number;
    public number: string;
    public clave: string;
    public balance: number;

    constructor(id?: number, number?: string, clave?: string, balance?: number) {
        this.id = id;
        this.number = number;
        this.clave = clave;
        this.balance = balance;
    }
}
