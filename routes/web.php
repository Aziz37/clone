<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm');
	Route::post('/login', 'Auth\AdminLoginController@login');

	Route::get('/', 'Admin\AdminController@index');

	Route::resource('/boards', Admin\BoardsController::class);
	Route::post('/boards/addUser', 'Admin\BoardUsersController@store');
	Route::delete('/boards/addUser/{id}', 'Admin\BoardUsersController@delete');
	
	Route::resource('/lists', Admin\ListingsController::class);
	
	Route::resource('/cards', Admin\CardsController::class);
	Route::post('/cards/addUser', 'Admin\CardUsersController@store');
	Route::delete('/cards/addUser/{id}', 'Admin\CardUsersController@delete');
	
	Route::post('/files/upload', 'Admin\FilesController@store');
	Route::get('/files/download/{id}', 'Admin\FilesController@show');
	Route::delete('/files/{id}', 'Admin\FilesController@destroy');
	
	Route::post('/comments', 'Admin\CommentsController@store');
	Route::patch('/comments/{id}', 'Admin\CommentsController@update');

	Route::resource('/users', Admin\UsersController::class);

	Route::get('/export', 'Admin\ExportExcelController@export');

	Route::get('/profile/{id}/edit', 'Admin\AdminController@edit');
	Route::patch('/profile/{id}', 'Admin\AdminController@update');

	Route::get('/logout', 'Auth\AdminLoginController@logout');
});

Route::prefix('users')->group(function() {
	Route::get('/home', 'User\HomeController@index');

	Route::resource('/boards', User\BoardsController::class);
	
	Route::resource('/cards', User\CardsController::class);
	
	Route::post('/files/upload', 'User\FilesController@store');
	Route::get('/files/download/{id}', 'User\FilesController@show');
	Route::delete('/files/{id}', 'User\FilesController@destroy');

	Route::post('/comments', 'User\CommentsController@store');
	Route::patch('/comments/{id}', 'User\CommentsController@update');

	Route::get('/profile/{id}/edit', 'User\HomeController@edit');
	Route::patch('/profile/{id}', 'User\HomeController@update');
	
	Route::get('/logout', 'Auth\LoginController@userLogout');
});