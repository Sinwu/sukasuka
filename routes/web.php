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

Route::middleware('auth:web')->get('/editbasic',function (){
	return view('editbasic');
});

Route::middleware('auth:web')->get('/editpassword',function (){
	return view('editpassword');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Internal API Routes
Route::get('/api/post/{before}', 'PostController@index');

Route::post('/api/post', 'PostController@store');

Route::get('/mod', function(){
	return view('/mod/index');
});

Route::get('/dashboard', function(){
	return view('/mod/dashboard');
});