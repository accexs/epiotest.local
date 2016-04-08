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

Route::get('/', function () {
    return view('home');
});

//rutes to handle user registration and confirmation
Route::post('register','UserController@store');
Route::get('register/verify/{token}','UserController@confirm');

//login routes
Route::post('login', 'SessionsController@login');
Route::get('logout', 'SessionsController@logout');

//recipes routes
Route::resource('recipes','RecipeController',array('only' => array('index','show', 'store', 'destroy')));
Route::post('recipes/{id}', 'RecipeController@update');
Route::get('recipes/send/{id}','RecipeController@send');