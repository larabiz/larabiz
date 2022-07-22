<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\User;
use App\Models\Vote;
use App\Models\Choice;
use Illuminate\Database\Seeder;

class PollsTableSeeder extends Seeder
{
    public function run() : void
    {
        Poll::factory(30)->create()->each(function (Poll $poll) {
            Choice::factory(mt_rand(2, 6))->for($poll)->create()->each(function (Choice $choice) {
                Vote::factory(mt_rand(1, 10))->for($choice)->make()->each(function (Vote $vote) {
                    $vote->user_id = User::inRandomOrder()->value('id');
                    $vote->save();
                });
            });
        });
    }
}
