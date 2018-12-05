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

// Погода
Route::get('/weather', 'WeatherController@index')->name('weather');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'manager', 'namespace'=>'Manager', 'middleware'=>['auth']], function(){
  Route::resource('/order', 'OrderController', ['as'=>'manager']);
});
