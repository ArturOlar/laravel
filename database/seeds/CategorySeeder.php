<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private $categoryArray = [
        'Спорт',
        'Финансы',
        'Кино',
        'Музыка',
        'IT',
        'Политика',
        'Наука',
        'Экономика'
    ];

    private function getData()
    {
        $data = [];
        for ($i = 0; $i < count($this->categoryArray); $i++) {
            $data[] = [
                'title' => $this->categoryArray[$i]
            ];
        }
        return $data;
    }
}
