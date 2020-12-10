<?php

use Illuminate\Database\Seeder;

class NewsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_status')->insert($this->getData());
    }

    private function getData()
    {
        $statusId = DB::select('SELECT id_status FROM status');
        $newsId = DB::select('SELECT id_news FROM news');

        $data = [];
        for ($i = 0; $i < count($newsId); $i++){
            $count = array_rand([1, 3]);

            for ($k = 0; $k <= $count; $k++){
                $id = array_rand($statusId); // получаем рандомно id тега

                if (isset($data[$i])) {

                    if ($data[$i]['id_status'] - 1 == $statusId[$id]->id_status) {
                        break;
                    }

                } else {
                    $data[] = [
                        'id_status' => $statusId[$id]->id_status,
                        'id_news' => $newsId[$i]->id_news
                    ];
                }
            }
        }
        return $data;
    }
}
