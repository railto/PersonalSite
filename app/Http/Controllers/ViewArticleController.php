<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ViewArticleController extends Controller
{
    public function __invoke(Article $article): View
    {
        if ((is_null($article->published_at) || $article->published_at > now()) && auth()->guest()) {
            abort(404);
        }

        return view('articles.view', ['article' => $article]);
    }
}
