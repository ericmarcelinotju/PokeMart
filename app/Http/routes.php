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

Route::group(['middleware' => 'login'], function () {
    Route::auth();
});

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'role:member'], function () {
	
	Route::get('/profile', 'UserController@profile');
	Route::put('/profile', 'UserController@updateProfile');

	Route::get('/pokemon', 'PokemonController@index');
	Route::get('/pokemon/{id}', 'PokemonController@detail');

	Route::get('/cart', 'CartController@index');
	Route::post('/cart', 'CartController@insert');
	Route::delete('/cart/{id}', 'CartController@delete');

	Route::post('/comment', 'CommentController@insert');

	Route::get('/transaction', 'TransactionController@index');
	Route::get('/transaction/detail/{id}', 'TransactionController@detail');
	Route::post('/transaction', 'TransactionController@insert');
});

Route::group(['prefix' => '/admin', 'middleware' => 'role:admin'], function () {
	Route::group(['prefix' => '/pokemon'], function () {
		Route::get('/', 'PokemonController@index');
		Route::get('/insert', 'PokemonController@adminInsert');
		Route::get('/update/{id}', 'PokemonController@adminUpdate');

		Route::post('/insert', 'PokemonController@saveInsert');
		Route::put('/update', 'PokemonController@saveUpdate');
		Route::delete('/delete/{id}', 'PokemonController@delete');
	});

	Route::group(['prefix' => '/user'], function () {
		Route::get('/', 'UserController@index');
		Route::get('/update', 'UserController@update');
		
		Route::put('/update', 'UserController@save');
		Route::get('/delete', 'UserController@delete');
	});

	Route::group(['prefix' => '/element'], function () {
		Route::get('/', 'ElementController@insert');
		Route::get('/update', 'ElementController@update');
		Route::get('/edit', 'ElementController@edit');
		Route::post('/save', 'ElementController@save');
	});

	Route::group(['prefix' => '/transaction'], function () {
		Route::get('/', 'TransactionController@index');
		Route::put('/', 'TransactionController@update');
		Route::get('/detail/{id}', 'TransactionController@detail');
		Route::delete('/', 'TransactionController@delete');
	});
});