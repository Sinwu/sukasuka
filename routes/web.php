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

Route::get('/', function () {
    return view('index');
});

Route::get('/newsfeed',function (){
	return view('newsfeed');
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