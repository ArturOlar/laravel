<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // все новости
    public function allCategories()
    {
        // категории и теги для навбара
        $categories = Category::take(6)->get();
        $tags = Tag::take(15)->get();

        // новости для бокового меню
        $newsByStatus = News::newsByStatus();

        $allCategories = Category::all();
        
        return view('user.category.all-categories', [
            'categories' => $categories,
            'tags' => $tags,
            'newsByStatus' => $newsByStatus,
            'allCategories' => $allCategories
        ]);
    }

    // одна новость
    public function oneCategory($id)
    {
        // категории и теги для навбара
        $categories = Category::take(6)->get();
        $tags = Tag::take(15)->get();

        // новости для бокового меню
        $newsByStatus = News::newsByStatus();

        $newsFromCategory = Category::find($id);

        return view('user.category.one-category', [
            'categories' => $categories,
            'tags' => $tags,
            'newsByStatus' => $newsByStatus,
            'newsFromCategory' => $newsFromCategory
        ]);
    }
}
