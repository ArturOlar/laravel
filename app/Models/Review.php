<?php

namespace App\Models;

use App\Http\Requests\StoreReviewRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Review extends Model
{
    protected $primaryKey = 'id_review';
    protected $table = 'review';
    protected $fillable = ['id_news', 'id_user', 'content', 'id_status'];
    protected $attributes = ['id_status' => '1'];

    // создать новость
    public static function createReview(StoreReviewRequest $request)
    {
        Review::create([
            'id_news' => $request->idNews,
            'id_user' => $request->idUser,
            'content' => $request->review
        ]);
        return;
    }

    // связь с таблицей пользователей
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}