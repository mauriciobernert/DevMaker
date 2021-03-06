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

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'PostController@getList')->name('home');
    Route::get('favs', 'PostController@getFavorites')->name('favs');
    Route::post('new', 'PostController@postNew')->name('new');
    Route::get('fav/{id}', 'PostController@favorite')->name('fav');
    Route::post('submitchange', 'HomeController@change')->name('submitchange');
    Route::get('change', function () { return view('auth.changepass'); })->name('change');
});