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
/* End define all variable gobal for website */


Route::group(['prefix' => 'admin'], function () {
    //Login Routes...
    Route::get('/users','Admin\Users\Users@index');
    Route::get('/login','Admin\Auth\Auth@index');
    Route::post('/login','Admin\Auth\Auth@login');
    Route::get('/logout','AdminAuth\AuthController@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

    Route::get('/admin', 'AdminController@index');

});  