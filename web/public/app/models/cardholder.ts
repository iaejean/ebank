export class Cardholder {

    public id: number;
    public firstName: string;
    public lastName: string;
    public email: string;
    public birthday: string;
    public locale: string;
    public address: string;
    public cp: string;

    constructor(
        id?: number,
        firstName?: string,
        lastName?: string,
        email?: string,
        birthday?: string,
        locale?: string,
        address?: string,
        cp?: string
    ) {
        this.id = id;
        this.firstName = firstName;
        this.lastName = lastName;
        this.email = email;
        this.birthday = birthday;
        this.locale = locale;
        this.address = address;
        this.cp = cp;
    }
}
