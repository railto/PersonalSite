<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ListArticlesController extends Controller
{
    public function __invoke(): View
    {
        $articles = Article::whereNotNull('published_at')->orderBy('published_at', 'desc')->paginate(10);

        return view('articles.list', ['articles' => $articles]);
    }
}
