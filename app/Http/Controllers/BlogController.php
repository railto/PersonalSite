<?php

namespace App\Http\Controllers;

use App\Models\Article;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::where('published_at', '<', date("Y-m-d H:i:s"))->orderBy('published_at', 'desc')->get();

        return view('blog.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        return view('blog.article', ['article' => $article]);
    }
}
