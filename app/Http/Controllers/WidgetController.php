<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Game;
use App\User;
use App\Widget;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $widgets=Game::where('widget','1')->lists('name')->all();
        if(isset($_SERVER['HTTP_REFERER'])){
            $requestFrom=basename($_SERVER['HTTP_REFERER']);
        }else{
            $requestFrom="blank";
        }
        
        //If the user is logged on and on the dashboard, only get the users widgets.
        if(Auth::check()&&!in_array($requestFrom,$widgets)){
            $this->fixOffset(Auth::user()->widgets->sortBy('widget_num'));
            $widgets=Auth::user()->widgets->unique('game_id')->lists('game_id');
            $games=Game::whereIn('id',$widgets)->get();
        }
        else{
            $games=Game::where('widget','1')->get();
        }
        //$games=Game::where('widget','1')->lists('name')->all();
        return $games;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $userwidgets=Auth::user()->widgets->sortBy('widget_num');
        $maxwidgets = Config::get('constants.MAX_WIDGETS');
        $this->fixOffset($userwidgets);

        if(isset($_POST['widget_num']) && isset($_POST['game_name']) && $userwidgets->count()<$maxwidgets){
            $widget_num=$_POST['widget_num'];
            Widget::where('user_id',Auth::user()->id)->where("widget_num",">=",$widget_num)->increment('widget_num');
            $game=Game::where('name',$_POST['game_name'])->firstOrFail();
 

            Widget::create([
                "user_id" => Auth::user()->id,
                "game_id" => $game->id,
                "widget_num" => $widget_num
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $kill= Auth::user()->widgets->where('widget_num',$id)->first();
        if($kill->count()>0){
            $kill->delete();
            Widget::where('user_id',Auth::user()->id)->where("widget_num",">",$id)->decrement('widget_num');
        }
 
        


    }

    /**
     * Move a widget up.
     *
     * @param  int  $id
     * @return Response
     */
    public function up($id)
    {
        $widgets = Auth::user()->widgets;
        if($id>0){
            $selwidget=$widgets->where('widget_num',$id)->first();
            $id2=$id-1 . "";//for some stupid reason, this will only work if $id is a string.
            $abovewidget=$widgets->where('widget_num',$id2)->first();
            $selwidget->widget_num--;
            $selwidget->save();
            $abovewidget->widget_num++;
            $abovewidget->save();
            return $id;
        }
        else{fail;}
    }

     /**
     * Move a widget down.
     *
     * @param  int  $id
     * @return Response
     */
    public function down($id)
    {
        $widgets = Auth::user()->widgets;
        if($id<$widgets->count()){
            $selwidget=$widgets->where('widget_num',$id)->first();
            $id2=$id+1 . "";//for some stupid reason, this will only work if $id is a string.
            $belowwidget=$widgets->where('widget_num',$id2)->first();
            $selwidget->widget_num++;
            $selwidget->save();
            $belowwidget->widget_num--;
            $belowwidget->save();
            return $id;
        }
        else{fail;}
    }

    /**
     * fixOffset()
     *
     *  A fun little function that will sort the users widgets and make sure they're incremented.
     *
     */
    function fixOffset($widgets){
        $i=0;
        foreach($widgets as $widget){
            $widget->widget_num=$i;
            $widget->save();
            $i++;
        }
        return $widgets;

    }
}
