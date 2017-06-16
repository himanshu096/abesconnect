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
Route::get('google', 'AuthController@loginFromGoogle');
Route::post('create', 'UserController@store');

Route::group(['middleware' => 'jwt.auth'], function () {

    //get loggedin user
    Route::get('me','UserController@getUser');
    //get skills of user
    Route::get('skills','UserController@getSkills');
    //set skills of user
    Route::post('skills','UserController@setSkills');
    //delete skill of user
    Route::delete('skills','UserController@removeSkills');
    //search user
    Route::get('search', 'UserController@search');
    //update user profile
    Route::put('me','UserController@update');
    //get favourite contacts
    Route::get('contacts', 'UserController@getContacts');
    //add contacts
    Route::post('contacts', 'UserController@addContact');
    //delete favourite contacts of user
    Route::delete('contacts','UserController@removeContact');
    //get projects
    Route::get('projects', 'UserController@getProjects');
    //delete project of user
    Route::delete('projects','UserController@removeProject');



});