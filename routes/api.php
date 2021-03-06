<?php

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

Route::post('login', 'AuthController@login');

Route::post('register', 'AuthController@register');

Route::post('logout', 'AuthController@logout')->middleware('jwt');

Route::group(['prefix' => 'article', 'middleware' => 'jwt'], function () {
    Route::get('/', 'ArticleController@index');

    Route::post('/store', 'ArticleController@store');

    Route::get('/{articleId}', 'ArticleController@show');
});
