<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Tag;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;

//a controller that will automatically update the database with the JSON files next to the games.


class UpdateDatabaseController extends Controller
{

    public function index()
    {
        

        if(Auth::check()){
        if(Auth::user()->name=="Admin"){

            /* + * x * + * x * + * x * + * x * + * x * + * x
            
            Check to see that the tags are equal to
            the tags in the database
            
            x * + * x * + * x * + * x * + * x * + * x * + */

            $newTags=Config::get('constants.TAGS');

            foreach ($newTags as $newTag) {
                //Check to see if each tag is in the db
                //Remember, each newTag is an array, with the short name at zero
                if(Tag::where('name',$newTag[0])->count()==0){
                    //If it's not add it.
                    Tag::create([
                        "name" => $newTag[0]
                    ]);
                    echo "Tag " . $newTag[0] . " added.<br/><br/>";
                }
            }

            echo "Tag database updated.<br/><br/>";


            /* + * x * + * x * + * x * + * x * + * x * + * x
        
            Make sure all the games are in the
            database
            
            x * + * x * + * x * + * x * + * x * + * x * + */

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
                    $newGame = Game::create([
                            'name' => $folder,
                            'full_name' => $gameinfo['full_name'],
                            'short_desc' => $gameinfo['short_desc'],
                            'what_youll_need' => $gameinfo['what_youll_need'],
                            'long_desc' => $gameinfo['long_desc'],
                            'primary_tag' => $gameinfo['primary'],
                            'widget' => $widgetexists
                        ]);

                    //create tags array
                    $tagIds=[];
                    foreach($gameinfo['tags'] as $tag){
                        $tagId=IntVal(Tag::where('name',$tag)->pluck('id'));
                        array_push($tagIds,$tagId);

                    }

                    $newGame->tags()->attach($tagIds);

                    echo "Game " . $folder . " added.<br/><br/>";
                }
                



                /* + * x * + * x * + * x * + * x * + * x * + * x
                
                Next, make sure the info in the json = the info
                in the database.

                Where game = folder, update info for game
                
                x * + * x * + * x * + * x * + * x * + * x * + */
                    
                if(file_exists("games/$folder/info.json")){
                    $widgetexists=file_exists("games/$folder/$folder.js");
                    $games=Game::where('name',$folder)->get();
                    foreach($games as $game){
                        if($game->full_name!=$gameinfo['full_name']){$game->full_name=$gameinfo['full_name'];}
                        if($game->short_desc!=$gameinfo['short_desc']){$game->short_desc=$gameinfo['short_desc'];}
                        if($game->what_youll_need!=$gameinfo['what_youll_need']){$game->what_youll_need=$gameinfo['what_youll_need'];}
                        if($game->long_desc!=$gameinfo['long_desc']){$game->long_desc=$gameinfo['long_desc'];}
                        if($game->variations!=$gameinfo['variations']){$game->variations=$gameinfo['variations'];}
                        if($game->primary_tag!=$gameinfo['primary']){$game->primary_tag=$gameinfo['primary'];}
                        if($game->widget!=$widgetexists){$game->widget=$widgetexists;}
                        $game->save();

                        //check tags
                        $dbTags=$game->tags()->lists('name')->toArray();

                        $newTags=$gameinfo['tags'];

                        foreach(Tag::all()->pluck('name')->toArray() as $tag){
                            $tagId=IntVal(Tag::where('name',$tag)->pluck('id'));
                            if(in_array($tag,$newTags)&!in_array($tag,$dbTags)){
                                $game->tags()->attach($tagId);
                                
                            }elseif(in_array($tag,$dbTags)&!in_array($tag,$newTags)){
                                $game->tags()->detach($tagId);
                            }

                        }
                    }
                }
            }
            }//end foreach
            echo "Games database updated.<br/>";

                
        }
        else{echo "No Permission";}
        }
        else{echo "No Permission";}
        return "<br/><br/>Done";
    }
}