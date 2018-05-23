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

Route::resource('ads', 'AdsController');

Route::post('language','HomeController@language')->name('language');

//Image invalid
Route::get('/img/{filename}', function($filename) {
	return response( file_get_contents('./img/preview.png') )->header('Content-Type','image/png');
});
