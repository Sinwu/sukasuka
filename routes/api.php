<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:api'])->group(function () {

    // Testing Echo URL
    Route::post('/test', function (Request $request) {
        return response()->json([
            'ok' => 'true'
        ]);
    });

    Route::get('/feed/{before}', 'PostController@index');
	Route::get('/timeline/{tID}/{before}', 'PostController@timeline');
	Route::post('/post', 'PostController@store');
	Route::post('/user/update', 'UserController@update');

	Route::get('/apps', 'AppsController@all');
	Route::post('/media', 'PostController@media');
	Route::post('/like', 'LikeController@index');
	Route::post('/comment', 'CommentController@index');
});