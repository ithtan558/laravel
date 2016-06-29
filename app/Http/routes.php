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

/* Define all variable gobal for website */
define('LIMIT_PAGINATION',10);
define('LIMIT_COOKIE_LOGIN',60);
/* End define all variable gobal for website */
Route::group(['prefix' => 'admin'], function () {
	Route::get('/login', [
		'as' => 'ad_login',
		'uses' => 'Admin\Auth\Auth@index'
	]);
	Route::post('/login','Admin\Auth\Auth@login');

	Route::get('forgot-password', [
		'as' => 'ad_email',
		'uses' => 'Admin\Auth\Auth@email'
	]);
	Route::post('forgot-password', [
		'as' => 'ad_post_email',
		'uses' => 'Admin\Auth\Auth@postEmail'
	]);
	Route::get('reset-password/{first_email}/{last_email}/{rand_key}', [
		'as' => 'ad_reset',
		'uses' => 'Admin\Auth\Auth@reset'
	]);
	Route::post('reset-password/{first_email}/{last_email}/{rand_key}', [
		'as' => 'ad_post_reset',
		'uses' => 'Admin\Auth\Auth@postReset'
	]);
});

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
    //Login Routes...
    Route::group(['prefix' => 'users'], function () {
    	/* Router for module user */
    	Route::get('list', [
			'as' => 'user_list',
			'uses' => 'Admin\Users\Users@index'
		]);
		Route::get('add-user', [
			'as' => 'add_user',
			'uses' => 'admin\users\Users@create'
		]);
		Route::get('edit-user/{id}', [
			'as' => 'edit_user',
			'uses' => 'admin\users\Users@edit'
		]);
	});
    
    Route::get('admin-logout', [
    	'as' => 'admin_logout',
    	'uses' => 'Admin\Auth\Auth@logout'
    ]);

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

    Route::get('/admin', 'AdminController@index');

});  