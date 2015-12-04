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
Route::get('user/{user}', 'UserController@profile');
Route::get('user/{user}/posts', 'UserController@userPosts');
Route::get('user/{user}/comments', 'UserController@userComments');
Route::get('user/{user}/edit', 'UserController@userEdit');
Route::post('user/{user}/edit/profile-pic', 'UserController@picture');
Route::post('user/{user}/edit/signature', 'UserController@signature');

// Post Routes
Route::resource('post', 'PostController');
Route::get('post/{post}/upvote', 'PostController@upvote');
Route::get('post/{post}/downvote', 'PostController@downvote');
Route::get('post/{post}/edit', 'PostController@edit');
Route::get('post/{post}/delete', 'PostController@destroy');

// Comment Routes
Route::post('post/{post}', 'CommentController@comment');
Route::get('post/{post}/upvote/{comment}', 'CommentController@upvote');
Route::get('post/{post}/downvote/{comment}', 'CommentController@downvote');
Route::post('post/{post}/edit/{comment}', 'CommentController@update');
Route::get('post/{post}/delete/{comment}', 'CommentController@destroy');

// Auth Routes
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
