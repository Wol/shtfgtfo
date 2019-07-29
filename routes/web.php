<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => ['nickname']], function() {
    Route::get('/games', 'GameController@index');
    Route::get('/game/{token}', 'GameController@view');
    Route::get('/game/api/{token}', 'GameController@apigame');

    Route::get('/user/api/me', 'UserController@apiuser');
});


Route::get('/user/setname', 'UserController@setName');
Route::post('/user/setname', 'UserController@saveName');
