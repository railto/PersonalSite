<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewArticleRequest;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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

    /**
     * @param StoreNewArticleRequest $request
     * @return Response
     */
    public function store(StoreNewArticleRequest $request): Response
    {
        $article = Article::create([
            'title' => $request->get('title'),
            'slug' => str::slug($request->get('title')),
            'content' => $request->get('content'),
            'published_at' => $request->get('published_at'),
        ]);

        return response(new ArticleResource($article), 201);
    }

    /**
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }
}
