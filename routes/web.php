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
//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

/* ---------------------------- Products ----------------------------------- */
Route::group(['prefix' => 'products'], function() {
	Route::get('/', array('as' => 'products', 'uses' => 'ProductController@index'));
	Route::get('add/', array('as' => 'products/add', 'uses' => 'ProductController@add'));
    Route::post('create/', array('uses' => 'ProductController@create'));
    Route::get('edit/{id}', array('as' => 'products/edit', 'uses' => 'ProductController@edit'));
    Route::post('update/{id}', array('uses' => 'ProductController@update'));
    Route::get('delete/{id}', array('as' => 'products/delete', 'uses' => 'ProductController@delete'));
    Route::get('view/{id}', array('as' => 'products/view', 'uses' => 'ProductController@view'));
});
/* ---------------------------- ./Products ----------------------------------- */

/* ---------------------------- Frontend ----------------------------------- */
Route::get('productview/{id}', array('as' => 'productview', 'uses' => 'ProductController@productview'));
Route::post('placebid/{id}', array('uses' => 'ProductController@placebid'));
/* ---------------------------- ./Frontend ----------------------------------- */
