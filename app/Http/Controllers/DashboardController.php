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
        if(Auth::user()){
            $user=Auth::user();
            $widgets = $user->widgets->sortBy('widget_num');
            return view('dashboard')->with('widgets',$widgets);
        }else{
            $availablegames=Game::all();
            return view('dashboard');
        }
    }

}
