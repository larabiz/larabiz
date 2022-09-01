<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{
    public function run() : void
    {
        Subscriber::factory(mt_rand(30, 50))->create();
    }
}
