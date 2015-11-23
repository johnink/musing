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
        $games=$this->getGames($modifier,$offset);
        return view('games')->with(['newGames'=>$newGames,'games'=>$games,'modifier'=>$modifier,'title'=>$games->title,'offset'=>$offset]);
    }


    /**
     * On Selectbox change
     *
     * @return Response
     */
    public function selectbox(){
        $modifier=null;
        $offset=0;
        if(isset($_POST['modifier'])){$modifier = $_POST['modifier'];}
        if(isset($_POST['offset'])){$offset = $_POST['offset'];}
        $games=$this->getGames($modifier,$offset);
        $title=$games->title;
        $games=$games->get();
        foreach($games as $game){
            $game->gametags=$game->tags()->lists('name')->toArray();
            $game->title=$title;
        }



        return $games;


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

    /**
     * Display a game's widget only
     */

    public function widgetOnly($id)
    {
        $game=Game::where('name',$id)->firstOrFail();
        return view('widgetonly')->withGame($game);
    }

    function getGames($modifier=null,$offset=0){

        //If modifier 'top' or
        //If nothing is set on the modifier, and someone isn't logged on, get top games
        if($modifier=='top'||($modifier==null&!Auth::check())){
            $games=Game::orderBy('popularity','desc')->skip($offset)->take(10);
            $games->title="Top Games";
        }
        //If modifier 'new'
        elseif($modifier=='new'){
            $games=Game::orderBy('created_at','desc')->skip($offset)->take(10);
            $games->title="New Games";
        }
        //If modifier 'widgets' show games with widgets
        elseif($modifier=='widgets'){
            $games=Game::orderBy('popularity','desc')->where('widget','1')->skip($offset)->take(10);
            $games->title="Games With Widgets";
        }
        //If modifier 'recommended' or
        //If user is logged in, load their selected tags.
        elseif(($modifier=='recommended'||$modifier==null)&&Auth::check()){
            $userTags=Auth::user()->tags()->lists('tag_id')->toArray();
            $games=Game::whereHas('tags', function($query) use($userTags){
                $query->whereIn('id',$userTags);
            })->orderBy('popularity','desc')->skip($offset)->take(10);
            $games->title="Recommended for You";
        }
        //If modifier 'recommendednew' load new games with selected tags
        elseif($modifier=='recommendednew'&&Auth::check()){
            $userTags=Auth::user()->tags()->lists('tag_id')->toArray();
            $games=Game::whereHas('tags', function($query) use($userTags){
                $query->whereIn('id',$userTags);
            })->orderBy('created_at','desc')->skip($offset)->take(10);
            $games->title="New for You";
        }
        //If modifier is in tags, show only games with that tag
        elseif(in_array($modifier, Tag::all()->lists('name')->toArray())){
            $tagId=[Tag::where('name',$modifier)->pluck('id')];
            $games=Game::whereHas('tags', function($query) use($tagId){
                $query->whereIn('id',$tagId);
            })->orderBy('popularity','desc')->skip($offset)->take(10);
            $games->title=ucfirst($modifier) . " Games";
        }
        else{
            App::abort(404);
        }

        return $games;

    }

}