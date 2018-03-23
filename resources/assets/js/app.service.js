// =============================================================================
// App Service
// =============================================================================


// Imports
// =============================================================================

import env from './env';


// Service
// =============================================================================

class AppService {

    constructor($http)
    {
        this.$http = $http;
        console.log("AppService");

        var url = window.location.protocol + "//" + window.location.hostname + ":24601/faye";
        console.log("Connecting to: ", url);
        this.client = new Faye.Client(url);

        this.client.subscribe('/messages', function(message) {
            alert('Got a message: ' + message.text);
        });



    }

}


// Dependency Injection
// =============================================================================

AppService.$inject = [
    '$http'
];


// Export
// =============================================================================

export default AppService;
