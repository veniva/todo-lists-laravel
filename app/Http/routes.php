<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function(){
        return view('welcome');
    });

    Route::get('/home', function(){
        return view('home');
    });

    // Authentication Routes...
    Route::auth();

    Route::get('/lists/{list}', 'TodoListController@index');
    Route::post('/lists/add', 'TodoListController@add');
    Route::post('/lists/edit/{list}', 'TodoListController@edit');
    Route::delete('/lists/delete/{list}', 'TodoListController@delete');

    Route::post('/tasks/add', 'TaskController@add');
    Route::get('/tasks/edit/{task}/{page}', 'TaskController@editGet');
    Route::post('/tasks/edit/{task}/{page}', 'TaskController@editPost');
    Route::delete('/tasks/delete/{task}', 'TaskController@delete');
});
