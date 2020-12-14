<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::where('published_at', '<', date("Y-m-d H:i:s"))->orderBy('published_at', 'desc')->simplePaginate(10);

        return view('blog.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        if (!$article->published_at || Carbon::parse($article->published_at)->greaterThan(Carbon::now())) {
            abort(404);
        }

        return view('blog.article', ['article' => $article]);
    }
}
