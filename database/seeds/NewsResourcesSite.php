<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsResourcesSite extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_resource_sities')->insert($this->getData());
    }

    private $sities = [
        '112',
        'korrespondent',
        'rbc',
        'Newsru',
    ];

    private function getData()
    {
        $data = [];
        for ($i = 0; $i < count($this->sities); $i++) {
            $data[] = [
                'name_site' => $this->sities[$i],
            ];
        }
        return $data;
    }
}
