/// <amd-dependency path="angularAMD" name="angularAMD"/>
/// <amd-dependency path="i18n!app/nls/footer" name="i18n"/>

declare let i18n: any;
declare let angularAMD: any;

export namespace Controller {

    export class FooterController {

        public static i18n: Object;

        constructor($scope) {
            $scope.currentYear = (new Date()).getFullYear();
            $scope.i18n = { footer: Controller.FooterController.i18n };
        }
    }

    Controller.FooterController.i18n = i18n;
    angularAMD.controller("footerController", ["$scope", Controller.FooterController]);
}
