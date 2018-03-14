<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List movies
Route::get('movies', 'MovieController@index');

// List single movie
Route::get('movie/{id}', 'MovieController@show');

// List searcbed movies
Route::get('movie/search/{text}', 'MovieController@search');

// Create new movie
Route::post('movie', 'MovieController@store');

// Update movie
Route::put('movie', 'MovieController@store');

// Delete movie
Route::delete('movie/{id}', 'MovieController@destroy');