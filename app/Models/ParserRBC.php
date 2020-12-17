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

class ParserRBC extends Parser
{
    protected $links = [
        'https://www.rbc.ua/static/rss/ukrnet.politics.rus.rss.xml',
        'https://www.rbc.ua/static/rss/ukrnet.economic.rus.rss.xml',
        'https://www.rbc.ua/static/rss/ukrnet.accidents.rus.rss.xml',
        'https://www.rbc.ua/static/rss/ukrnet.culture.rus.rss.xml',
        'https://www.rbc.ua/static/rss/ukrnet.sport.rus.rss.xml',
        'https://www.rbc.ua/static/rss/digests.rus.rss.xml',
    ];

    // парсер
    public function parser()
    {
        // парсим сайта
        for ($i = 0; $i < count($this->links); $i++){
            $xml = XmlParser::load($this->links[$i]);
            $site = 'РБК-Украина';
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
