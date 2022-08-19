<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, LazilyRefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        User::factory()->create([
            'username' => 'Benjamin Crozat',
            'email' => 'benjamincrozat@me.com',
        ]);
    }

    protected function actingAsRandomUser() : static
    {
        return $this->actingAs(User::factory()->create());
    }
}
