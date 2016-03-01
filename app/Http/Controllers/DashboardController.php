<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Auth;
use App\Game;
use App\User;
use App\Widget;
use App\Article;
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
        $articles = Article::latest('published_at')->published()->paginate(10);

        for($i=0;$i<=9;$i++){
            $articles[$i]->assignFullCategory();
        }

        if(Auth::user()){
            $user=Auth::user();
            $widgets = $user->widgets->sortBy('widget_num');
        }else{
            $widgets="";
        }
        return view('dashboard',compact('widgets','topGames','newGames','articles'));
    }

}
