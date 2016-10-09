<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'users'], function () {

    Route::get('/',                     'UserController@index');
    Route::post('/',                    'UserController@store');
    Route::put('/{id}',                 'UserController@update');
    Route::delete('/{id}',              'UserController@destroy');
    Route::delete('/delete-multiple',   'UserController@destroyMultiple');

});

Route::group(['prefix' => 'categories'], function () {

    Route::get('/',                     'CategoryController@index');
    Route::get('/{id}/files',           'CategoryController@showFiles');
    Route::post('/',                    'CategoryController@store');
    Route::put('/{id}',                 'CategoryController@update');
    Route::delete('/{id}',              'CategoryController@destroy');

});

Route::group(['prefix' => 'departments'], function () {

    Route::get('/',                     'DepartmentController@index');
    Route::get('/{id}/files',           'DepartmentController@showFiles');
    Route::get('/{id}/users',           'DepartmentController@showUsers');
    Route::post('/',                    'DepartmentController@store');
    Route::put('/{id}',                 'DepartmentController@update');
    Route::delete('/{id}',              'DepartmentController@destroy');
    Route::delete('/delete-multiple',   'DepartmentController@destroyMultiple');

});

Route::group(['prefix' => 'files'], function () {

    Route::get('/',                     'FilesController@index');
    Route::post('/',                    'FilesController@store');
    Route::put('/{id}',                 'FilesController@update');
    Route::delete('/{id}',              'FilesController@destroy');
    Route::get('/{key}/by-search',      'FilesController@search');

});