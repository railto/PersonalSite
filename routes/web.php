<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListArticlesController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\UsesPageController;
use App\Http\Controllers\ViewArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/uses', UsesPageController::class)->name('uses');
Route::get('/blog', ListArticlesController::class)->name('articles.list');
Route::get('/blog/{article}', ViewArticleController::class)->name('articles.view');
Route::get('/rss', RssController::class)->name('feed.rss');
