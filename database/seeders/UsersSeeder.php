<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jevgenija P',
            'email' => 'jp@example.com',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('tester'),
        ]);

        DB::table('users')->insert([
            'name' => 'Commentator',
            'email' => 'comment@master.com',
            'password' => Hash::make('commentDaily'),
        ]);

        DB::table('users')->insert([
            'name' => 'Terminator',
            'email' => 'term@mail.com',
            'password' => Hash::make('terminator'),
        ]);

        DB::table('users')->insert([
            'name' => 'Lady Bug',
            'email' => 'ask@fm.com',
            'password' => Hash::make('askladybug'),
        ]);
    }
}