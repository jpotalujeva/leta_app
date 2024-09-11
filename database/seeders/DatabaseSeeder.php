<?php

namespace Database\Seeders;

use Database\Seeders\CategoriesSeeder;
use Database\Seeders\CommentsSeeder;
use Database\Seeders\PostsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            PostsSeeder::class,
            CommentsSeeder::class
        ]);
    }
}