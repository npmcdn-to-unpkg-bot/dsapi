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

Route::get('/', function () {
    return view('app');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('post', 'PostCtrl');
});
// Templates
Route::group(array('prefix'=>'/templates/'), function() {
    Route::get('{template}', array(function($template) {
        $template = str_replace(".html", "", $template);
        View::addExtension('html', 'php');
        return View::make('templates.' . $template);
    }));

    Route::get('home/{template}', array(function($template) {
        $template = str_replace(".html","", $template);
        View::addExtension('html', 'php');
        return View::make('templates.home.' . $template);
    }));

    Route::get('user/{template}', array(function($template) {
        $template = str_replace(".html","", $template);
        View::addExtension('html', 'php');
        return View::make('templates.user.' . $template);
    }));

    Route::get('post/{template}', array(function($template) {
        $template = str_replace(".html","", $template);
        View::addExtension('html', 'php');
        return View::make('templates.post.' . $template);
    }));

    Route::get('chat/{template}', array(function($template) {
        $template = str_replace(".html","", $template);
        View::addExtension('html', 'php');
        return View::make('templates.chat.' . $template);
    }));
});

/*API*/
Route::group(array('prefix'=>'/api/'), function() {
	/*User*/
	Route::get('/user/getlistusers/{offset?}/{limit?}/{order?}/{by?}', 'UserController@getList');
	Route::get('/user/getuserbyid/{userId}', 'UserController@getUserById');

	/*Post*/
	Route::get('/post/getlistposts/{offset?}/{limit?}/{order?}/{by?}', 'PostController@getList');
    Route::get('/post/gethotposts/{offset?}/{limit?}', 'PostController@getHotPosts');
    Route::get('/post/gethotpostsbycategoryid/{categoryId}/{offset?}/{limit?}', 'PostController@getHotPosts');
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

    /*Channel*/
    Route::get('/channel/getmatch/{source?}', 'ChannelController@getmatch');
    Route::get('/channel/getmatchlink/url/{source?}', 'ChannelController@getmatchlink');
});

/*
Route::group(array('prefix'=>'/category/'), function() {
});
Route::get('/category/{categorySlug}', function () {
	View::addExtension('html', 'php');
	return View::make('templates.home.home');
});*/


// login
Route::get('/admin/login', array(
    'as' => 'admin.login',
    function () {
        if (Auth::check()) {
            return Redirect::route('admin.dashboard');
        }
        return View::make('backend/auth/login');
    }, ));

Route::get('/facebook', array('as'=>'facebook.login', 'uses'=>'FacebookController@facebookLogin'));
Route::get('/callback', array('as'=>'facebook.callback', 'uses'=>'FacebookController@facebookLoginCallback'));

Route::group(array('prefix' => '/admin',
                       'namespace' => 'Admin',
                       'middleware' => ['auth'] ), function () {


    // admin auth
    // Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
    Route::get('/logout', array('as' => 'admin.logout', 'uses' => 'AuthController@getLogout'));
    Route::post('/login', array('as' => 'admin.login.post', 'uses' => 'AuthController@postLogin'));

    // admin password reminder
    Route::get('/forgot-password', array('as' => 'admin.forgot.password',
                                              'uses' => 'AuthController@getForgotPassword', ));
    Route::post('/forgot-password', array('as' => 'admin.forgot.password.post',
                                               'uses' => 'AuthController@postForgotPassword', ));

    Route::get('{id}/reset/{code}', array('as' => 'admin.reset.password',
                                                'uses' => 'AuthController@getResetPassword', ))->where('id', '[0-9]+');
    Route::post('/reset-password', array('as' => 'admin.reset.password.post',
                                              'uses' => 'AuthController@postResetPassword', ));

    // admin dashboard
    Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'DashboardController@index'));

    // category
    Route::resource('category', 'CategoryController', array('before' => 'hasAccess:category'));
    Route::get('category/{id}/delete', array('as' => 'admin.category.delete',
                                                 'uses' => 'CategoryController@confirmDestroy', ))->where('id', '[0-9]+');

    // user
    Route::resource('user', 'UserController');
    Route::get('/user/{id}/delete', array('as' => 'admin.user.delete',
                                         'uses' => 'UserController@confirmDestroy', ))->where('id', '[0-9]+');

    // role
    Route::resource('/role', 'RoleController');
    Route::get('/role/{id}/delete', array('as' => 'admin.role.delete',
                                          'uses' => 'RoleController@confirmDestroy', ))->where('id', '[0-9]+');
});


/*Test*/
Route::get('/test', function () {
    $url = urlencode('http://www.8bongda.com/link-sopcast/link-sopcast-euro-2016-phap-vs-albania-2h00-ngay-166.html');
    echo '<form action="/api/channel/getmatchlink/url/' . $url . '">';
    // echo '<input name="source" value=""/>';
    // echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    echo '<button type="submit">Submit</button>';
    echo '</form>';
});
Route::auth();

Route::get('/home', 'HomeController@index');
