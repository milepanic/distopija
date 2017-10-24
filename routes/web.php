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

Route::get('/', function () {
    return view('welcome');
});
Route::get('submit', 'HomeController@submit')->name('submit');
Route::post('submit', 'PostController@create');

Route::get('create', 'HomeController@create')->name('create');
Route::post('create', 'CategoryController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('/', 'HomeController@dashboard');
	Route::get('users', 'HomeController@users');
	Route::get('posts', 'HomeController@posts');
	Route::get('categories', 'HomeController@categories');
	Route::get('medals', 'HomeController@medals');
});
