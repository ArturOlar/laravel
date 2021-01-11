<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    // все теги
    public function allTags()
    {
        return view('user.tag.all-tags', ['allTags' => Tag::all()]);
    }

    // все новости одного тега
    public function oneTag($slug)
    {
        $tag = Tag::where('slug', $slug)->get();
        $title = $tag[0]['title'];
        return view('user.news.all-news', [
            'title' => "Все новости по тегу \"$title\"",
            'allNews' => $tag[0]->news()->paginate(20)
        ]);
    }
}
