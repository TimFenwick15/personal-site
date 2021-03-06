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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@serverRendered')->name('serverRendered');
Route::get('/data', 'DataController@render');
Route::get('/tech', 'TechController@render');
Route::get('/contact', 'ContactController@render');
Route::get('/dataPopulate', 'DataController@populate');
Route::get('/adminHome', 'AdminController@index')->name('adminHome');

Auth::routes();
