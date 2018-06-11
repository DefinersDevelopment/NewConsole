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



Auth::routes();

Route::get('/', 'MasterController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ben', 'BenTestController@test')->name('benTest');

