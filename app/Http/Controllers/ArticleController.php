<?php

namespace App\Http\Controllers;

use App\services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allArticles = $this->articleService->index();
        if($allArticles->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'There is no article!',
                'data' => '',
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'Query success',
            'data' => $allArticles,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|alpha_dash|max:191',
            'content' => 'required|alpha_dash|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => '',
            ], 401);
        }

        $storeArticle = $this->articleService->store($request);

        if(!$storeArticle) {
            return response()->json([
                'success' => false,
                'message' => 'failed to store article',
                'data' => '',
            ], 401);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Store article success',
                'data' => '',
            ], 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($articleId)
    {
        if(!is_numeric($articleId)) {
            return response()->json([
                'success' => false,
                'message' => 'We can not understand this articleId',
                'data' => '',
            ], 422);
        }

        $showArticle = $this->articleService->show($articleId);

        if($showArticle == null) {
            return response()->json([
                'success' => true,
                'message' => 'We can not find this article',
                'data' => '',
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Query success',
                'data' => $showArticle,
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
