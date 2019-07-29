<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GeoguessrGame
{

    private $token;
    /**
     * @var \App\Geoguessr
     */
    private $geoguessrgame;

    public function __construct($token)
    {

        $this->token = $token;

        $geoguessr = new Geoguessr();
        $this->geoguessrgame = $geoguessr->getGame($token);

    }


    public function getLatestRound()
    {

        $round = [];

        $round['id'] = $this->geoguessrgame['round'];
        $round['location'] = $this->geoguessrgame['rounds'][$round['id'] - 1];



        return $round;
    }

    public function movements()
    {
        return Movement::where('geoguessr_game_token', $this->token)
            ->where('round', $this->geoguessrgame['round']);
    }

}
