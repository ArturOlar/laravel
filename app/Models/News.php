<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class News extends Model
{
    protected $primaryKey = 'id_news';
    protected $fillable = ['id_news', 'image_url', 'slug', 'title', 'spoiler', 'content', 'id_category', 'id_author', 'guid'];
    protected $visible = ['id_news', 'slug', 'title', 'spoiler', 'content', 'created_at', 'category', 'author', 'tags'];

    // сохранить новую новость из формы или парсера
    public static function createNews(Request $request)
    {
        if (is_null($request->file('image'))) {
            $path = '';
        } else {
            $path = $request->file('image')->store('public/images');
            $path = substr($path, 7);
        }

        $res = News::create([
            'slug' => News::cutTextAndMakeSlug($request->title),
            'title' => $request->title,
            'spoiler' => $request->spoiler,
            'content' => $request->content,
            'id_category' => $request->id_category,
            'image_url' => $path,
            'id_author' => $request->id_author
        ]);

        return $res->id_news;
    }
    
    // оновляем информацию о новосте
    public static function updateNews(Request $request, $id)
    {
        if (is_null($request->file('image'))) {
            $path = News::where('id_news', $id)->get();
            $path = $path[0]['image_url'];
        } else {
            $path = $request->file('image')->store('public/images');
            $path = substr($path, 7);
        }

        News::where('id_news', $id)->update([
            'slug' => News::cutTextAndMakeSlug($request->title),
            'title' => $request->title,
            'spoiler' => $request->spoiler,
            'content' => $request->content,
            'id_category' => $request->id_category,
            'image_url' => $path,
            'id_author' => $request->id_author
        ]);
        return;
    }

    // получаем по 3 новости для каждого статуса для бокового меню
    public static function newsByStatus()
    {
        $allNews = News::all();

        $data = [];
        foreach ($allNews as $news) {
            foreach ($news->statuses as $status) {
                if ($status->slug == 'novosti_dnya') {
                    if (isset($data['novosti_dnya']) && count($data['novosti_dnya']) < 3) {
                        $data['novosti_dnya'][] = $news;
                    } elseif (!isset($data['novosti_dnya'])) {
                        $data['novosti_dnya'][] = $news;
                    }
                }
                if ($status->slug == 'novye') {
                    if (isset($data['novye']) && count($data['novye']) < 3) {
                        $data['novye'][] = $news;
                    } elseif (!isset($data['novye'])) {
                        $data['novye'][] = $news;
                    }
                }
                if ($status->slug == 'samye_chitaemye') {
                    if (isset($data['samye_chitaemye']) && count($data['samye_chitaemye']) < 3) {
                        $data['samye_chitaemye'][] = $news;
                    } elseif (!isset($data['samye_chitaemye'])) {
                        $data['samye_chitaemye'][] = $news;
                    }
                }
                if ($status->slug == 'vazhnoe') {
                    if (isset($data['vazhnoe']) && count($data['vazhnoe']) < 3) {
                        $data['vazhnoe'][] = $news;
                    } elseif (!isset($data['vazhnoe'])) {
                        $data['vazhnoe'][] = $news;
                    }
                }
            }
        }
        return $data;
    }

    // вырезаем первые 5 слов (или меньше) из текста и делаем слаг
    public static function cutTextAndMakeSlug($titleRu)
    {
        $titleArrayRu = explode(" ", $titleRu);
        $length = count($titleArrayRu) < 10 ? count($titleArrayRu) : 10;

        for ($i = 0; $i < $length; $i++) {
            $newTitleArrayRu[] = $titleArrayRu[$i];
        }

        $titleRu = implode(" ", $newTitleArrayRu);
        $slug = Str::slug($titleRu, '_');

        return $slug;
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
