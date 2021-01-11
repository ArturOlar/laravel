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
        'новости дня',
        'новые',
        'самые читаемые',
        'важное'
    ];

    private function getData()
    {
        $data = [];
        for ($i = 0; $i < count($this->statusArray); $i++) {
            $data[] = [
                'title' => $this->statusArray[$i],
                'slug' => \App\Models\News::cutTextAndMakeSlug($this->statusArray[$i])
            ];
        }
        return $data;
    }
}
