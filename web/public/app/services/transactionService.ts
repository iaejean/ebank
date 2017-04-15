import {LoggerInterface, Logger} from "../common/logger";

export class TransactionService {
    public static _instance;
    protected $http;
    protected appConfig;
    private logger: LoggerInterface;

    private constructor($http, appConfig) {
        this.logger = Logger.getLogger("TransactionService");
        this.logger.info("Starting Service");
        this.$http = $http;
        this.appConfig = appConfig
    }

    public static getInstance($http, appConfig) {
        if (TransactionService._instance instanceof TransactionService) {
            return TransactionService._instance;
        }
        return TransactionService._instance = new TransactionService($http, appConfig);
    }

    public getByCard(card) {
        return this.$http.get(this.appConfig.URL_BASE_API_V1 + "transaction/card/" + card.id);
    }
}
