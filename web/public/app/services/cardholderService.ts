/// <amd-dependency path="moment" name="moment"/>

declare let moment: any;

import {LoggerInterface, Logger} from "../common/logger";
import {Cardholder} from "../models/cardholder";

export class CardholderService {
    public static _instance;
    protected $http;
    protected appConfig;
    private logger: LoggerInterface;

    private constructor($http, appConfig) {
        this.logger = Logger.getLogger("CardholderService");
        this.logger.info("Starting Service");
        this.$http = $http;
        this.appConfig = appConfig;
    }

    public static getInstance($http, appConfig) {
        if (CardholderService._instance instanceof CardholderService) {
            return CardholderService._instance;
        }
        return CardholderService._instance = new CardholderService($http, appConfig);
    }

    public getAll() {
        return this.$http.get(this.appConfig.URL_BASE_API_V1 + "cardholder");
    }

    public add(cardholder: Cardholder) {
        cardholder.birthday = moment(cardholder.birthday).format("YYYY-MM-DD");
        return this.$http.post(this.appConfig.URL_BASE_API_V1 + "cardholder", cardholder);
    }
}
