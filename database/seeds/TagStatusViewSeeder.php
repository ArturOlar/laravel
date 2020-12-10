<?php

use Illuminate\Database\Seeder;

class TagStatusViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_status_view')->insert($this->getData());
    }

    private $statusTag = [
        'badge badge-primary' => 'синий',
        'badge badge-secondary' => 'серый',
        'badge badge-success' => 'зеленый',
        'badge badge-danger' => 'желтый',
        'badge badge-warning' => 'красный',
        'badge badge-info' => 'голубой',
        'badge badge-light' => 'светло-серый'
    ];

    private function getData()
    {
        $data = [];

        foreach ($this->statusTag as $key => $value){
            $data[] = [
                'status_view' => $key,
                'status_view_ru' => $value
            ];
        }

        return $data;
    }
}
