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

class ParserKorrespondent extends Parser
{
    protected $links = [
        'http://k.img.com.ua/rss/ru/worldabus.xml',
        'http://k.img.com.ua/rss/ru/cinema.xml',
        'http://k.img.com.ua/rss/ru/music.xml',
        'http://k.img.com.ua/rss/ru/culture.xml',
        'http://k.img.com.ua/rss/ru/deti.xml',
        'http://k.img.com.ua/rss/ru/vibory2019.xml',
        'http://k.img.com.ua/rss/ru/space.xml',
        'http://k.img.com.ua/rss/ru/basketball.xml',
        'http://k.img.com.ua/rss/ru/chess.xml',
        'http://k.img.com.ua/rss/ru/hokey.xml',
        'http://k.img.com.ua/rss/ru/motors.xml',
        'http://k.img.com.ua/rss/ru/travel.xml'
    ];

    // парсер
    public function parser()
    {
        // парсим сайта
        for ($i = 0; $i < count($this->links); $i++) {
            $xml = XmlParser::load($this->links[$i]);
            $site = 'Корреспондент';
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
