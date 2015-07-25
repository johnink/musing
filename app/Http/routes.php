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
/widgets/ = widget controls
/games/ = search and list of best games
/games/{game} = description of game
/getstarted/ = info page what you'll need to get started
/user/ = a place to update user data.
/user/login = log in
/user/logout = out
/user/register = register
*/

Route::get('/', function(){
	return view('welcome');
});
Route::get('home', 'DashboardController@index');

//widget controls

Route::resource('widget','WidgetController',['except' => ['create', 'show', 'edit']]);
Route::post('widget/up/{id}','WidgetController@up');
Route::post('widget/down/{id}','WidgetController@down');

//games

Route::get('/game/','GameController@index');
Route::get('/game/{game}','GameController@show');


//update games database
Route::get('update','UpdateDatabaseController@index');

//user routes
// Authentication routes
Route::get('user/login', 'Auth\AuthController@getLogin');
Route::post('user/login', 'Auth\AuthController@postLogin');
Route::get('user/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('user/register', 'Auth\AuthController@getRegister');
Route::post('user/register', 'Auth\AuthController@postRegister');
