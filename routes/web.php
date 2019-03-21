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

Route::get('/test', function () {
    dd(route('voyager.login'));
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::put('contacts/{id}/reply', 'Admin\contactsController@reply')->name('contact.reply');
    Route::post('delete_file/{id}', 'Admin\ajaxController@deleteFile');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
