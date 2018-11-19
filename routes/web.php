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

Route::group(['middleware' => ['web']], function() {

    // Simple User View
    Route::get('/', 'PagesController@index');
    Route::get('/home', 'PagesController@index');
    Route::get('/about', 'PagesController@about');
    Route::get('/contact', 'PagesController@getContact');
    Route::post('/contact', 'PagesController@postContact');
    
    // Blog Posts CRUD
    Route::group(['middleware' => ['auth']], function() {
        Route::resource('posts', 'PostController');
    });
    
    // Showing Blog Posts All And Single
    Route::get('blog/{slug}', ['as'=>'blog.single', 'uses'=>'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['uses'=>'BlogController@getIndex', 'as'=>'blog.index']);

    // Authentication Routes
    Route::get('auth/login', ['as'=>'login', 'uses'=>'Auth\LoginController@showLoginForm']);
    Route::post('auth/login', 'Auth\LoginController@login');
    Route::get('auth/logout', ['as'=>'logout', 'uses'=>'Auth\LoginController@logout']);

    // Registration Routes
    Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('auth/register', 'Auth\RegisterController@register');

    // Password Reset Routes
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    
    Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    // Category CRUD
    Route::resource('category', 'CategoryController', ['except'=>['create']])->middleware('auth');

    // Tag CRUD
    Route::resource('tags', 'TagController', ['except'=>['create']])->middleware('auth');

    // Comment CRUD
    Route::post('comments/{post_id}', 'CommentController@store')->name('comments.store');
    Route::group(['middleware'=>'auth'], function(){
        Route::get('comments/{id}/edit', 'CommentController@edit')->name('comments.edit');
        Route::put('comments/{id}', 'CommentController@update')->name('comments.update');
        Route::get('comments/{id}/delete', 'CommentController@delete')->name('comments.delete');
        Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
    });
    
    
});

