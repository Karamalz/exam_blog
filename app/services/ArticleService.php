<?php

namespace App\services;

use App\repositories\ArticleRepository;

class ArticleService
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function index()
    {
        return $this->articleRepo->getArticleList();
    }

    public function store($request)
    {
        return $this->articleRepo->storeArticle($request);
    }

    public function show($articleId)
    {
        return $this->articleRepo->getArticle($articleId);
    }
    
}