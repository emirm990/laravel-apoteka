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

Route::get('/', 'ItemsController@index');
Route::post('/items/search', 'ItemsController@search');
Route::get('/items/new', 'ItemsController@create')->middleware('isAdmin');
Route::post('/items/new', 'ItemsController@store')->middleware('isAdmin');
Route::get('/items/{item_id}/edit', 'ItemsController@edit')->middleware('isAdmin');
Route::get('/items/{item_id}', 'ItemsController@show')->middleware('isAdmin');
Route::patch('/items/{item_id}/edit', 'ItemsController@update')->middleware('isAdmin');
Route::get('/dashboard/edit', 'AdminController@index')->middleware('isAdmin');
Route::get('/dashboard', 'AdminController@home')->name('dashboard')->middleware('isAdmin');
Route::post('dashboard/{item_id}/delete', 'AdminController@destroy')->middleware('isAdmin');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
