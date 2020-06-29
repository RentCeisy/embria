<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'namespace' => 'App',
    'middleware' => 'auth'
], function () {
    Route::group([
        'prefix' => 'home'
    ], function() {
        Route::get('/', 'IndexController@index');
        Route::get('/news', 'IndexController@getNewsList');
    });

    Route::group([
        'prefix' => 'news'
    ], function() {
        Route::get('/{id}', 'IndexController@index')->where('id', '[0-9]+');
        Route::get('/edit/{id}', 'IndexController@index')->where('id', '[0-9]+');
        Route::post('/{id}/like', 'NewsController@updateLike')->where('id', '[0-9]+');
        Route::get('/data/{id}', 'NewsController@getNews')->where('id', '[0-9]+');
        Route::delete('/{id}', 'NewsController@deleteNews')->where('id', '[0-9]+');
        Route::post('/{id}', 'NewsController@saveNews')->where('id', '[0-9]+');


        Route::group([
            'prefix' => 'photo'
        ], function() {
            Route::post('/', 'NewsController@savePhoto');
            Route::delete('/{id}', 'NewsController@deletePhoto')->where('id', '[0-9]+');
        });
    });


});


