/*global location, require, environment, DEV */

var locale = location.pathname.replace(/\//g, "").substr(0, 2);
var config = {
    baseUrl: "../public/",
    locale: locale,
    useStrict: true,
    packages: [
        {
            name: "app",
            location: "app"
        },
        {
            name: "req",
            location: "vendor/requirejs"
        }
    ],
    map: {
        "*": {
            css: "vendor/require-css/css.min"
        }
    },
    paths: {
        angular: "vendor/angular/angular.min",
        angularRoute: "vendor/angular-route/angular-route.min",
        angularAMD: "vendor/angularAMD/angularAMD",
        angularUIRouter: "vendor/angular-ui-router/release/angular-ui-router.min",
        angularUIGrid: "vendor/angular-ui-grid/ui-grid.min",
        angularResource: "vendor/angular-resource/angular-resource.min",
        angularAnimate: "vendor/angular-animate/angular-animate.min",
        angularSanitize: "vendor/angular-sanitize/angular-sanitize.min",
        angularLoadingBar: "vendor/angular-loading-bar/build/loading-bar.min",
        moment: "vendor/moment/min/moment-with-locales.min",
        i18n: "vendor/i18n/i18n",
        uiBootstrap: "vendor/angular-bootstrap/ui-bootstrap.min",
        uiBootstrapTlp: "vendor/angular-bootstrap/ui-bootstrap-tpls.min"
    },
    shim: {
        angularRoute: ["angular"],
        angularAMD: ["angular"],
        angularAnimate: ["angular"],
        angularUIRouter: ["angular"],
        angularUIGrid: ["angular"],
        angularResource: ["angular"],
        angularSanitize: ["angular"],
        angularLoadingBar: ["angular"],
        uiBootstrap: ["angular"],
        uiBootstrapTlp: ["uiBootstrap"],
        i18n: ["require"]
    },
    deps: ["app/app"]
};

if (environment === DEV) {
    var date = new Date();
    config.urlArgs = "IAN=" + date.getTime();
}

require.config(config);
