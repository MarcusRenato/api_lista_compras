<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->name('api.')->group(function () {
    Route::prefix('lists')->group(function () {
        Route::get('/', 'ListbuyController@index')->name('list_index');
        Route::get('/{id}', 'ListbuyController@show')->name('single_list');

        Route::post('/', 'ListbuyController@store')->name('store_list');
        Route::put('/update/{id}', 'ListbuyController@update')->name('update_list');

        Route::delete('/destroy/{id}', 'ListbuyController@destroy')->name('destroy_list');
    });
});

Route::namespace('Api')->name("api.")->group(function(){
    Route::prefix('list_products')->group(function(){
        Route::get('/', 'ListProductController@index')->name('index_products');
        Route::get('/show/{id}', 'ListProductController@show')->name('show_product');
        Route::get('/search/{name}', 'ListProductController@search')->name('search_product');

        Route::post('/store', 'ListProductController@store')->name('store_product');
        Route::put('/update/{id}', 'ListProductController@update')->name('update_product');

        Route::delete('/destroy/{id}', 'ListProductController@destroy')->name('destroy_product');
    });
});