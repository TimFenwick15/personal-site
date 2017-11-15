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

/*Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('home');
});*/
Route::get('/', 'HomeController@index');
//Route::get('/cards/{type}', 'HomeController@cards');
Route::get('/data', 'DataController@render');
Route::get('/contact', 'ContactController@render');
Route::get('/dataPopulate', 'DataController@populate');
Route::get('/contactPopulate', 'ContactController@populate');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
