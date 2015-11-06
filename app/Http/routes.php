<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Main Routes
Route::get('/', 'MainController@index');
Route::get('todo', 'MainController@todo');
Route::get('general', 'MainController@general');
Route::get('faq', 'MainController@faq');
Route::get('help', 'MainController@help');
Route::get('looking-to-play', 'MainController@play');

// Admin Routes
Route::get('admin/dashboard', 'AdminController@dashboard');

// User Routes
Route::get('user/dashboard', 'UserController@dashboard');
Route::get('user/dashboard/edit', 'UserController@edit');

// Post Routes
Route::resource('post', 'PostController');

// Comment Routes
Route::post('post/{post}', 'PostController@comment');

// Auth Routes
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
