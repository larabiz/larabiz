<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run() : void
    {
        Post::factory(mt_rand(30, 50))->for(User::inRandomOrder()->first())->published()->create();
    }
}
