<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

// all auth routes
Auth::routes();

// Auth/VerificationController, User Email Verification system
Route::group(['prefix' => 'email'], function() {
    Route::get('/verify', 'Auth\VerificationController@notice')->middleware('auth')->name('verification.notice');
    Route::get('/verify/{id}/{hash}', 'Auth\VerificationController@verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/verification-notification', 'Auth\VerificationController@send')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

// Auth/ForgotPasswordController, Password ask reset system
Route::get('/forgot-password', 'Auth\ForgotPasswordController@request')->middleware('guest')->name('password.request');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@update')->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@reset')->middleware('guest')->name('password.reset');
Route::post('/reset-password', 'Auth\ResetPasswordController@update')->middleware('guest')->name('password.update');


// HomeController , homepage system
Route::get('/', 'HomeController@index')->name('home');

//PostController, Post system
Route::group(['prefix' => 'posts'], function() {
    Route::get('/', 'PostController@index')->name('postList');
    Route::get('/{title}', 'PostController@detail')->name('postDetail');
    Route::post('/{title}', 'CommentController@store')->name('commentAdd')->middleware(['auth', ('rules:comment_crud')]);
});


//Admin group functions
Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function() {
    //Admin homepage
    Route::get('/','HomeController@adminIndex')->name('adminHomepage');

    //Admin PostController, admin Post system (CRUD)
    Route::group(['prefix'=>'posts', 'middleware' => 'rules:post_crud'], function() {
        Route::get('/', 'PostController@adminIndex')->name('adminPostList');
        Route::get('/add', 'PostController@createForm')->name('adminPostAddForm');
        Route::post('/add', 'PostController@create')->name('adminPostAdd');
        Route::get('/{id}/edit', 'PostController@editForm')->name('adminPostEditform');
        Route::patch('/{id}/edit', 'PostController@edit')->name('adminPostEdit');
        Route::delete('/{id}', 'PostController@remove')->name('adminPostDelete');
    });

    //Admin CommentController, admin Comment system
    Route::get('/posts/{id}/comments','CommentController@index')->name('adminCommentList')->middleware('rules:comment_manage');
    Route::delete('/posts/{id}/comments/{commentId}','CommentController@remove')->name('adminCommentList')->middleware('rules:comment_manage');

    //Admin UserController, admin User system
    Route::group(['prefix'=>'users', 'middleware'=>'rules:user_admin'], function() {
        Route::get('/', 'UserController@index')->name('userList');
        Route::get('/{name}', 'UserController@editForm')->name('userEditForm');
        Route::patch('/{name}', 'UserController@edit')->name('userEdit');
        Route::delete('/{name}', 'UserController@remove')->name('userRemove');
    });

    //Admin RoleController, admin Role System
    Route::group(['prefix'=>'roles', 'middleware'=>'rules:roles_crud'], function() {
        Route::get('/','RoleController@index')->name('roleList');
        Route::get('/add','RoleController@createForm')->name('roleCreateForm');
        Route::post('/add','RoleController@create')->name('roleCreate');
        Route::get('/{name}','RoleController@editForm')->name('roleEditForm');
        Route::patch('/{name}','RoleController@edit')->name('roleEdit');
        Route::delete('/{name}','RoleController@remove')->name('roleRemove');
    });

    Route::group(['prefix'=>'rules', 'middleware' => 'rules:rules_admin'], function() {
        Route::get('/','RuleController@index')->name('ruleList');
        Route::get('/{name}','RuleController@editForm')->name('ruleEditForm');
        Route::patch('/{name}','RuleController@edit')->name('ruleEditForm');
    });
});