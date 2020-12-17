<?php

namespace App\Http\Controllers\User;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function allNewsByStatus($id)
    {
        return view('user.newsByStatus.news-by-status', [
            'allNewsByStatus' => Status::where('id_status', $id)->get()
        ]);
    }
}
