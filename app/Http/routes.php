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

Route::get('/', 'DefaultController@index');
Route::get('/books/{slug}', 'DefaultController@show');
Route::get('/create', 'DefaultController@create');
Route::get('/books/{slug}/edit', 'DefaultController@edit');
Route::post('/books', 'DefaultController@store');
Route::put('/books/{slug}', 'DefaultController@update');

Route::controllers([
    'user'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
