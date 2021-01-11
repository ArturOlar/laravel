<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\ParserRBC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Carbon\Carbon;

class ParserNewsru extends Parser
{
    // парсер
    public function parser()
    {
        $links = NewsResources::where('id_name_site', '4')->get();

        // парсим сайта
        for ($i = 0; $i < count($links); $i++) {
            $xml = XmlParser::load($links[$i]->url_resource);
            $site = 'Newsru';
            $allNews = $xml->parse([
                'news' => ['uses' => 'channel.item[guid,title,description,category,enclosure::url]'],
            ]);

            // сохраняем автора и получаем id автора
            $authorId = $this->checkAuthor($site);

            foreach ($allNews as $news) {
                foreach ($news as $oneNews) {
                    try {
                        $oneNews['fulltext'] = $oneNews['description'];
                        $oneNews['description'] = mb_strimwidth($oneNews['fulltext'], 0, 100, "...");

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
}
