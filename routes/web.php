<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/home', 'HomeController@index');

    Route::get('products/getProducts','ProductController@getProducts');
    Route::resource('products','ProductController');
    
    Route::get('product-types/getProductTypes','ProductTypeController@getProductTypes');
    Route::resource('product-types','ProductTypeController');

    Route::get('/media', 'MediaController@index');
    Route::post('/media/upload', 'MediaController@upload');

    Route::get('ui-elements', "UIElementsController@index");
});

