<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('ui-elements/getElement', 'UIElementsController@getElement');
Route::post('ui-elements/saveElement', 'UIElementsController@saveElement');
Route::get('ui-elements/getAllElements', 'UIElementsController@getAllElements');
Route::get('ui-elements/syncElements', 'UIElementsController@syncElements');
