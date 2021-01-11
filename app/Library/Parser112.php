<?php

namespace App\Library;

use App\Models\NewsResources;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Carbon\Carbon;

class Parser112 extends Parser
{
    // парсер
    public function parser($link)
    {
        // парсим сайта
        $xml = XmlParser::load($link);
        $site = 'Новости-112';
        $allNews = $xml->parse([
            'news' => ['uses' => 'channel.item[guid,title,description,fulltext,category,enclosure::url]'],
        ]);

        // сохраняем автора и получаем id автора
        $authorId = $this->checkAuthor($site);

        foreach ($allNews as $news) {
            foreach ($news as $oneNews) {
                try {
                    // сохраянем категорию и получаем id категории
                    $categoryId = $this->checkCategory($oneNews);

                    // сохраняем новость если ее нет
                    $this->checkNews($oneNews, $categoryId, $authorId);
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
    }
}
