<?php
use App\User;
use App\Post;
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

Auth::routes();



Route::post('/subscribe/{user}', function (User $user) 
{
    return auth()->user()->subscriptions()->toggle($user->profile);
});

Route::get('/', 'PostsController@index');
Route::get('/post/explore', 'PostsController@explore');
Route::get('/post/create','PostsController@create');
Route::get('/post/{post}','PostsController@show');
Route::get('/post/{post}/edit','PostsController@edit')->name('post.edit');
Route::patch('/post/{post}','PostsController@update')->name('post.update');
Route::delete('/post/{post}','PostsController@destroy')->name('post.destroy');
Route::post('/post','PostsController@store');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


// Route::get('/post/{post}',function (Post $post){
//     $id = $post->user_id;
//     $user = User::findOrFail($id);
//     return view ('posts.show', compact('post','user'));
// });