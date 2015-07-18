<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Game;
use App\User;
use App\Widget;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $games=Game::all();
        return $games;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($widget)
    {
        return $widget;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        if(Auth::user()->widgets->where('widget_num',$id)->first()){
            
        }
        //return $id;
    }
    /**
     * Move a widget up.
     *
     * @param  int  $id
     * @return Response
     */
    public function up($id)
    {
        if($id>0){
            $selwidget=Auth::user()->widgets->where('widget_num',$id)->first();
            $id2=$id-1 . "";//for some stupid reason, this will only work if $id is a string.
            $abovewidget=Auth::user()->widgets->where('widget_num',$id2)->first();
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
        if($id<Auth::user()->widgets->count()){
            $selwidget=Auth::user()->widgets->where('widget_num',$id)->first();
            $id2=$id+1 . "";//for some stupid reason, this will only work if $id is a string.
            $belowwidget=Auth::user()->widgets->where('widget_num',$id2)->first();
            $selwidget->widget_num++;
            $selwidget->save();
            $belowwidget->widget_num--;
            $belowwidget->save();
            return $id;
        }
        else{fail;}
    }
}
