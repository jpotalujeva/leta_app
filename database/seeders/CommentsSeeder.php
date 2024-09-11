<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            'comment' => 'What is the theme of escape room? Is it frightening/scary?',
            'post_id' => 2,
            'user_id' => 3
        ]);

         DB::table('comments')->insert([
            'comment' => 'I am a developer for quite some time now,since 2010 people 
            are always assuming that php is going to day any day. And we are still here :) ',
            'post_id' => 4,
            'user_id' => 1
        ]);

          DB::table('comments')->insert([
            'comment' => 'When did GoLang firstly appeared? ',
            'post_id' => 4,
            'user_id' => 2
        ]);


         DB::table('comments')->insert([
            'comment' => 'Read some of those from the list. Useful',
            'post_id' => 1,
            'user_id' => 3
        ]);
    }
}