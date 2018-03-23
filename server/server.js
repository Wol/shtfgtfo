// =============================================================================
// Push script for ACHiiVE system
// =============================================================================


/*jshint esversion: 6*/
/*global process*/

// Requires
// =============================================================================

const fs   = require('fs');
const faye = require('faye');
const redis = require('redis');
const client = redis.createClient();
const geo = require('georedis').initialize(client)

// Setup
// =============================================================================

const bayeux = new faye.NodeAdapter({
    mount: '/faye',
    timeout: 45,
    ping: 5
});

const options = {
    environment: process.env.NODE_ENV || 'production',
    port: 24601,
    logfile: 'state.log'
};

const response = (request, response) => {
    response.writeHead(200, {'Content-Type': 'text/plain'});
    response.end('Hello, non-Bayeux request. ');
};

// Setup server
// =============================================================================

let http = require('http');
let server = http.createServer(response);

if (options.environment === 'production') {
    http = require('https');
    server = http.createServer({
        key: fs.readFileSync('private.key'),
        cert: fs.readFileSync('cert.pem')
    }, response);
}



bayeux.attach(server);
server.listen(options.port);

let logger = fs.createWriteStream(options.logfile, { flags: 'a'});

console.log('Push Server Started (' + options.environment + ')');
console.log('Listening on ' + options.port);
console.log('Logging analytics to ' + options.logfile);


bayeux.on('publish', (clientId, channel, data) => {
    console.log('Message Published: ', clientId, channel, data);

    var channelparts = channel.split("/");

    var object = channelparts[1];
    var id = channelparts[2];
    var action = channelparts[3];

    console.log("Object: ", object, " Id:", id, " Action: ", action);

    if(object === "game" && action === "locationupdates"){
        // Save the location object
        data.date = (new Date()).getTime();
        client.lpush("game:" + id + ":locations", JSON.stringify(data));
        client.set("game:active:" + id, data.date);
    }
});

bayeux.on('handshake', (clientId) => {
    console.log('Client connected: ', clientId);
});

bayeux.on('disconnect', (clientId) => {
    console.log('Client disconnected: ', clientId);
});

bayeux.on('subscribe', (clientId, channel) => {
    console.log('Client', clientId, 'subscribed to', channel);
});



