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

Route::auth();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
	Route::get('/', 'AdminController@index');

	Route::group(['prefix'=>'posts'],function(){		
		Route::get('/', 'PostController@index');
		Route::get('create', 'PostController@create');
		Route::post('/', 'PostController@store');
		Route::get('{id}', 'PostController@preview')->where('id', '[0-9]+');
		Route::get('{id}/edit', 'PostController@edit')->where('id', '[0-9]+');
		Route::post('{id}', 'PostController@update')->where('id', '[0-9]+');
	// 	Route::post('{id}/disable', 'PostController@disable')->where('id', '[0-9]+');		
	});

	Route::group(['prefix'=>'categories'],function(){
		Route::get('/', 'CategoryController@index');
		Route::get('create', 'CategoryController@create');
		Route::post('/', 'CategoryController@store');
		Route::get('{id}', 'CategoryController@show')->where('id', '[0-9]+');
		Route::get('{id}/edit', 'CategoryController@edit')->where('id', '[0-9]+');
		Route::post('{id}', 'CategoryController@update')->where('id', '[0-9]+');
	// 	Route::post('{id}/disable', 'CategoryController@disable')->where('id', '[0-9]+');		
	});

	Route::group(['prefix'=>'menus'],function(){
		Route::get('/', 'MenuController@index');
		Route::get('create', 'MenuController@create');
		Route::post('/', 'MenuController@store');
		Route::get('{id}', 'MenuController@show')->where('id', '[0-9]+');
		Route::get('{id}/edit', 'MenuController@edit')->where('id', '[0-9]+');
		Route::post('{id}', 'MenuController@update')->where('id', '[0-9]+');
	// 	Route::post('{id}/disable', 'MenuController@disable')->where('id', '[0-9]+');		
	});

});
Route::group(['prefix'=>'api/v1'], function(){
	Route::group(['prefix'=>'posts'],function(){		
		Route::get('/', 'PostController@search');
	});
	Route::group(['prefix'=>'menus'],function(){		
		Route::get('{id}', 'MenuController@getJson')->where('id', '[0-9]+');
	});
});