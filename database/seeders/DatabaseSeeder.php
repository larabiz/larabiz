<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run() : void
    {
        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class,
            ThreadsTableSeeder::class,
            RepliesTableSeeder::class,
            SubscribersTableSeeder::class,
        ]);
    }
}
