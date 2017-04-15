/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="i18n!app/nls/home" name="messages"/>

declare let angularAMD: any;
declare let messages: any;

import {LoggerInterface, Logger} from "../common/logger";

export namespace Controller {

    export class HomeController {

        public static messages: any;
        private self: any = this;
        private $scope: any;
        private appConfig: Object;
        private logger: LoggerInterface;

        /**
         * @param $scope
         * @param appConfig
         */
        constructor ($scope, appConfig) {
            this.logger = Logger.getLogger("HomeController");
            this.logger.info("Starting Controller");
            this.$scope = $scope;
            this.appConfig = appConfig;

            $scope.myInterval = 5000;
            $scope.noWrapSlides = false;
            $scope.active = 0;
            $scope.slides = [];

            HomeController.getSlides($scope, appConfig);
        }

        /**
         * @param $scope
         * @param appConfig
         */
        public static getSlides($scope, appConfig): void {
            let images = ["carrousel_1.jpg", "carrousel_2.jpg"];

            for (let index in images) {
                $scope.slides.push({
                    id: parseInt(index),
                    text: Controller.HomeController.messages.slide[index],
                    image: appConfig.URL_BASE + "/images/" + images[index]
                });
            }
        }
    }

    Controller.HomeController.messages = messages;
    angularAMD.controller("homeController", ["$scope", "appConfig", Controller.HomeController]);
}
