<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TasksController@index');
Route::post('/', 'TlistsController@create');

Auth::routes();

Route::get('/tlists/{tlist}/task', 'TasksController@add');
Route::post('/tlists/{tlist}/task', 'TasksController@create');

Route::get('/tlists/{tlist}/task/{task}', 'TasksController@edit');
Route::post('/tlists/{tlist}/task/{task}', 'TasksController@update');

Route::get('/tlists/{tlist}', 'TlistsController@show');
