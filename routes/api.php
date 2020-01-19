<?php

use App\Comment;
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

Route::get('/comments/{post}','CommentController@apiIndex')->name('api.comments.index');
Route::post('/comments/{post}/{user}','CommentController@apiStore')->name('api.comments.store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
