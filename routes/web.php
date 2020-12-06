<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'App\Http\Controllers\PagesController@index')->name('index');
Route::get('/uses', 'App\Http\Controllers\PagesController@uses')->name('uses');
