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
define('LIMIT_COOKIE_LOGIN',1);
define('LIMIT_PAGINATION_TEMP',10);
/* End define all variable gobal for website */


Route::group(['prefix' => 'admin'], function () {
    //Login Routes...
    Route::group(['prefix' => 'users'], function () {
    	/* Router for module user */
    	Route::get('list', [
			'as' => 'list',
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
    Route::get('/login','Admin\Auth\Auth@index');
    Route::post('/login','Admin\Auth\Auth@login');
    Route::get('/logout','Admin\Auth\Auth@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

    Route::get('/admin', 'AdminController@index');

});  