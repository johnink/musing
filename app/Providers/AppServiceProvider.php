<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Game;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('_sidebar', function($view){
            $newGames=Game::all()->sortByDesc('created_at')->take(3);
            $topGames=Game::all()->sortByDesc('popularity')->take(3);
            $view->with(['newGames'=>$newGames,'topGames'=>$topGames]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
