<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // все категории
    public function allCategories()
    {
        return view('user.category.all-categories', ['allCategories' => Category::all()]);
    }

    // все новости одной категории
    public function oneCategory($slug)
    {
        $category = Category::where('slug', $slug)->get();
        $title = $category[0]['title'];
        return view('user.news.all-news', [
            'title' => "Все новости категории \"$title\"",
            'allNews' => News::where('id_category', $category[0]['id_category'])->paginate(15),
        ]);
    }
}
