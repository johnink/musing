<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Auth;
use App\Game;
use App\User;
use App\Widget;
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
        $newGames=Game::all()->sortByDesc('created_at')->take(3);
        $topGames=Game::all()->sortByDesc('popularity')->take(3);
        if(Auth::user()){
            $user=Auth::user();
            $widgets = $user->widgets->sortBy('widget_num');
        }else{
            $widgets="";
        }
        return view('dashboard')->with(['widgets'=>$widgets,'topGames'=>$topGames,'newGames'=>$newGames]);
    }

}
