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

    //get loggedin user
    Route::get('me','UserController@getUser');
    //get skills of user
    Route::get('skills','UserController@getSkills');
    //set skills of user
    Route::post('skills','UserController@setSkills');
    //search user
    Route::get('search', 'UserController@search');
    //update user profile
    Route::put('me','UserController@update');
    //get favourite contacts
    Route::get('contacts', 'UserController@getContacts');
    //get projects
    Route::get('projects', 'UserController@getProjects');
    //set projects
    Route::post('projects', 'UserController@setProjects');


});