<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\Http\Requests\postArticleRequest;

class ArticleController extends Controller
{
    public function postArticle(postArticleRequest $request) {
        Data::updateOrCreate([
            'headline' => $request->headline,
        ],
        [
            'name' => 'Article',
            'type' => 'Article',
            'caption' => $request->caption,
            'source_update_time' => date("Y-M-d H:i:s"),
        ]);
        return redirect('/');
    }
}
