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

// View Routes
Route::middleware('guest')->get('/', function () {
    return view('index');
})->name('gate');

Route::get('/feed', 'FeedController@index');

Route::get('/timeline', 'TimelineController@index');

Route::get('/about', 'TimelineController@about');

Route::get('/editbasic', 'UserController@editbasic');

Route::get('/editpassword', 'UserController@editpassword');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Internal API Routes
Route::get('/api/post/{before}', 'PostController@index');

Route::post('/api/post', 'PostController@store');

// CMS Routes
Route::get('/mod', function(){
	return view('/mod/index');
});

Route::get('/mod/dashboard', function(){
	return view('/mod/dashboard');
});

Route::get('/mod/shuser', function(){
	return view('/mod/shuser');
});

Route::get('/mod/cmsuser', function(){
	return view('/mod/cmsuser');
});

Route::get('/mod/shinterface', function(){
	return view('/mod/shinterface');
});

Route::get('/mod/shapi', function(){
	return view('/mod/shapi');
});