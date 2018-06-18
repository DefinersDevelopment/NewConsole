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

Route::get('/browse/{cat_id}', 'MasterController@browseByCategory')->name('browseByCategory');
Route::get('/show/{post_id}', 'MasterController@showPost')->name('showPost');

/* AJAX CALLS, TODO use another file....???? */
Route::get('/a/getMiddleByCat/{cat_id}', 'MasterController@getMiddleByCat')->name('getMiddleByCat');
Route::get('/a/getPost/{post_id}', 'MasterController@getPost')->name('getPost');

// Post add/edit 
Route::get('/admin/showForm/{form_type}', 'AdminController@showForm')->name('showForm');
Route::post('/admin/savePost', 'AdminController@savePost')->name('savePost');
Route::get('/admin/editPost/{post_id}', 'AdminController@editPost')->name('editPost');

// favorites
Route::get('/admin/toggleFavorite/{onOff}/{post_id}', 'AdminController@toggleFavorite')->name('toggleFavorite');