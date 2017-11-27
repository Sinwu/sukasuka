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

// Index Routes
Route::middleware('guest')->get('/', function () {
    return view('index');
})->name('gate');

// Page Routes
Route::middleware(['auth:web', 'logged'])->group(function () {	
	Route::get('/feed', 'FeedController@index');
	Route::get('/timeline/{tID}', 'TimelineController@index');
	Route::get('/about/{tID}', 'AboutController@index');
	Route::get('/editbasic', 'UserController@editbasic');
	Route::get('/editpassword', 'UserController@editpassword');
	Route::get('/post/s/{id}', 'PostController@single');
	Route::get('/notification', 'NotificationController@page');
});

// Internal API Routes
Route::prefix('api/internal')->middleware(['auth:web'])->group(function () {
	Route::get('/feed/{before}', 'PostController@index');
	Route::get('/timeline/{tID}/{before}', 'PostController@timeline');
	Route::post('/post', 'PostController@store');
	Route::post('/user/update', 'UserController@update');
	Route::post('/user/updateP', 'UserController@updatePassword');

	Route::get('/apps', 'AppsController@all');
	Route::post('/media', 'PostController@media');
	Route::post('/media/profile', 'UserController@photo');
	Route::post('/like', 'LikeController@index');
	Route::post('/comment', 'CommentController@index');

	Route::get('/notification/p/{before}', 'NotificationController@index');
	Route::get('/notification/self', 'NotificationController@part');
	Route::post('/notification/update', 'NotificationController@update');
	Route::get('/post/{id}', 'PostController@show');

	Route::get('/integrate/profile/{id}', 'UserController@profile');
});

// Vendor's Routes
Auth::routes();

// Default home route
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/mod/login', 'Auth\LoginModController@login');

// CMS Routes
Route::prefix('/mod')->middleware(['auth:web', 'mod'])->group(function(){
	Route::middleware('guestmod')->get('/', function(){ return view('/mod/index'); });
	Route::get('/dashboard', function(){ return view('/mod/dashboard'); });

	Route::get('/shuser', 'UserController@modShUser');
	Route::get('/updateActive', 'UserController@updateActive');

	Route::get('/cmsuser', 'UserController@modCmsUser' );
	
	Route::get('/apps', 'AppsController@index');
	Route::post('/apps', 'AppsController@store');
	Route::post('/delApp', 'AppsController@delete');	
	Route::post('/updShownApp', 'AppsController@updShown');
});
