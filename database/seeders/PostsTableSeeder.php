<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run() : void
    {
        Post::factory(30)->make()->each(function (Post $post) {
            $post->user_id = User::inRandomOrder()->value('id');
            $post->save();

            Comment::factory(mt_rand(1, 30))->make()->each(function (Comment $comment) use ($post) {
                $comment->user_id = User::inRandomOrder()->value('id');
                $comment->post_id = $post->id;
                $comment->save();
            });
        });
    }
}
