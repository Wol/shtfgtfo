/**
 * The controller for the `app` component.
 */
class HeaderController {
    constructor($state) {

        this.$state = $state;

        $state.value = "Hello";
    }

    clickme(){
        console.log("Derp");
    }

}
HeaderController.$inject = ['$state'];


import html from './header.html';

export default {
    controller: HeaderController,
    template: html
};