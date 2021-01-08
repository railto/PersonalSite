<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * @return ArticleCollection
     */
    public function index(): ArticleCollection
    {
        $articles = Article::orderBy('published_at', 'desc')->get();

        return new ArticleCollection($articles);
    }
}
