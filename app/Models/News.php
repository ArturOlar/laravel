<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class News extends Model
{
    protected $primaryKey = 'id_news';
    protected $fillable = ['id_news', 'title', 'spoiler', 'content', 'content_second', 'id_category', 'id_author', 'guid'];

    // сохранить новую новость
    public static function createNews(Request $request)
    {
        $res = News::create([
            'title' => $request->title,
            'spoiler' => $request->spoiler,
            'content' => $request->content,
            'content_second' => $request->content_second,
            'id_category' => $request->id_category,
            'id_author' => $request->id_author
        ]);

        return $res->id_news;
    }

    // оновляем информацию о новосте
    public static function updateNews(Request $request, $id)
    {
        News::where('id_news', $id)->update([
            'title' => $request->title,
            'spoiler' => $request->spoiler,
            'content' => $request->content,
            'content_second' => $request->content_second,
            'id_category' => $request->id_category,
            'id_author' => $request->id_author
        ]);
    }

    // получаем по 3 новости для каждого статуса для бокового меню
    public static function newsByStatus()
    {
        $allNews = News::all();

        $data = [];
        foreach ($allNews as $news) {
            foreach ($news->statuses as $status) {
                if ($status->title_en == 'news_day') {
                    if (isset($data['news_day']) && count($data['news_day']) < 3) {
                        $data['news_day'][] = $news;
                    } elseif (!isset($data['news_day'])) {
                        $data['news_day'][] = $news;
                    }
                }
                if ($status->title_en == 'new') {
                    if (isset($data['new']) && count($data['new']) < 3) {
                        $data['new'][] = $news;
                    } elseif (!isset($data['new'])) {
                        $data['new'][] = $news;
                    }
                }
                if ($status->title_en == 'must_read') {
                    if (isset($data['must_read']) && count($data['must_read']) < 3) {
                        $data['must_read'][] = $news;
                    } elseif (!isset($data['must_read'])) {
                        $data['must_read'][] = $news;
                    }
                }
                if ($status->title_en == 'important') {
                    if (isset($data['important']) && count($data['important']) < 3) {
                        $data['important'][] = $news;
                    } elseif (!isset($data['important'])) {
                        $data['important'][] = $news;
                    }
                }
            }
        }
        return $data;
    }

    // связь с таблицей категорий
    public function category()
    {
        return $this->hasOne(Category::class, 'id_category', 'id_category');
    }

    // связь с таблицей авторов
    public function author()
    {
        return $this->belongsTo(Author::class, 'id_author', 'id_author');
    }

    // связь с таблицей изображений к новостям
    public function images()
    {
        return $this->hasMany(NewsImage::class, 'id_news', 'id_news');
    }

    // связь с таблицей отзывов
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_news', 'id_news');
    }

    // связь с таблицей тегов
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag', 'id_news', 'id_tag');
    }

    // связь с таблицей статусов новостей
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'news_status', 'id_news', 'id_status');
    }
}
