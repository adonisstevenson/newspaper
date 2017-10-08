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

Auth::routes();

Route::group(['middleware' => ['role:writer']], function () {

   Route::resource('news', 'NewsController', ['except' => [
    	'show'
	]]);

});

Route::resource('news', 'NewsController', ['except' => [
    'create', 'store', 'update', 'destroy'
]]);

Route::get('{category}', 'NewsController@byCategory');