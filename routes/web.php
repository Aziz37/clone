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
	Route::resource('/lists', Admin\ListingsController::class);
	Route::resource('/cards', Admin\CardsController::class);
	Route::post('/cards/addAdmin', 'Admin\AdminCardsController@store');
	Route::delete('/cards/addAdmin/{id}', 'Admin\AdminCardsController@delete');
	Route::post('/cards/addUser', 'Admin\CardUsersController@store');
	Route::delete('/cards/addUser/{id}', 'Admin\CardUsersController@delete');
	Route::post('/files/upload', 'Admin\FilesController@store');
	Route::get('/files/download/{id}', 'Admin\FilesController@show');
	Route::delete('/files/{id}', 'Admin\FilesController@destroy');
	Route::post('/comments', 'Admin\CommentsController@store');
	Route::patch('/comments/{id}', 'Admin\CommentsController@update');

	Route::resource('/users', Admin\UsersController::class);

	Route::get('/logout', 'Auth\AdminLoginController@logout');
});

Route::get('/home', 'HomeController@index')->name('home');