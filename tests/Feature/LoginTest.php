<?php

namespace Tests\Feature;

use Tests\TestCase;

// This test makes sure the page isn't broken.
// Better tests are coming!
class LoginTest extends TestCase
{
    public function test_it_works() : void
    {
        $this
            ->assertGuest()
            ->get(route('login'))
            ->assertOk()
        ;
    }
}
