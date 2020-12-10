<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function createReview(StoreReviewRequest $request)
    {
        Review::createReview($request);
        return;
    }
}
