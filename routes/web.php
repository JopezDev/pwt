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

Route::get('/', 'AppController@index')->name('index');
Route::get('/debug', 'AppController@debug')->name('debug');
Route::post('/store', 'AppController@store')->name('post');
Route::get('/api/data', 'AppController@data')->name('data');
