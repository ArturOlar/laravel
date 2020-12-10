<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_image')->insert($this->getData());
    }

    private $images = [
        'images/Lh6B7hw5fBpRviMP1cExncCRjsn6AoEAKcjNYkBz.jpg',
        'images/1bav2Uk2Je0KDPmg1WiYJLZH73mDpSHu1tpO27Ix.jpg',
        'images/kZuj4Zb66tJrJNYn91W5Xxq65Dh7BYPThgh05UCS.jpg',
        'images/sJ9QZqnnhgUDHyQBl2sBWGViBJGRkMPuyGwPenOS.jpg',
        'images/2uEgTQYpcDQNv6J3xlEoyAFouG2Q4Y58QeTKxefE.jpg',
        'images/cCA2C35ZAaYwCnK2IZHptS6BurMRiii6Kgo9eJvg.png',
        'images/kQ0QTAe3sEdaWsriQYcqHrjwgisaHQLQ1q0YXfsK.png',
        'images/Af5NyTofdxN8nyiPNTwUDuoGDZsm5YzApaaggl77.jpg',
        'images/Ri0lRUEcNzsSN4wbsHyB05Yc0wqKJ0OYiq4RP1LT.jpg'
    ];

    private function getData()
    {
        $newsId = DB::select('SELECT id_news FROM news');

        $data = [];
        for ($i = 0; $i < count($newsId); $i++) {

            for ($k = 0; $k < 2; $k++) {
                $idImage = array_rand($this->images);

                $data[] = [
                    'id_news' => $newsId[$i]->id_news,
                    'image_url' => $this->images[$idImage]
                ];
            }
        }
        return $data;
    }
}
