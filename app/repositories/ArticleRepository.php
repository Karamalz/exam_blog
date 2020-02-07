<?php

namespace App\repositories;

use App\Article;
use JWTAuth;


class ArticleRepository
{
    public function getArticleList()
    {
        return Article::all();
    }

    public function storeArticle($request)
    {
        return Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => JWTAuth::user()->id,
        ]);
    }

    public function getArticle($articleId)
    {
        return Article::where('id', $articleId)->first();
    }
}