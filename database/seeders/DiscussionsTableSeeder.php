<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reply;
use App\Models\Discussion;
use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    public function run() : void
    {
        Discussion::factory(30)->make()->each(function (Discussion $discussion) {
            $discussion->user_id = User::inRandomOrder()->value('id');
            $discussion->save();

            Reply::factory(mt_rand(1, 30))->make()->each(function (Reply $reply) use ($discussion) {
                $reply->user_id = User::inRandomOrder()->value('id');
                $reply->discussion_id = $discussion->id;
                $reply->save();
            });
        });
    }
}
