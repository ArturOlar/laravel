<?php

namespace App\Http\Controllers\User;

use App\Models\News;
use App\Models\NewsStatus;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    // все новости по определенному статусу
    public function allNewsByStatus($slug)
    {
        $status = Status::where('slug', $slug)->get();
        $title = $status[0]['title'];
        return view('user.news.all-news', [
            'title' => "Все новости по статусу \"$title\"",
            'allNews' => $status[0]->news()->paginate(20)
        ]);
    }
}
