<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $articles = Article::where('published_at', '<', date("Y-m-d H:i:s"))->orderByDesc('published_at')->limit(3)->get();

        return view('index', ['articles' => $articles]);
    }
}
