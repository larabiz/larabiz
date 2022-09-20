<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Comment;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run() : void
    {
        User::factory()->create([
            'username' => 'Benjamin Crozat',
            'email' => config('app.master_email'),
        ]);

        User::factory(50)->create();

        Subscriber::factory(50)->create();

        Post::factory(50)
            ->state(fn () => ['user_id' => User::inRandomOrder()->value('id')])
            ->published()
            ->create();

        Comment::factory(100)
            ->state(fn () => [
                'user_id' => User::inRandomOrder()->value('id'),
                'post_id' => Post::inRandomOrder()->value('id'),
            ])
            ->create();

        Thread::factory(50)->state(fn () => [
            'user_id' => User::inRandomOrder()->value('id'),
        ])->create();

        Reply::factory(100)->state(fn () => [
            'user_id' => User::inRandomOrder()->value('id'),
            'thread_id' => Thread::inRandomOrder()->value('id'),
        ])->create();
    }
}
