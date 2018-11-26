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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/list', 'PostController@getList')->name('list');
    Route::get('/favs', 'PostController@getFavorites')->name('favs');
    Route::post('/new', 'PostController@postNew')->name('new');
    Route::get('fav/{id}', 'PostController@favorite')->name('fav');
});