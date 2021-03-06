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

    Route::get('/', 'UserController@index');
    Route::post('/', 'UserController@store');
    Route::get('/count', 'UserController@usersCount');
    Route::get('/{id}', 'UserController@show');
    Route::get('/{id}/files', 'UserController@showFiles');
    Route::put('/update-password', 'UserController@updatePassword');
    Route::put('/{id}', 'UserController@update');
    Route::post('/delete-multiple', 'UserController@destroyMultiple');
    // Route::delete('/{id}', 'UserController@destroy');
    Route::delete('/{id}/restore', 'UserController@restore');
    Route::delete('/{id}/remove', 'UserController@remove');
    Route::get('/trashed', 'UserController@trashed');
    Route::patch('/{id}/toggle-can-upload-files','UserController@toggleCanUploadFiles');

});

Route::group(['prefix' => 'categories'], function () {

    Route::get('/', 'CategoryController@index');
    Route::get('/{id}/files', 'CategoryController@showFiles');
    Route::post('/{id}/files', 'CategoryController@storeFiles');
    Route::post('/', 'CategoryController@store');
    Route::put('/{id}', 'CategoryController@update');
    Route::delete('/{id}', 'CategoryController@destroy');
    Route::delete('/{id}/restore', 'CategoryController@restore');
    Route::delete('/{id}/remove', 'CategoryController@remove');
    Route::get('/trashed', 'CategoryController@trashed');

});

Route::group(['prefix' => 'departments'], function () {

    Route::get('/', 'DepartmentController@index');
    Route::get('/{id}/files', 'DepartmentController@showFiles');
    Route::get('/{id}/users', 'DepartmentController@showUsers');
    Route::get('/count', 'DepartmentController@departmentsCount');
    Route::post('/', 'DepartmentController@store');
    Route::put('/{id}', 'DepartmentController@update');
    Route::post('/delete-multiple', 'DepartmentController@destroyMultiple');
    // Route::delete('/{id}', 'DepartmentController@destroy');
    Route::delete('/{id}/restore', 'DepartmentController@restore');
    Route::delete('/{id}/remove', 'DepartmentController@remove');
    Route::get('/trashed', 'DepartmentController@trashed');

});

Route::group(['prefix' => 'files'], function () {

    Route::get('/', 'FileController@index');
    Route::post('/', 'FileController@store');
    Route::post('/upload-multiple', 'FileController@storeMultiple');
    Route::put('/{id}', 'FileController@update');
    Route::delete('/{id}', 'FileController@destroy');
    Route::delete('/delete-multiple', 'FileController@destroyMultiple');
    Route::delete('/{id}/restore', 'FileController@restore');
    Route::delete('/{id}/remove', 'FileController@remove');
    Route::get('/trashed', 'FileController@trashed');
    Route::get('/{key}/by-search', 'FileController@search');
    Route::post('/search', 'SearchController@search');
    Route::get('/count', 'FileController@filesCount');
    Route::get('/count/{date}/by-date', 'FileController@filesCountByDate');
    Route::get('/graph-uploaded-yearly/{year}', 'FileController@report');
    Route::get('/excel-report/download', 'FileController@excelReport');

});

Route::group(['prefix' => 'requests'], function () {

    Route::get('/', 'RequestFormController@index');
    Route::get('/new-requests-count', 'RequestFormController@newRequestCount');
    Route::get('/done', 'RequestFormController@showDone');
    Route::get('/undone', 'RequestFormController@showUndone');
    Route::get('/{id}', 'RequestFormController@show');
    Route::put('/{id}', 'RequestFormController@update');
    Route::patch('/{id}/done', 'RequestFormController@done');
    Route::patch('/{id}/undone', 'RequestFormController@undone');
    Route::delete('/{id}', 'RequestFormController@destroy');
    Route::delete('/{id}/restore', 'RequestFormController@restore');
    Route::delete('/{id}/remove', 'RequestFormController@remove');
    Route::post('/approve-multiple', 'RequestFormController@approveMultiple');
});

Route::group(['prefix' => 'memos'], function () {

    Route::get('/', 'MemoController@index');
    Route::get('/count', 'MemoController@memosCount');
    Route::get('/{id}', 'MemoController@show');
    Route::get('/user/{id}', 'MemoController@showByUser');
    Route::post('/', 'MemoController@store');
    Route::put('/{id}', 'MemoController@update');
    Route::delete('/{id}', 'MemoController@destroy');
    Route::delete('/delete-multiple', 'MemoController@destroyMultiple');
    Route::delete('/{id}/restore', 'MemoController@restore');
    Route::delete('/{id}/remove', 'MemoController@remove');
});


Route::group(['prefix' => 'events'], function () {

    Route::post('/', 'EventController@store');
    Route::get('/', 'EventController@index');

});