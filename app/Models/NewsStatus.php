<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NewsStatus extends Model
{
    protected $table = 'news_status';
    protected $fillable = ['id_news', 'id_status'];

    // создать статуси к новой новости
    public static function createStatusesForNews(Request $request, $id)
    {
        if (!is_null($request->id_status)) {
            for ($i = 0; $i < count($request->id_status); $i++) {
                NewsStatus::create([
                    'id_news' => $id,
                    'id_status' => $request->id_status[$i]
                ]);
            }
        }
        return;
    }
    
    // оновить статусы конкретной новости
    public static function updateStatusesForNews(Request $request, $id)
    {
        self::deleteStatusesForNews($id);
        self::createStatusesForNews($request, $id);
        return;
    }

    // удалить статусы конкретной новосте
    public static function deleteStatusesForNews($id)
    {
        $count = NewsStatus::select('id_news')->where('id_news', $id)->get();
        for ($i = 0; $i < count($count); $i++) {
            NewsStatus::where('id_news', $id)->delete();
        }
        return;
    }
}
