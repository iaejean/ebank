/// <amd-dependency path="i18n!app/nls/header" name="i18n"/>
/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="css!app/css/menu"/>

declare let i18n: any;
declare let angularAMD: any;

import {Logger, LoggerInterface} from "../common/logger";

export class HeaderController {

    public static i18n: Object;
    private static $scope;
    private self = this;
    private $scope;
    private $http;
    private logger: LoggerInterface;

    /**
     * @param $scope
     * @param appConfig
     * @param $http
     */
    constructor($scope, appConfig, $http) {
        this.logger = Logger.getLogger("HeaderController");
        this.logger.info("Starting Controller");
        this.$http = $http;
        this.$scope = $scope;

        $scope.self = this;
        $scope.i18n = { menu: HeaderController.i18n};
        $scope.languages = appConfig.LOCALES;
        $scope.locale = appConfig.LOCALE;
        $scope.changeLocale = HeaderController.changeLocale;
    }

    /**
     * @param locale
     */
    public static changeLocale(locale: string): void {
        location.pathname = "/" + locale + "/";
    }
}

HeaderController.i18n = i18n;
angularAMD.controller("headerController", ["$scope", "appConfig", "$http", HeaderController]);
