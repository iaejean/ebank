import {LoggerInterface, Logger} from "../common/logger";
import {Card} from "../models/card";

export class CardService {
    public static _instance;
    protected $http;
    protected appConfig;
    private logger: LoggerInterface;

    private constructor($http, appConfig) {
        this.logger = Logger.getLogger("CardService");
        this.logger.info("Starting Service");
        this.$http = $http;
        this.appConfig = appConfig
    }

    public static getInstance($http, appConfig) {
        if (CardService._instance instanceof CardService) {
            return CardService._instance;
        }
        return CardService._instance = new CardService($http, appConfig);
    }

    public getAll() {
        return this.$http.get(this.appConfig.URL_BASE_API_V1 + "card");
    }

    public add(card: Card) {
        return this.$http.post(this.appConfig.URL_BASE_API_V1 + "card", card);
    }

    public get(card: Card) {
        return this.$http.post(this.appConfig.URL_BASE_API_V1 + "card/access", card);
    }

    public update(card, nip) {
        return this.$http.put(this.appConfig.URL_BASE_API_V1 + "card/" + card.id + "/" + nip);
    }
}
