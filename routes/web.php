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
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::put('contacts/{id}/reply', 'Admin\contactsController@reply')->name('contact.reply');
    Route::post('delete_file/{id}', 'Admin\ajaxController@deleteFile');
});

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tests', 'TestController@index')->name('tests.index');
Route::get('/tests/{slug}', 'TestController@show')->name('tests.show');

Route::get('/set-locale/{locale}', function($locale) {
    request()->session()->put('locale', $locale);
    return redirect()->back();
})->name('setLocale');