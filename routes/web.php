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

Route::get('/post/{slug}','HomeController@show')->name('post.show');

Route::get('/tag/{slug}','HomeController@tag')->name('tag.show');

Route::get('/category/{slug}','HomeController@category')->name('category.show');

Route::post('/subscribe', 'SubsController@subscribe');

Route::get('/', 'HomeController@index');

Route::get('/verify/{token}', 'SubsController@verify')->name('verify');

Route::group(['middleware'=>'admin'],function (){

    Route::get('/admin','Admin\DashboardController@index');

    Route::resource('/admin/categories','Admin\CategoriesController');

    Route::resource('/admin/tags','Admin\TagsController');

    Route::resource('/admin/users','Admin\UsersController');

    Route::resource('/admin/posts','Admin\PostsController');

    Route::get('/admin/comments','Admin\CommentsController@index');

    Route::delete('/admin/comments/{id}/destroy','Admin\CommentsController@destroy')->name('comment.destroy');
});

Route::group(['middleware'=>'guest'],function (){

    Route::get('/register','AuthController@registerForm');

    Route::get('/login','AuthController@loginForm')->name('login');

    Route::post('/login','AuthController@login');

    Route::post('/register','AuthController@register');

    Route::get('/redirect', 'AuthController@redirect');

    Route::get('/callback', 'AuthController@callback');
});

Route::group(['middleware'=>'auth'],function (){

    Route::get('/logout','AuthController@logout');

    Route::get('/profile', 'ProfileController@index');

    Route::post('/profile', 'ProfileController@store');

    Route::post('/comment', 'CommentsController@store');
});