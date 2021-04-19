<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Response;

class RssController extends Controller
{
    public function __invoke(): Response
    {
        $articles = Article::whereNotNull('published_at')->orderBy('published_at', 'desc')->get();

        return response(view('rss', ['articles' => $articles]), 200)->header('Content-Type', 'text/xml');
    }
}
