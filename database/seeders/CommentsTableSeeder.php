<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run() : void
    {
        Comment::factory(100)->make()->each(function (Comment $comment) {
            $comment->fill([
                'user_id' => User::inRandomOrder()->value('id'),
                'post_id' => Post::inRandomOrder()->value('id'),
            ])->save();
        });
    }
}
