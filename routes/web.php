<?php

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
Route::group(['prefix' => 'email', 'middleware' => 'auth'], function() {
    Route::get('/verify', 'Auth\VerificationController@notice')->name('verification.notice');
    Route::get('/verify/{id}/{hash}', 'Auth\VerificationController@verify')->middleware('signed')->name('verification.verify');
    Route::post('/verification-notification', 'Auth\VerificationController@resend')->middleware('throttle:6,1')->name('verification.resend');
});

Route::group(['prefix' => 'forgot-password', 'middleware' => 'guest'], function() {
    // Auth/ForgotPasswordController, Password ask reset system
    Route::get('/', 'Auth\ForgotPasswordController@request')->name('password.request');
    Route::post('/', 'Auth\ForgotPasswordController@update')->name('password.email');
});

Route::group(['prefix' => 'reset-password', 'middleware' => 'guest'], function() {
    Route::get('/{token}', 'Auth\ResetPasswordController@reset')->name('password.reset');
    Route::post('/', 'Auth\ResetPasswordController@update')->name('password.update');
});


// HomeController , homepage system
Route::get('/', 'HomeController@index')->name('home');

// ContactController, contact form system
Route::get('contact', 'ContactController@sendform')->name('contactForm');
Route::post('contact', 'ContactController@send')->name('contact');

//PostController, Post system
Route::group(['prefix' => 'posts'], function() {
    Route::get('/', 'PostController@index')->name('postList');
    Route::get('/{title}', 'PostController@detail')->name('postDetail');
    Route::post('/{title}', 'CommentController@store')->name('commentAdd')->middleware(['auth', 'rules:comment_crud','verified']);
});

//ProjectController, Project system
Route::group(['prefix' => 'projects'], function() {
    Route::get('/', 'ProjectController@index')->name('projectList');
    Route::get('/{title}', 'ProjectController@detail')->name('projectDetail');
});

//UserController, User Moderation system
Route::group(['prefix' => 'users'], function() {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/edit', 'UserController@editForm')->name('userEditForm');
        Route::put('/edit', 'UserController@edit')->name('userEdit');
        Route::put('/avatar','UserController@changeAvatar')->name('userAvatarChange');
    });
    Route::get('/{name}', 'UserController@detail')->name('userDetail');
});

//Admin group functions
Route::group(['prefix'=>'admin', 'middleware' => ['auth','verified']], function() {
    //Admin homepage
    Route::get('/','HomeController@adminIndex')->name('adminHomepage');

    //Admin PostController, admin Post system (CRUD)
    Route::group(['prefix'=>'posts', 'middleware' => 'rules:post_crud'], function() {
        Route::get('/', 'PostController@adminIndex')->name('adminPostList');
        Route::get('/add', 'PostController@createForm')->name('adminPostAddForm');
        Route::post('/add', 'PostController@create')->name('adminPostAdd');
        Route::get('/{id}/edit', 'PostController@editForm')->name('adminPostEditform');
        Route::put('/{id}/edit', 'PostController@edit')->name('adminPostEdit');
        Route::delete('/{id}', 'PostController@remove')->name('adminPostDelete');
    });

    //AdminProjectController, admin Project system
    Route::group(['prefix'=>'projects','middleware'=>'rules:project_crud'], function() {
        Route::get('/', 'ProjectController@adminIndex')->name('adminProjectList');
        Route::get('/add','ProjectController@createForm')->name('adminProjectAddForm');
        Route::post('/add','ProjectController@create')->name('adminProjectAdd');
        Route::get('/{id}', 'ProjectController@editForm')->name('adminProjectEditForm');
        Route::put('/{id}', 'ProjectController@edit')->name('adminProjectEdit');
        Route::delete('/{id}', 'ProjectController@remove')->name('adminProjectDelete');
    });

    //Admin CommentController, admin Comment system
    Route::get('/posts/{id}/comments','CommentController@index')->name('adminCommentList')->middleware('rules:comment_manage');
    Route::delete('/posts/{id}/comments/{commentId}','CommentController@remove')->name('adminCommentList')->middleware('rules:comment_manage');

    //Admin UserController, admin User system
    Route::group(['prefix'=>'users', 'middleware'=>'rules:user_admin'], function() {
        Route::get('/', 'UserController@index')->name('userList');
        Route::get('/banned','UserController@bannedList')->name('userBanList');
        Route::get('/{name}', 'UserController@adminEditForm')->name('userEditForm');
        Route::put('/{name}', 'UserController@adminEdit')->name('userEdit');
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

    //Admin RuleController, rules System
    Route::group(['prefix'=>'rules', 'middleware' => 'rules:rules_admin'], function() {
        Route::get('/','RuleController@index')->name('ruleList');
        Route::get('/{name}','RuleController@editForm')->name('ruleEditForm');
        Route::patch('/{name}','RuleController@edit')->name('ruleEditForm');
    });

    //Admin ContactController, admin Contact form System
    Route::group(['prefix'=>'contacts', 'middleware' => 'rules:contact'], function() {
        Route::get('/', 'ContactController@index')->name('contactList');
    });
});