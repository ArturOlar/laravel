<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author')->insert($this->getData());
    }

    private $authorsArray = [
        'Иван Иванов',
        'Марина Степанова',
        'Петр Петров',
        'Василий Васильев',
        'Степан Верчук',
        'Григорий Мишин',
        'Инга Козуб',
        'Иванна Дворницкая',
        'Михаил Кожух',
        'Иван Чоботар',
    ];

    private function getData()
    {
        $data = [];
        foreach ($this->authorsArray as $name) {
            $data[] = [
                'name' => $name
            ];
        }
        return $data;
    }
}
