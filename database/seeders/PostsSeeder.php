<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use DateTime;
use App\Models\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'title' => 'PHP Related & Usefull books',
            'body' => 'Did you ever plan to learn back-end web development, but you were confused about where and how to start?  

            If this was the case, then you are at the right place. There are many languages like PHP, Java, Python, etc., which are used in back-end web development. But, in this article, you will find a way to learn back-end web development using PHP language. Before going to the topic, you should know what PHP is?

            PHP stands for a hypertext pre-processor and is used in web development to create a dynamic website. It is a simple and easy-to-learn open-source scripting language. It is also an object-oriented and interpreted language.  Here is the link to some books to discover: https://old.reddit.com/r/PHP/comments/zehsc1/top_10_recommended_books_for_php_developers/'
            ,
            'user_id' => 1,
            'created_at' => DateTime::createFromFormat('Y-m-d', '2024-06-15')
        ]);

        DB::table('posts')->insert([
            'title' => 'A way out?',
            'body' => 'Voted #1 Fun & Games in Limerick on TripAdvisor, an escape room is a real-life physical puzzle game, where you and your team are locked in a room for one hour.

            You need to interact with your surroundings and work together to crack clues and solve puzzles so that you figure out your escape before your 60 minutes are up!

            At Escape Limerick, each of our three escape rooms has been designed to complement a chapter of the city’s history from the 1200s right up to the 1900s.

            Leave behind the distractions of your everyday life and get absorbed by a world of mystery and puzzles until the clock strikes 00:00.

            Escape Rooms are ideal as a group activity. They are all about problem solving, decision making, critical thinking, communication and, above all else, working together which is why they’re so popular as a team building experience.',
            'user_id' => 2,
            'created_at' => DateTime::createFromFormat('Y-m-d', '2024-07-03')
        ]);

        DB::table('posts')->insert([
            'title' => 'Clicker game Hamster Kombat: Russian domain and no privacy policy',
            'body' => 'Clicker video game "Hamster Battle" is gaining momentum in the virtual world ". In it, you need to collect coins by tapping on the screen and perform special tasks. Despite its attractive simplicity, this pastime caused concern because of its association with the aggressor state.
            First, the suspicious details were pointed out by a social network user with the nickname "Golden Prague" . According to her observations, the app lacked a privacy policy and the referral links used the word "Kent", similar to a slang term popular in Russia. However, it was the domain of the game that caused the biggest doubts - it had Russian roots.
            A check through the WHOIS service confirmed these fears. "Homyachi bij" is registered by RU-CENTER Group, one of the leading domain name registrars and hosting providers, which belongs to the Russian holding company RBC. In another registration, Moscow is indicated as the location of the administrator.
            Despite its threatening nature, this game has gained popularity among Ukrainians thanks to the spread of information about it on Instagram, TikTok and Telegram. The employees of the AIN.UA editorial office even filled her with memes and advertisements. According to rumors, Hamster Battle will follow the successful Notcoin app, where users also earn coins through clicks and can exchange them for cryptocurrency.',
            'user_id' => 2,
            'created_at' => DateTime::createFromFormat('Y-m-d', '2024-07-04')
        ]);

        DB::table('posts')->insert([
            'title' => 'Golang is killing PHP',
            'body' => 'In the last few years on the market, in my purely personal opinion, golang has been pushing PHP out of the market, and many companies believe that projects that are currently written and running in PHP should be rewritten in golang to be good.

            This approach is only partially true. In reality, each programming language is designed to solve a specific type of problem, and performance issues largely depend on the developer, not the programming language.

            Seeing this unfair treatment of PHP, I want to publish a series of articles in which I talk about the specifics of development, issues that need to be taken into account, as well as development participants who are also often forgotten, such as devops engineers.
            ',
            'user_id' => 3,
            'created_at' => DateTime::createFromFormat('Y-m-d', '2024-05-01')
        ]);

        $post = Post::find(1);
        $post->categories()->attach([1, 3]);

        $post = Post::find(2);
        $post->categories()->attach([3]);

        $post = Post::find(3);
        $post->categories()->attach([1,3]);

        $post = Post::find(4);
        $post->categories()->attach([1, 2]);

    }
}