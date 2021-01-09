<?php

use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::feeds();
Route::get('/', 'App\Http\Controllers\PagesController@index')->name('index');
Route::get('/uses', 'App\Http\Controllers\PagesController@uses')->name('uses');
Route::get('/blog', 'App\Http\Controllers\BlogController@index')->name('blog.index');
Route::get('/blog/{article}', 'App\Http\Controllers\BlogController@show')->name('blog.article');

Route::get('/logout', LogoutController::class);

Route::get('/admin/{any?}', 'App\Http\Controllers\Admin\AdminController@index')->where('any', '(.*)')->middleware(['auth:web']);
