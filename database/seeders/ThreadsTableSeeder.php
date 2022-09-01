<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    public function run() : void
    {
        Thread::factory(mt_rand(30, 50))->make()->each(function (Thread $thread) {
            $thread->created_at = now()->subDays(mt_rand(1, 30));
            $thread->last_activity_at = $thread->created_at;
            $thread->user()->associate(User::inRandomOrder()->first());
            $thread->save();
        });
    }
}
