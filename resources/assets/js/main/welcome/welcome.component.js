/**
 * The controller for the `app` component.
 */
var controller = ['$state', '$transitions', 'AppService', class WelcomeController {

    constructor($state, $transitions, AppService) {

        this.$state = $state;
        this.AppService = AppService;
    }

    clickme(){
        console.log("Derp");

        this.AppService.client.publish('/game/748ga48unaw9/locationupdates', {lat: 12.345, lon: 45.678, pano_id: 'Hi there'});
    }

}];


import html from './welcome.html';

export default {
    controller: controller,
    template: html
};