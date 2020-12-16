<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PagesController extends Controller
{
    public function index()
    {
        $articles = Article::where('published_at', '<', date("Y-m-d H:i:s"))->orderByDesc('published_at')->limit(3)->get();

        return view('index', ['articles' => $articles]);
    }

    public function uses()
    {
        return view('uses');
    }
}
