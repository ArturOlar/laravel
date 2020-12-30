<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private $images = [
        'unnamed.jpg',
        'TIE-OG-Mobile-1x1.jpg',
        'images.png',
        'icon-70-512.png',
        'gazety-nadpis-novosti.jpg',
        'ff6b1fba-1cac-11eb-99d6-deeedd63f648_image_hires_094745.jpg',
        'EDqLlT1XkAoAFkU.jpg',
        'depositphotos_5147118-stock-photo-news-concept.jpg',
        '755903006023960.jpg'
    ];
    
    private function getData()
    {
        $faker = Faker\Factory::create('ru_RU');
        $authorsId = DB::select('SELECT id_author FROM author');
        $data = [];
        for ($i = 0; $i < 50; $i++){
            $id = array_rand($authorsId);
            $title = $faker->realText(rand(50, 100));
            $data[] = [
                'id_category' => rand(1, 8),
                'image_url' => 'images/' . $this->images[array_rand($this->images)],
                'slug' => \App\Models\News::cutTextAndMakeSlug($title),
                'title' => $title,
                'spoiler' => $faker->realText(rand(100, 250)),
                'content' => $faker->realText(rand(500, 5000)),
                'id_author' => $authorsId[$id]->id_author,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        return $data;
    }
}
