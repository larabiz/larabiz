<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run() : void
    {
        User::factory()->create([
            'username' => 'Benjamin Crozat',
            'email' => config('app.master_email'),
        ]);

        User::factory(mt_rand(29, 49))->create();
    }
}
