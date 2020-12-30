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

class Parser112 extends Parser
{
    protected $links = [
        'https://112.ua/rss/politika/index.rss',
        'https://112.ua/rss/ekonomika/index.rss',
        'https://112.ua/rss/novosti-kanala/channel.rss?type=index',
        'https://112.ua/rss/sport/index.rss',
        'https://112.ua/rss/kiev/index.rss',
        'https://112.ua/rss/mir/index.rss',
        'https://112.ua/rss/avarii-chp/index.rss',
    ];

    // парсер
    public function parser()
    {
        // парсим сайта
        for ($i = 0; $i < count($this->links); $i++) {
            $xml = XmlParser::load($this->links[$i]);
            $site = 'Новости-112';
            $allNews = $xml->parse([
                'news' => ['uses' => 'channel.item[guid,title,description,fulltext,category,enclosure::url]'],
            ]);

            // сохраняем автора и получаем id автора
            $authorId = $this->checkAuthor($site);

            foreach ($allNews as $news) {
                foreach ($news as $oneNews) {
                    // сохраянем категорию и получаем id категории
                    $categoryId = $this->checkCategory($oneNews);

                    // сохраняем новость если ее нет
                    $this->checkNews($oneNews, $categoryId, $authorId);
                }
            }
        }
    }
}
