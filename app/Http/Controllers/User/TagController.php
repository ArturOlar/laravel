<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function allTags()
    {

    }

    public function oneTag($id)
    {
        // категории и теги для навбара
        $categories = Category::take(6)->get();
        $tags = Tag::take(15)->get();

        // новости для бокового меню
        $newsByStatus = News::newsByStatus();

        $newsByTag = Tag::find($id);
        return view('user.tag.one-tag', [
            'categories' => $categories,
            'tags' => $tags,
            'newsByStatus' => $newsByStatus,
            'newsByTag' => $newsByTag
        ]);
    }

}
