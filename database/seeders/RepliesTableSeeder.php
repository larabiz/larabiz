<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    public function run() : void
    {
        Reply::factory(mt_rand(100, 200))->make()->each(function (Reply $reply) {
            $reply->user()->associate(User::inRandomOrder()->first());
            $reply->thread()->associate($thread = Thread::inRandomOrder()->first());
            $reply->created_at = fake()->dateTimeBetween($thread->created_at, now());
            $reply->save();
            $thread->update(['last_activity_at' => $reply->created_at]);
        });
    }
}
