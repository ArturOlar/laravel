<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;
use App\Models\News as ModelNews;
use App\Models\NewsImage;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Carbon\Carbon;

abstract class Parser extends Model
{
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
            $categoryId = Category::create([
                'title' => $oneNews['category'],
                'slug' => News::cutTextAndMakeSlug($oneNews['category'])
            ]);
            return $categoryId;
        }
    }

    // сохраняем новость (если ее нет)
    protected function checkNews($oneNews, $categoryId, $authorId)
    {
        if (!News::where('guid', $oneNews['guid'])->exists()) {
            News::create([
                'guid' => $oneNews['guid'],
                'id_category' => $categoryId->id_category,
                'image_url' => $oneNews['enclosure::url'],
                'slug' => ModelNews::cutTextAndMakeSlug($oneNews['title']),
                'title' => $oneNews['title'],
                'spoiler' => $oneNews['description'],
                'content' => $oneNews['fulltext'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_author' => $authorId->id_author
            ]);
            return;
        }
    }

    protected abstract function parser();
}
