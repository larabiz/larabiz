<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run() : void
    {
        Comment::factory(mt_rand(30, 50))->create();
    }
}
