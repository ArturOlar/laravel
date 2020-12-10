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

    private function getData()
    {
        $faker = Faker\Factory::create('ru_RU');
        $authorsId = DB::select('SELECT id_author FROM author');
        $data = [];
        for ($i = 0; $i < 50; $i++){
            $id = array_rand($authorsId);
            $data[] = [
                'id_category' => rand(1, 8),
                'title' => $faker->realText(rand(50, 100)),
                'spoiler' => $faker->realText(rand(100, 250)),
                'content' => $faker->realText(rand(500, 2000)),
                'content_second' => $faker->realText(rand(500, 2000)),
                'id_author' => $authorsId[$id]->id_author,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        return $data;
    }
}
