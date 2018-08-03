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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'MasterController@index')->name('index');

	// testing
	//Route::get('/ben', 'BenTestController@test')->name('benTest');

	// calls that load whole page
	Route::get('/browse/{cat_id}', 'MasterController@browseByCategory')->name('browseByCategory');
	//Route::get('/show/{post_id}', 'MasterController@showPost')->name('showPost');

	Route::get('/a/unreadsByCat/{cat_id}', 'MasterController@getUnreads')->name('getUnreads');
	Route::get('/a/unreads/', 'MasterController@getUnreads')->name('allUnreads');

	/* AJAX CALLS, TODO use another file....???? */
	Route::get('/a/getMiddleByCat/{cat_id}', 'MasterController@getMiddleByCat')->name('getMiddleByCat');
	Route::get('/a/getPost/{post_id}', 'MasterController@getPost')->name('getPost');
	// favorites
	Route::get('/a/getFavorites/', 'MasterController@getFavorites')->name('getFavorites');
	Route::get('/a/toggleFavorite/{onOff}/{post_id}', 'MasterController@toggleFavorite')->name('toggleFavorite');

	// Post search
	Route::post('/a/post/search/', 'MasterController@searchPosts')->name('searchPosts');
	// log the Licensing of an article
	Route::get('/a/post/license/{post_id}', 'MasterController@licensePost')->name('licensePost');

	// Post add/edit 
	Route::get('/admin/showForm/{form_type}', 'AdminController@showForm')->name('showForm');
	Route::post('/admin/savePost', 'AdminController@savePost')->name('savePost');
	Route::get('/admin/editPost/{post_id}', 'AdminController@editPost')->name('editPost');
	Route::get('/admin/post/delete/{post_id}', 'AdminController@deletePost')->name('deletePost');
});

// currently in testing
//Route::post('/admin/chromePost', 'AdminController@makePostFromBrowserExt')->name('chromePost');

// tracking 
Route::get('/t/image', 'AdminController@trackTid')->name('trackTid');



