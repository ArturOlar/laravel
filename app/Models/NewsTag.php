<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NewsTag extends Model
{
    protected $table = 'news_tag';
    protected $fillable = ['id_news', 'id_tag'];

    // создать теги к новой новости (через форму и парсер)
    public static function createTagsForNews(Request $request, $id)
    {
        if (!is_null($request->id_tags)) {
            for ($i = 0; $i < count($request->id_tags); $i++) {
                NewsTag::create([
                    'id_news' => $id,
                    'id_tag' => $request->id_tags[$i]
                ]);
            }
        }
        return;
    }

    // оновить теги конкретной новости
    public static function updateTagsForNews(Request $request, $id)
    {
        self::deleteTagsForNews($id);
        self::createTagsForNews($request, $id);
        return;
    }

    // удалить все теги конкретной новосте
    public static function deleteTagsForNews($id)
    {
        $count = NewsTag::select('id_news')->where('id_news', $id)->get();
        for ($i = 0; $i < count($count); $i++) {
            NewsTag::where('id_news', $id)->delete();
        }
        return;
    }
}
