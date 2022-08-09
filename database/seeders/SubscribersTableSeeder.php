<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{
    public function run() : void
    {
        Subscriber::factory(mt_rand(100, 10000))->create();
        Subscriber::factory(mt_rand(100, 10000))->create(['confirmed_at' => null]);
    }
}
