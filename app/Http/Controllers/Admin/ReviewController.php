<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    // новые отзывы
    public function newReview()
    {
        $reviews = Review::where('id_status', '1')->get();
        return view('admin.review.new-review', [
            'reviews' => $reviews
        ]);
    }
    
    // опубликованные отзывы
    public function publishReview()
    {
        $reviews = Review::where('id_status', '2')->get();
        return view('admin.review.publish-review', [
            'reviews' => $reviews
        ]);
    }
    
    // отмененные отзывы
    public function canceledReview()
    {
        $reviews = Review::where('id_status', '3')->get();
        return view('admin.review.canceled-review', [
            'reviews' => $reviews
        ]);
    }

    // изменить статус отзыва на "опубликован"
    public function addToPublishReview(Request $request)
    {
        Review::where('id_review', $request->id_review)->update([
            'id_status' => '2'
        ]);
        session()->flash('success', 'отзыв переведен в статус "опубликован"');
        return redirect()->back();
    }

    // изменить статус отзыва на "отмененный"
    public function addToCanceledReview(Request $request)
    {
        Review::where('id_review', $request->id_review)->update([
            'id_status' => '3'
        ]);
        session()->flash('success', 'отзыв переведен в статус "отменен"');
        return redirect()->back();
    }
}
