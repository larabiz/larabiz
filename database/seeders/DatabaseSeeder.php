<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Choice;
use App\Models\Comment;
use App\Models\Selection;
use App\Models\Discussion;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run() : void
    {
        User::factory()->create([
            'name' => 'Benjamin Crozat',
            'email' => 'hello@benjamincrozat.com',
        ]);

        User::factory(49)->create();

        Discussion::factory(30)
            ->for(User::inRandomOrder()->first())
            ->has(Reply::factory()->for(User::inRandomOrder()->first()))
            ->create();

        Post::factory(30)
            ->for(User::inRandomOrder()->first())
            ->has(Comment::factory()->for(User::inRandomOrder()->first()))
            ->create();

        Poll::factory(50)->create()->each(function (Poll $poll) {
            Choice::factory(mt_rand(3, 6))
                ->for($poll)
                ->create()
                ->each(function (Choice $choice) {
                    Selection::factory(mt_rand(1, 10))
                        ->for(User::inRandomOrder()->first())
                        ->for($choice)
                        ->create();
                });
        });

        Subscriber::factory(50)->create();
    }
}
