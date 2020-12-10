<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert($this->getData());
    }

    private $statusArray = [
        'новости дня' => 'news_day',
        'новые' => 'new',
        'самые читаемые' => 'must_read',
        'важное' => 'important'
    ];

    private function getData()
    {
        $data = [];
        foreach ($this->statusArray as $key => $value){
            $data[] = [
                'title' => $key,
                'title_en' => $value
            ];
        }
        return $data;
    }
}
