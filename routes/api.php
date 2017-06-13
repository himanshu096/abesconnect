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

Route::get('login', 'AuthController@authenticate');
Route::post('create', 'UserController@store');

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::get('me','UserController@getUser');

    Route::put('me','UserController@update');
});