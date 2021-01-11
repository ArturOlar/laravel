<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Review;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    // все новости
    public function allNews(Request $request)
    {
        return view('user.news.all-news', [
            'title' => 'Все новости',
            'allNews' => News::paginate(15)
        ]);
    }

    // одна новость
    public function oneNews($slug)
    {
        $news = News::where('slug', $slug)->get();
        $reviews = Review::where('id_news', $news[0]->id_news)->orderBy('created_at', 'desc')->get();

        return view('user.news.one-news', [
            'news' => $news[0],
            'reviews' => $reviews,
        ]);
    }

    // поиск новостей
    public function searchNews(Request $request)
    {
        if (empty($request->search)){
            return redirect('/');
        }

        $allNews = News::where('content', 'LIKE', "%{$request->search}%")->paginate(15);
        return view('user.news.search-news', [
            'allNews' => $allNews,
            'request' => $request->search
        ]);
    }
}
