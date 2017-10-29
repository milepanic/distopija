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

Route::group(['middleware' => 'banned'], function () {
	Route::get('/', 'HomeController@index');

	Route::get('profile', 'HomeController@profile');
	
	Route::get('submit', 'HomeController@submit')->name('submit');
	Route::post('submit', 'PostController@create');

	Route::get('create', 'HomeController@create')->name('create');
	Route::post('create', 'CategoryController@create');

	Route::get('delete/{id}', 'PostController@delete');

	Route::post('comment/{id}', 'CommentController@create');

	Auth::routes();
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('/', 'HomeController@dashboard')->name('Dashboard');
	
	Route::get('users', 'HomeController@users')->name('Users');
	Route::get('users/ban/{id}', 'UserController@banUser');
	Route::get('users/unban/{id}', 'UserController@unbanUser');

	Route::get('posts', 'HomeController@posts')->name('Posts');
	Route::get('posts/delete/{id}', 'PostController@delete');

	Route::get('categories', 'HomeController@categories')->name('Categories');
	Route::get('categories/approve/{id}', 'CategoryController@approve');
	Route::get('categories/reject/{id}', 'CategoryController@reject');
	Route::get('categories/delete/{id}', 'CategoryController@delete');

	Route::get('medals', 'HomeController@medals')->name('Medals');
});
