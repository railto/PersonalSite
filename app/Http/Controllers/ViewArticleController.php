<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ViewArticleController extends Controller
{
    public function __invoke(Article $article): View
    {
        return view('articles.view', ['article' => $article]);
    }
}
