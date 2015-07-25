<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    /**
     * Display a list of all games
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a single game
     */
    public function show($id)
    {
        $game=Game::where('name',$id)->firstOrFail();
        $game->popularity++;
        $game->save();
        return view('game')->withGame($game);
    }

}