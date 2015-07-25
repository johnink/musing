<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//a controller that will automatically update the database with the JSON files next to the games.


class UpdateDatabaseController extends Controller
{

    public function index()
    {
        //make sure all the games are in the database

        if(Auth::user()){
        if(Auth::user()->name=="Admin"){

            //pull current games from games folder
            $folders=scandir('games');
            foreach($folders as $folder){

            //if not invisible
            if(substr($folder,0,1)!='.'){
                $games=Game::where('name',$folder)->get();
                if(file_exists("games/$folder/info.json")){
                        $widgetexists=file_exists("games/$folder/$folder.js");
                        $gameinforaw=file_get_contents("games/$folder/info.json");
                        $gameinfo=json_decode($gameinforaw,true);
                }else{$gameinfo="";}
                //check to see if the game is already in the database. If not, add it.
                if($games->count()==0){
                    Game::create([
                            'name' => $folder,
                            'full_name' => $gameinfo['full_name'],
                            'short_desc' => $gameinfo['short_desc'],
                            'what_youll_need' => $gameinfo['what_youll_need'],
                            'long_desc' => $gameinfo['long_desc'],
                            'writing' => $gameinfo['writing'],
                            'blogging' => $gameinfo['blogging'],
                            'socialmedia' => $gameinfo['socialmedia'],
                            'stageimprov' => $gameinfo['stageimprov'],
                            'drawing' => $gameinfo['drawing'],
                            'standup' => $gameinfo['standup'],
                            'music' => $gameinfo['music'],
                            'widget' => $widgetexists
                        ]);
                }
                




                    //where game = folder, update info for game
                    if(file_exists("games/$folder/info.json")){
                        $widgetexists=file_exists("games/$folder/$folder.js");
                        $games=Game::where('name',$folder)->get();
                        foreach($games as $game){
                            if($game->full_name!=$gameinfo['full_name']){$game->full_name=$gameinfo['full_name'];}
                            if($game->short_desc!=$gameinfo['short_desc']){$game->short_desc=$gameinfo['short_desc'];}
                            if($game->what_youll_need!=$gameinfo['what_youll_need']){$game->what_youll_need=$gameinfo['what_youll_need'];}
                            if($game->long_desc!=$gameinfo['long_desc']){$game->long_desc=$gameinfo['long_desc'];}
                            if($game->variations!=$gameinfo['variations']){$game->variations=$gameinfo['variations'];}
                            if($game->writing!=$gameinfo['writing']){$game->writing=$gameinfo['writing'];}
                            if($game->blogging!=$gameinfo['blogging']){$game->blogging=$gameinfo['blogging'];}
                            if($game->socialmedia!=$gameinfo['socialmedia']){$game->socialmedia=$gameinfo['socialmedia'];}
                            if($game->stageimprov!=$gameinfo['stageimprov']){$game->stageimprov=$gameinfo['stageimprov'];}
                            if($game->drawing!=$gameinfo['drawing']){$game->drawing=$gameinfo['drawing'];}
                            if($game->standup!=$gameinfo['standup']){$game->standup=$gameinfo['standup'];}
                            if($game->music!=$gameinfo['music']){$game->music=$gameinfo['music'];}
                            if($game->widget!=$widgetexists){$game->widget=$widgetexists;}
                            $game->save();
                        }
                    }
                }
            }
            return "games database updated";
        }}
        else{return "no permission";}
    }
}