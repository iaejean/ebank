define(["require", "exports", "angularAMD", "i18n!app/nls/footer"], function (require, exports, angularAMD, i18n) {
    "use strict";
    var Controller;
    (function (Controller) {
        var FooterController = (function () {
            function FooterController($scope) {
                $scope.currentYear = (new Date()).getFullYear();
                $scope.i18n = { footer: Controller.FooterController.i18n };
            }
            return FooterController;
        }());
        Controller.FooterController = FooterController;
        Controller.FooterController.i18n = i18n;
        angularAMD.controller("footerController", ["$scope", Controller.FooterController]);
    })(Controller = exports.Controller || (exports.Controller = {}));
});
//# sourceMappingURL=footerController.js.map