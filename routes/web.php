<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// all auth routes
Auth::routes();

// HomeController , homepage system
Route::get('/', 'HomeController@index')->name('home');

//PostController, Post system
Route::get('/posts','PostController@index')->name('postList');
Route::get('/posts/{title}','PostController@detail')->name('postDetail');


//Admin group functions
Route::group(['prefix'=>'admin'], function() {
    //Admin homepage
    Route::get('/','HomeController@adminIndex')->name('adminHomepage');

    //Admin PostController, admin Post system (CRUD)
    Route::get('/posts','PostController@adminIndex')->name('adminPostList');
    Route::get('/posts/add','PostController@createForm')->name('adminPostAddForm');
    Route::post('/posts/add','PostController@create')->name('adminPostAdd');
    Route::get('/posts/{title}','PostController@adminDetail')->name('adminPostDetail');
    Route::get('/posts/{id}/edit','PostController@editForm')->name('adminPostEditform');
    Route::patch('/posts/{id}/edit','PostController@edit')->name('adminPostEdit');
    Route::delete('/posts/{id}','PostController@remove')->name('adminPostDelete');
});