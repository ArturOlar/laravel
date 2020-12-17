<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    // все новости
    public function allNews(Request $request)
    {
        if($request->ajax()){
            return $request;
        }

        return view('user.home.home', [
            'allNews' => News::paginate(20),
        ]);
    }

    // одна новость
    public function oneNews($id)
    {
        return view('user.news.one-news', [
            'news' => News::find($id)
        ]);
    }
}
