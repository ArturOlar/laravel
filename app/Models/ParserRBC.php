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

class ParserRBC extends Parser
{
    // добавляем в описание новости, в img текст 'src="https://www.rbc.ua'
    private function addCorrectImgLink($allNews)
    {
        $i = 0;
        foreach ($allNews as $news) {
            foreach ($news as $oneNews) {
                if (preg_match('/(src="\/static)/', $oneNews['fulltext'])) {
                    $pattern = preg_replace('/(src=")/', 'src="https://www.rbc.ua', $oneNews['fulltext']);
                    $allNews['news'][$i]['fulltext'] = $pattern;
                }
                $i++;
            }
        }
        return $allNews;
    }

    // парсер
    public function parser()
    {
        $links = NewsResources::where('id_name_site', '2')->get();

        // парсим сайт
        for ($i = 0; $i < count($links); $i++) {
            $xml = XmlParser::load($links[$i]->url_resource);
            $site = 'РБК-Украина';
            $allNews = $xml->parse([
                'news' => ['uses' => 'channel.item[guid,title,description,fulltext,category,enclosure::url]'],
            ]);

            // добавляем в описание новости, в img текст 'src="https://www.rbc.ua'
            $allNews = $this->addCorrectImgLink($allNews);

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
}
