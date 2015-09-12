<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Game;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    /**
     * Display a list of all games
     *
     * @return Response
     */
    public function index($modifier=null,$offset=0)
    {
        //Collect new games
        $newGames=Game::all()->sortByDesc('created_at')->take(3);

        //If modifier 'top' or
        //If nothing is set on the modifier, and someone isn't logged on, get top games
        if($modifier=='top'||($modifier==null&!Auth::check())){
            $games=Game::orderBy('popularity','desc')->skip($offset)->take(10);
        }
        //If user is logged in, load their selected tags.
        elseif($modifier=='recommended'||($modifier==null&&Auth::check())){
            $userTags=Auth::user()->tags()->lists('tag_id')->toArray();
            $games=Game::whereHas('tags', function($query) use($userTags){
                $query->whereIn('id',$userTags);
            })->orderBy('popularity','desc')->skip($offset)->take(10);
        }
        return view('games')->with(['newGames'=>$newGames,'games'=>$games,'modifier'=>$modifier,'offset'=>$offset]);
        withGames($games)->withModifier($modifier)->withOffset($offset);
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