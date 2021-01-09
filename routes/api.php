<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/newsletter/subscribe', 'App\Http\Controllers\NewsletterController@subscribe')->name('newsletter.subscribe');

Route::get('/articles', 'App\Http\Controllers\Api\ArticlesController@index');
Route::post('/articles', 'App\Http\Controllers\Api\ArticlesController@store');
Route::get('/articles/{article}','App\Http\Controllers\Api\ArticlesController@show');
Route::put('/articles/{article}', 'App\Http\Controllers\Api\ArticlesController@update');
Route::delete('/articles/{article}', 'App\Http\Controllers\Api\ArticlesController@destroy');
