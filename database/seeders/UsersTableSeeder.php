<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ExperienceGain;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run() : void
    {
        User::factory()->create([
            'username' => 'Benjamin Crozat',
            'email' => 'benjamincrozat@me.com',
        ]);

        User::factory(30)->create();

        User::cursor()->each(function (User $user) {
            ExperienceGain::factory(mt_rand(1, 10))->for($user)->create();
        });
    }
}
