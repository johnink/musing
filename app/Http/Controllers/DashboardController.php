<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $alreadyin=false;
        //pull current games from the database
        $games = DB::table('games')->get();
        //pull current games from games folder
        $folders=scandir('games');
        foreach($folders as $folder){
            //if not invisible
            if(substr($folder,0,1)!='.'){
                foreach($games as $game){
                    //check to see if the game is already in the database. If not, add it.
                    if($folder==$game->name){
                        $alreadyin=true;
                    }
                }
                if($alreadyin!=true){
                    DB::table('games')->insert(['name'=>$folder]);
                }
                else{$alreadyin=false;}
            }
        }
        return view('dashboard');
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
    public function show($id)
    {
        //
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
        //
    }
}
