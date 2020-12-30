<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert($this->getData());
    }

    private function getData()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$oQwWQSrCMsx5Tjf7fVF/gOE3p6HLvTRpF6SE/BejVRg4l9TcvgxYG',
            'is_admin' => 1,
            'id_at_soc' => 0,
            'soc_type' => 0
        ];
    }
}
