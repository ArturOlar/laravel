<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('review_status')->insert($this->getData());
    }

    private $statuses = ['новые', 'опубликованые', 'отмененные'];

    private function getData()
    {
        $data = [];
        for ($i = 0; $i < count($this->statuses); $i++){
            $data[] = ['status' => $this->statuses[$i]];
        }
        return $data;
    }
}
