<?php

use Illuminate\Database\Seeder;

class NewsResources extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('news_resources')->insert($this->getData());
    }

    private $links = [
        'https://112.ua/rss/politika/index.rss' => '112',
        'https://112.ua/rss/ekonomika/index.rss' => '112',
        'https://112.ua/rss/novosti-kanala/channel.rss?type=index' => '112',
        'https://112.ua/rss/sport/index.rss' => '112',
        'https://112.ua/rss/kiev/index.rss' => '112',
        'https://112.ua/rss/mir/index.rss' => '112',
        'https://112.ua/rss/avarii-chp/index.rss' => '112',
        'http://k.img.com.ua/rss/ru/worldabus.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/cinema.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/music.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/culture.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/deti.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/vibory2019.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/space.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/basketball.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/chess.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/hokey.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/motors.xml' => 'rbc',
        'http://k.img.com.ua/rss/ru/travel.xml' => 'rbc',
        'https://www.rbc.ua/static/rss/ukrnet.politics.rus.rss.xml' => 'korrespondent',
        'https://www.rbc.ua/static/rss/ukrnet.economic.rus.rss.xml' => 'korrespondent',
        'https://www.rbc.ua/static/rss/ukrnet.accidents.rus.rss.xml' => 'korrespondent',
        'https://www.rbc.ua/static/rss/ukrnet.culture.rus.rss.xml' => 'korrespondent',
        'https://www.rbc.ua/static/rss/ukrnet.sport.rus.rss.xml' => 'korrespondent',
        'https://www.rbc.ua/static/rss/digests.rus.rss.xml' => 'korrespondent',
        'https://rss.newsru.com/russia' => 'Newsru',
        'https://rss.newsru.com/world' => 'Newsru',
        'https://rss.newsru.com/finance' => 'Newsru',
        'https://rss.newsru.com/sport' => 'Newsru',
        'https://rss.newsru.com/cinema' => 'Newsru',
        'https://rss.newsru.com/realty' => 'Newsru',
        'https://rss.newsru.com/auto' => 'Newsru',
        'https://rss.newsru.com/hitech' => 'Newsru',
    ];

    private function getData()
    {
        $sities = \Illuminate\Support\Facades\DB::select('SELECT id, name_site FROM news_resource_sities');

        $data = [];
        foreach ($this->links as $link => $site) {

            for ($i = 0; $i < count($sities); $i++) {
                if ($site == $sities[$i]->name_site) {
                    $idSite = $sities[$i]->id;
                }
            }

            $data[] = [
                'url_resource' => $link,
                'id_name_site' => $idSite
            ];
        }
        return $data;
    }
}
