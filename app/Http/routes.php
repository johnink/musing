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
/auth/ = a place to update user data.
/auth/login = log in
/auth/logout = out
/auth/register = register
*/

/*Route::get('/', function(){
	return view('welcome');
});*/
Route::get('/','DashboardController@index');
Route::get('home', 'DashboardController@index');

//widget controls

Route::group(['middleware' => 'throttle'], function () {
	Route::resource('widget','WidgetController',['except' => ['create', 'show', 'edit', 'update']]);
	Route::post('widget/up/{id}','WidgetController@up');
	Route::post('widget/down/{id}','WidgetController@down');
});

Route::get('widgetonly/{game}',function($game){return view('widgetonly')->withGame($game);});

//games

Route::get('/game/','GameController@index');
Route::get('/game/{game}','GameController@show');
Route::get('/gamelist/{modifier?}/{offset?}','GameController@index');
Route::post('/gamelist','GameController@selectbox');
Route::get('/widgetonly/{game}','GameController@widgetOnly');

//articles

Route::post('/articles/preview','ArticlesController@preview');
Route::resource('articles','ArticlesController');


//get started
Route::get('/getstarted',function(){return view('getstarted');});


//update games database
Route::get('update','UpdateDatabaseController@index');

//terms of service
Route::get('terms',function(){return view('terms');});






//user routes
// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('auth/edit', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@getEdit']);
Route::post('auth/edit', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@postEdit']);
Route::get('auth/pwedit', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@getPwEdit']);
Route::post('auth/pwedit', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@postPwEdit']);
Route::get('auth/emedit', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@getEmEdit']);
Route::post('auth/emedit', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@postEmEdit']);
Route::post('auth/avatar', ['middleware'=>'auth','uses'=>'Auth\AuthEditController@postAvatar']);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
