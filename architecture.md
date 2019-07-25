Client
- Vue Components
- Google Maps API

Server
- PHP Backend
-- Laravel driven interface

Websocket
- Pusher.js
  - Maybe enable webhooks to save to server?


Database
- MySQL
  - Users (cookie bag for geoguessr session)
  - Sessions (laravel sessions as normal)
  - Games (token, userid)
  - Movements (id, game token, game round idx, user id, gmaps pano id, lat, lng, azi/elev timestamp, previous_movement_id)
  - Annotations (game token, game round idx, user id, json representation, movement_id)


-- The Gist ---
A User logs in. Their cookiebag is stored against their user.
Download a list of unfinished games? (how do we start a new game? Do we do that in geoguessr?)
Signed route to open a game with a given userid
Game shows gmap and streetview

Initially all users follow the movements of the initial player
A client can be configured to follow any given player (position and orientation)
If a following client moves the streetview orientation, then this will stick 



