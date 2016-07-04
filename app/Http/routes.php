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
// Route::get('/', function () {
//         $client = Elasticsearch\ClientBuilder::create()->build();
//         dd($client);
//         $total = App\Product::count();
//         $products = App\Product::all();
// });

Route::group(['prefix' => 'admin'], function () {
	Route::get('/login','Admin\Auth\Auth@index');
	Route::post('/login','Admin\Auth\Auth@login');
});

Route::group(['prefix' => 'admin'], function () {
    //Login Routes...
    Route::group(['prefix' => 'users'], function () {
    	/* Router for module user */
    	Route::get('list', [
			'as' => 'list_users',
			'uses' => 'Admin\Users\Users@index'
		]);
		Route::post('list', [
			'as' => 'list_users',
			'uses' => 'Admin\Users\Users@index'
		]);
		Route::get('add-user', [
			'as' => 'add_user',
			'uses' => 'Admin\Users\Users@create'
		]);
		Route::post('add-user', [
			'uses' => 'Admin\Users\Users@store'
		]);
		Route::get('edit-user/{id}', [
			'as' => 'edit_user',
			'uses' => 'Admin\Users\Users@edit'
		]);
	});
    
    Route::get('/logout','Admin\Auth\Auth@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

    Route::get('/admin', 'AdminController@index');

});  