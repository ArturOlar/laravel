<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Carbon\Carbon;

class Parser extends Model
{
    protected $links = [];

    // сохраняем автора (если его нет в таблице) и получаем id автора
    protected function checkAuthor($site)
    {
        if (Author::where('name', $site)->exists()) {
            $authorId = Author::where('name', $site)->get();
            $authorId = Author::find($authorId[0]->id_author);
            return $authorId;
        } else {
            $authorId = Author::create(['name' => $site]);
            return $authorId;
        }
    }

    // сохраняем категорию (если ее нет в таблице) и получаем id категории
    protected function checkCategory($oneNews)
    {
        if (Category::where('title', $oneNews['category'])->exists()) {
            $categoryId = Category::where('title', $oneNews['category'])->get();
            $categoryId = Category::find($categoryId[0]->id_category);
            return $categoryId;
        } else {
            $categoryId = Category::create(['title' => $oneNews['category']]);
            return $categoryId;
        }
    }

    // сохраняем новость (если ее нет)
    protected function checkNews($oneNews, $categoryId, $authorId)
    {
//        dd($oneNews['guid']);
        if (!News::where('guid', $oneNews['guid'])->exists()) {
            $newNews = News::create([
                'guid' => $oneNews['guid'],
                'id_category' => $categoryId->id_category,
                'title' => $oneNews['title'],
                'spoiler' => $oneNews['description'],
                'content' => $oneNews['fulltext'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_author' => $authorId->id_author
            ]);
            NewsImage::createImagesForNewsParser($oneNews['enclosure::url'], $newNews->id_news);
            return;
        }
    }
}
