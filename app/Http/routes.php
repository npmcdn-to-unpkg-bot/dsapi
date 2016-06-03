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
    return view('welcome');
});
Route::get('/facebook', 'FacebookController@facebook');
Route::get('/callback', 'FacebookController@callback');

/*User*/
Route::get('/user/getlistusers/{offset?}/{limit?}/{order?}/{by?}', array('as' => 'user', 'uses' => 'UserController@getList'));
Route::get('/user/getuserbyid/{userId}', array('as' => 'userid', 'uses' => 'UserController@getUserById'));

/*Post*/

/*Category*/
Route::get('/category/getlistcategories', 'CategoryController@getList');