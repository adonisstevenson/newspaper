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

Route::get('/', 'NewsController@index');

Route::get('logout', 'PagesController@logout');


Route::resource('news', 'NewsController', ['only' => ['create', 'store', 'update', 'destroy', 'edit']])->middleware('role:writer');

Route::get('news/{slug}', 'NewsController@show')->name('news.show');


Route::resource('comments', 'CommentsController', ['only' => ['store']])->middleware('auth');

Route::resource('comments', 'CommentsController', ['only' => ['destroy']])->middleware('role:admin');


Route::resource('users', 'UsersController', ['only' => ['edit', 'update']])->middleware(['auth', 'isProfileOwner']);

Route::resource('users', 'UsersController', ['only'=>['show']]);


Auth::routes();


Route::get('{category}', 'NewsController@listByCategory')->name('category');

