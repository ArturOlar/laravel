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
        return view('user.category.all-categories', [
            'allCategories' => Category::all()
        ]);
    }

    // одна новость
    public function oneCategory($id)
    {
        return view('user.category.one-category', [
            'newsFromCategory' => News::where('id_category', $id)->paginate(6),
            'category' => Category::find($id)
        ]);
    }
}
