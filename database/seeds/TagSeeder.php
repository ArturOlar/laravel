<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert($this->getData());
    }

    private $tags = [
        'мир',
        '2020',
        'новый_год',
        'php',
        'javascript',
        'футбол',
        'гривна',
        'долар',
        'евро',
        'валюта'
    ];

    private function getData()
    {
        $tagsView = DB::select('SELECT id_status FROM tag_status_view');
        $data = [];
        $k = 0;
        for ($i = 0; $i < count($this->tags); $i++){
            if ($k == 6) {
                $k = 0;
            };
            $data[] = [
                'title' => '#' . $this->tags[$i],
                'id_status_view' => $tagsView[$k]->id_status,
                'slug' => \App\Models\News::cutTextAndMakeSlug($this->tags[$i])
            ];
            $k++;
        }
        return $data;
    }
}
