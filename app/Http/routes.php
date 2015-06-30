<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*

/=dashboard
/games/ = search and list of best games
/games/{game} = description of game
/prompter/ = description of prompter
/getstarted/ = info page what you'll need to get started
/user/ = a place to sign up, log in, or change profile

*/

Route::resource('/', 'DashboardController');
Route::get('/db',function(){

	return DB::select('select database();');
});
