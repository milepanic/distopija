<?php

Route::group(['middleware' => 'banned'], function () {

	// PAGES
	Route::get('/', 'HomeController@index');
	Route::get('profile/{name}', 'HomeController@profile');
	Route::get('profile/edit/{name}', 'HomeController@edit');
	Route::put('profile/edit/{id}', 'HomeController@update');
	
	// POSTS
	Route::get('submit', 'HomeController@submit')->name('submit');
	Route::get('edit/{id}', 'PostController@edit');
	// Vote & Favorite
	Route::post('post/favorite', 'PostController@favorite');
	Route::post('post/vote', 'PostController@vote');
	/* Make resource route */
	Route::post('submit', 'PostController@create');
	Route::get('v/{id}', 'PostController@view');
	Route::put('edit/update/{id}', 'PostController@update');
	Route::delete('delete/{id}', 'PostController@delete');

	// CATEGORIES
	Route::get('create', 'HomeController@create')->name('create');
	Route::post('create', 'CategoryController@create');
	Route::get('k/{name}', 'CategoryController@view');
	Route::get('block/{id}', 'CategoryController@block');

	// COMMENTS
	Route::post('comment/{id}', 'CommentController@create');
	Route::post('comment/{id}/{type}', 'CommentController@update');

	Route::group(['prefix' => 'inbox'], function() {
		Route::get('/', 'MessageController@view')->name('inbox');
		Route::get('compose', 'MessageController@compose');
		Route::post('new', 'MessageController@new');
	});

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
