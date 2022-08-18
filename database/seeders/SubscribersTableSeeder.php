<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{
    public function run() : void
    {
        Subscriber::factory(50)->create();
    }
}
