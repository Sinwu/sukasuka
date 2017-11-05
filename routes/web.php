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
	Route::get('/timeline', 'TimelineController@index');
	Route::get('/about', 'TimelineController@about');
	Route::get('/editbasic', 'UserController@editbasic');
	Route::get('/editpassword', 'UserController@editpassword');
});

// Internal API Routes
Route::prefix('api/internal')->middleware(['auth:web'])->group(function () {
	Route::get('/post/{before}', 'PostController@index');
	Route::post('/post', 'PostController@store');
});

// Vendor's Routes
Auth::routes();

// Default home route
Route::get('/home', 'HomeController@index')->name('home');

// CMS Routes
Route::prefix('mod')->group(function(){
	Route::get('/', function(){ return view('/mod/index'); });	
	Route::get('/dashboard', function(){ return view('/mod/dashboard'); });

	Route::get('/shuser', 'UserController@modShUser');
	Route::get('/updateActive', 'UserController@updateActive');

	Route::get('/cmsuser', function(){ return view('/mod/cmsuser'); });
	Route::get('/shinterface', function(){ return view('/mod/shinterface'); });
	Route::get('/shapi', function(){ return view('/mod/shapi'); });	
});