import {Logger} from "../common/logger";

export class CardTypeService{
    public static _instance;
    protected $http;
    protected appConfig;
    private logger;

    /**
     * @param $http
     * @param appConfig
     */
    private constructor($http, appConfig) {
        this.logger = Logger.getLogger("CardTypeService");
        this.logger.info("Starting Service");
        this.$http = $http;
        this.appConfig = appConfig
    }

    public static getInstance($http, appConfig) {
        if (CardTypeService._instance instanceof CardTypeService) {
            return CardTypeService._instance;
        }
        return CardTypeService._instance = new CardTypeService($http, appConfig);
    }

    public getAll() {
        return this.$http.get(this.appConfig.URL_BASE_API_V1 + "cardType");
    }
}
