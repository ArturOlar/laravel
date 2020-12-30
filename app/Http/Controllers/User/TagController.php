<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function oneTag($id)
    {
        return view('user.tag.one-tag', [
            'newsByTag' => Tag::find($id)
        ]);
    }
}
