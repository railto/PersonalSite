<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListArticlesController;
use App\Http\Controllers\UsesPageController;
use App\Http\Controllers\ViewArticleController;
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

Route::get('/', IndexController::class)->name('index');
Route::get('/uses', UsesPageController::class)->name('uses');
Route::get('/blog', ListArticlesController::class)->name('articles.list');
Route::get('/blog/{article}', ViewArticleController::class)->name('articles.view');
