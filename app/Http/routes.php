<?php
// header('Access-Control-Allow-Origin: http://arunranga.com');
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/facebook', 'FacebookController@facebook');
Route::get('/callback', 'FacebookController@callback');

/*User*/
Route::get('/user/getlistusers/{offset?}/{limit?}/{order?}/{by?}', 'UserController@getList');
Route::get('/user/getuserbyid/{userId}', 'UserController@getUserById');

/*Post*/
Route::get('/post/getlistposts/{offset?}/{limit?}/{order?}/{by?}', 'PostController@getList');
Route::get('/post/gethotposts/{offset?}/{limit?}', 'PostController@getHotPosts');
Route::get('/post/getpostbyid/{postId}', 'PostController@getPostById');
Route::get('/post/getpostbyslug/{postSlug}', 'PostController@getPostBySlug');
Route::get('/post/getpostsbycategoryid/{categoryId}/{offset?}/{limit?}/{order?}/{by?}', 'PostController@getPostsByCategoryId');
Route::get('/post/getpostsbycategoryslug/{categorySlug}/{offset?}/{limit?}/{order?}/{by?}', 'PostController@getPostsByCategorySlug');

Route::post('/post/createpost', 'PostController@createPost');

/*Category*/
Route::get('/category/getlistcategories', 'CategoryController@getList');

/*Tags*/
Route::get('/tag/getlisttags', 'TagController@getList');
Route::get('/tag/getpostsbytagid/{tagId}', 'TagController@getPostsByTagId');
Route::get('/tag/getpostsbytagslug/{tagSlug}', 'TagController@getPostsByTagSlug');

/*Test*/
Route::get('/test', function () {
	echo '<form action="/post/createpost" method="POST">';
	echo '<input value="test"/>';
	echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
	echo '<button type="submit">Submit</button>';
	echo '</form>';
});