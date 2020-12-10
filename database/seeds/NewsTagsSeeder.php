<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_tag')->insert($this->getData());
    }

    private function getData()
    {
        $tagsId = DB::select('SELECT id_tag FROM tags');
        $newsId = DB::select('SELECT id_news FROM news');

        $data = [];
        for ($i = 0; $i < count($newsId); $i++){
            $count = array_rand([1, 3]);

            for ($k = 0; $k <= $count; $k++){
                $id = array_rand($tagsId); // получаем рандомно id тега

                if (isset($data[$i])) {

                    if ($data[$i]['id_tag'] - 1 == $tagsId[$id]->id_tag) {
                        break;
                    }

                } else {
                    $data[] = [
                        'id_tag' => $tagsId[$id]->id_tag,
                        'id_news' => $newsId[$i]->id_news
                    ];
                }
            }
        }
        return $data;
    }
}
