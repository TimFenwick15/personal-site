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
Route::get('/contact', 'ContactController@render');
Route::get('/dataPopulate', 'DataController@populate');
Route::get('/adminHome', 'AdminController@index')->name('adminHome');
Route::post('/postArticle', 'AdminController@postArticle')->name('postArticle');

/*Route::post('/postArticle', function(Request $request) {
    return redirect()->action('AdminController@postArticle', ['request' => $request]);
})->name('postArticle');*/

Auth::routes();
