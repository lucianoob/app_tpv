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

Route::group(array('prefix' => '/'), function() {
    Route::get('/', function () {
        return response()->json(['message' => 'App TPV API', 'status' => 'Connected']);;
    });
    Route::resource('products', 'ProductsController');
    Route::get('sheets', 'SheetsController@index')->name('sheets.index');
    Route::get('sheets/{sheet}', 'SheetsController@show')->name('sheets.show');
});
