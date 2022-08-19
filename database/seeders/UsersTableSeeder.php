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
            'email' => 'benjamincrozat@me.com',
        ]);

        User::factory(30)->create();
    }
}
