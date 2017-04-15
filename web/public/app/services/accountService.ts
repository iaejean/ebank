import {LoggerInterface, Logger} from "../common/logger";
import {Account} from "../models/account";

export class AccountService {
    public static _instance;
    protected $http;
    protected appConfig;
    private logger: LoggerInterface;

    /**
     * @param $http
     * @param appConfig
     */
    private constructor($http, appConfig) {
        this.logger = Logger.getLogger("AccountService");
        this.logger.info("Starting Service");
        this.$http = $http;
        this.appConfig = appConfig
    }

    public static getInstance($http, appConfig) {
        if (AccountService._instance instanceof AccountService) {
            return AccountService._instance;
        }
        return AccountService._instance = new AccountService($http, appConfig);
    }

    public getAll() {
        return this.$http.get(this.appConfig.URL_BASE_API_V1 + "account");
    }

    public add(account: Account) {
        return this.$http.post(this.appConfig.URL_BASE_API_V1 + "account", account);
    }

    public getByCardholder(cardholder) {
        return this.$http.get(this.appConfig.URL_BASE_API_V1 + "account/cardholder/" + cardholder.id);
    }

    public update(account, amount) {
        return this.$http.put(this.appConfig.URL_BASE_API_V1 + "account/amount/" + amount, account);
    }
}
