Client
- Angular (JS?)
- Google Maps API

Server
- PHP Backend
-- Laravel driven interface
-- Do we need an API? Lumen?

- Websocket
-- NodeJS script
--- Faye.JS - Communication between the client and nodejs app. Also allows other clients to get an update
--- Redis + Redis Geo (https://github.com/arjunmehta/node-georedis) to store the data temporarily


- Database
-- MySQL with Spatial functions (https://dev.mysql.com/doc/refman/5.7/en/spatial-types.html)


-- The Gist ---
The main PHP app will handle the request to open up a game based on session id / user ID. If the data in the Redis cache exists and is up to date (why wouldnt it be?), then it loads the initial state from Redis (either via a PHP api call, rather than websocket?)
The client then displays the map.
Movements are sent, via the Faye JS connection to the NodeJS app. This then can store the latest position in the Redis server
On a schedule, the PHP app will then read from the Redis store and then persist the points to the MySQL database using the MySQL Spatial functions

This allows the PHP app to do analysis on the route using MySQL functionality but maintains the latency by using Redis. 
