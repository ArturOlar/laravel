<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ReviewStatusSeeder::class);
        $this->call(TagStatusViewSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(NewsStatusSeeder::class);
        $this->call(NewsTagsSeeder::class);
        $this->call(NewsResourcesSite::class);
        $this->call(NewsResources::class);
    }
}
