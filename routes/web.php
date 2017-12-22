<?php

Route::group(['middleware' => 'banned'], function () {

	// PROFILE PAGE
	Route::get('profile/edit/{slug}', 			'HomeController@edit');
	Route::put('profile/edit/{id}', 			'HomeController@update');
	Route::post('profile/edit/cropper', 		'HomeController@cropper');
	Route::get('profile/{slug}/blocked', 		'HomeController@blocked');
	Route::get('profile/{slug}/subscribed', 	'HomeController@subscribed');
	Route::get('profile/{slug}/subscribers', 	'HomeController@subscribers');
	Route::get('profile/{slug}/{filter?}', 		'HomeController@profile');
	
	// POSTS
	Route::get('submit', 						'HomeController@submit')->middleware('auth')->name('submit');
	Route::get('edit/{id}', 					'PostController@edit');
	// Vote & Favorite
	Route::post('post/favorite', 				'PostController@favorite');
	Route::post('post/vote', 					'PostController@vote');
	/* Make resource route */
	Route::post('submit', 						'PostController@create');
	Route::get('v/{id}', 						'PostController@view');
	Route::put('edit/update/{id}', 				'PostController@update');
	Route::delete('delete/{id}', 				'PostController@delete');

	// CATEGORIES
	Route::get('create', 						'HomeController@create')->middleware('auth')->name('create');
	Route::post('create', 						'CategoryController@create');
	Route::get('k/{name}', 						'CategoryController@view');
	Route::get('block/{id}', 					'CategoryController@block');
	Route::get('unblock/{id}', 					'CategoryController@unblock');

	// COMMENTS
	Route::get('comments/get/{id}', 			'CommentController@read');
	Route::post('comment/{id}', 				'CommentController@create');
	Route::patch('comment/edit/{id}', 			'CommentController@edit');
	Route::delete('comment/delete/{id}', 		'CommentController@delete');
	Route::post('comment/{id}/{type}', 			'CommentController@update');

	// REPORTS
	Route::post('report/{id}', 					'ReportController@create');

	// SUBSCRIBE
	Route::post('subscribe/{id}', 				'UserController@subscribe');


	// INBOX
	Route::group(['prefix' => 'inbox'], function() {

		Route::get('/', 						'MessageController@inbox')->name('inbox');
		Route::get('compose/{id?}', 			'MessageController@compose');
		Route::post('new', 						'MessageController@new');
		Route::get('view/{id}', 				'MessageController@messages');

	});

	Auth::routes();
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('/', 							'AdminController@dashboard')->name('Dashboard');
	
	Route::get('users', 						'AdminController@users')->name('Users');
	Route::post('users/ban/{id}', 				'UserController@banUser');
	Route::get('users/unban/{id}', 				'UserController@unbanUser');

	Route::get('posts', 						'AdminController@posts')->name('Posts');
	Route::get('posts/delete/{id}', 			'PostController@delete');

	Route::get('categories', 					'AdminController@categories')->name('Categories');
	Route::get('categories/approve/{id}', 		'CategoryController@approve');
	Route::get('categories/reject/{id}', 		'CategoryController@reject');
	Route::get('categories/delete/{id}', 		'CategoryController@delete');

	Route::get('medals', 						'AdminController@medals')->name('Medals');

	Route::get('reports', 						'AdminController@reports')->name('Reports');
});

// WELLCOME PAGE
Route::get('//{filter?}', 						'HomeController@index');