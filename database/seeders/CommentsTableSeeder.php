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
        Comment::factory(mt_rand(30, 50))->make()->each(function (Comment $comment) {
            $comment->user()->associate(User::inRandomOrder()->value('id'));
            $comment->post()->associate(Post::inRandomOrder()->value('id'));
            $comment->save();
        });
    }
}
