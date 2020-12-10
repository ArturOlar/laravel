<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    // все новости
    public function allNews()
    {
        // категории и теги для навбара
        $categories = Category::take(6)->get();
        $tags = Tag::take(15)->get();
        
        // новости для бокового меню
        $newsByStatus = News::newsByStatus();

        $allNews = News::paginate(10);
        return view('user.home.home', [
            'categories' => $categories,
            'tags' => $tags,
            'newsByStatus' => $newsByStatus,
            'allNews' => $allNews
        ]);
    }

    // одна новость
    public function oneNews($id)
    {
        // категории и теги для навбара
        $categories = Category::take(6)->get();
        $tags = Tag::take(15)->get();

        // новости для бокового меню
        $newsByStatus = News::newsByStatus();

        $news = News::find($id); // получаем одну новость
        return view('user.news.one-news', [
            'categories' => $categories,
            'tags' => $tags,
            'newsByStatus' => $newsByStatus,
            'news' => $news
        ]);
    }
}
