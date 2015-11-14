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
Route::get('post/delete/{post}', 'AdminController@destroy');

// User Routes
Route::get('user/dashboard', 'UserController@dashboard');
Route::get('user/dashboard/edit', 'UserController@edit');
Route::post('user/dashboard/edit/profile-pic', 'UserController@picture');
Route::post('user/dashboard/edit/signature', 'UserController@signature');

// Post Routes
Route::resource('post', 'PostController');
Route::get('post/upvote/{post}', 'PostController@upvote');
Route::get('post/downvote/{post}', 'PostController@downvote');

// Comment Routes
Route::post('post/{post}', 'CommentController@comment');
Route::get('post/{post}/upvote/{comment}', 'CommentController@upvote');
Route::get('post/{post}/downvote/{comment}', 'CommentController@downvote');

// Auth Routes
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
