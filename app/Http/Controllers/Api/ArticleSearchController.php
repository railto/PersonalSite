<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleSearchController extends Controller
{
    /**
     * @param Request $request
     * @return ArticleCollection
     */
    public function __invoke(Request $request): ArticleCollection
    {
        $articles = Article::search($request->get('query'))->get();

        return new ArticleCollection($articles);
    }
}
