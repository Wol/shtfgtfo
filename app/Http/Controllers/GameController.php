<?php

namespace App\Http\Controllers;

use App\Geoguessr;
use App\GeoguessrGame;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //


    public function index(Geoguessr $geoguessr)
    {
        $games = $geoguessr->getUnfinishedGames();

        return view('game.index')->with('games', $games);
    }


    public function view($token)
    {
        return view('game.game')->with('token', $token);
    }

    public function apigame($token)
    {
        $game = new GeoguessrGame($token);

        // TODO: Load Movements info from here too

        $info = [];
        $info['round'] = $game->getLatestRound();
        $info['movements'] = [];
        return $info;
    }
}
