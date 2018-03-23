// =============================================================================
// App
// =============================================================================


// Imports
// =============================================================================


import config from './app.config';
import run from './app.run';
import service from './app.service';

const angular = require("angular");
require("./bootstrap");


var uiRouter = require("@uirouter/angularjs").default;

console.log(uiRouter);
// App Module
// =============================================================================

import apphtml from "./app.html";

import main from "./main/main.module";


const app = angular.module('app', [uiRouter, main.name])

    .component('app', {
        template: apphtml
    })
    .service('AppService', service)
    .config(config)
    .run(run)
    .name;


console.log("Running?");