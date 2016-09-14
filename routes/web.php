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
    
    Route::get('/product-types', 'ProductTypeController@index');
    
    Route::get('/media', 'MediaController@index');

    Route::get('ui-elements', "UIElementsController@index");
});

Route::post('product-types/getProductTypeModal', 'ProductTypeController@getProductTypeModal');
Route::get('product-types/getProductTypes','ProductTypeController@getProductTypes');
Route::resource('product-types','ProductTypeController');