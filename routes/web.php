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

Route::get('/home', 'HomeController@index');


Route::get('/media', 'MediaController@index');

<<<<<<< HEAD
Route::get('/UIelements', 'UiController@index');
=======

Route::get('ui-elements', "UIElementsController@index");
>>>>>>> 142cc534121a3998cd6d51f0a9529ffdc346395d
