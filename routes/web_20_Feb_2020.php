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



Route::get('/', 'HomeController@index');

//
Auth::routes();

//routes for the music pages

Route::get('/music', 'MusicController@musicPage');

Route::get('/music/{musicId}', 'MusicController@show');

Auth::routes();


Route::get('/music-gallery', 'MusicController@index');


Route::post('/music/add', 'MusicController@store');
Route::post('/music/edit', 'MusicController@edit');
Route::post('/music/delete', 'MusicController@destroy');


Route::post('/music/select-instrument', 'MusicController@selectInstrument');

Auth::routes();

Route::get('/instruments', 'MusicInstrumentController@index');

Route::get('/instrument/add-instrument', 'MusicInstrumentController@addInstrumentPage');

Route::post('/instrument/add', 'MusicInstrumentController@store');

Route::post('/instrument/publish', 'MusicInstrumentController@publish');

Route::post('/instrument/delete', 'MusicInstrumentController@destroy');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
