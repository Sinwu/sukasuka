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

Route::middleware('auth')->get('/feed',function (){
	return view('feed');
});

Route::get('/timeline',function (){
	return view('timeline');
});

Route::get('/editbasic',function (){
	return view('editbasic');
});

Route::get('/editpassword',function (){
	return view('editpassword');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
