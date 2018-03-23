const angular = require("angular");

const main = angular.module('main', []);

import welcome from "./welcome/welcome.component";
import header from "./header/header.component";

main.config(['$stateProvider', function ($stateProvider) {


    $stateProvider.state({
        name: 'app',
        url: '/',
        views: {
            'header@': 'appHeader'
        }
    });


    $stateProvider.state({
        parent: 'app',
        name: 'home',
        url: 'hometest',
        views: {
            '@': 'appWelcome'
        }

    });


    console.log("Registering states");


}]);


main.component('appWelcome', welcome);
main.component('appHeader', header);

export default main;
