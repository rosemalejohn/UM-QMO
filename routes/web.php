<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('layouts.app');
    });

});

Auth::routes();

Route::group(['prefix' => 'request-form'], function () {

	Route::get('/','RequestFormController@create');
	Route::post('/', 'RequestFormController@store');    
	
});
