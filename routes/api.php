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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('login', 'Api\UserController@login');
// Route::post('register', 'Api\UserController@register');

Route::post('login','Api\UserController@login');
Route::post('register','Api\UserController@register');

Route::middleware(['auth:api'])->group(function(){
    Route::get('user','Api\UserController@index');
    Route::post('logout','Api\UserController@logout');
    Route::post('update','Api\UserController@update');
    Route::post('changePassword','Api\UserController@changePassword');
    Route::post('deleteUser','Api\UserController@destroy');
});

Route::get('paper', 'Api\PaperController@index');
Route::post('paper/item', 'Api\PaperController@show');
Route::post('paper/store', 'Api\PaperController@store');
Route::post('paper/update', 'Api\PaperController@update');
Route::post('paper/delete', 'Api\PaperController@destroy');