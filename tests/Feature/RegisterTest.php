<?php

namespace Tests\Feature;

use Tests\TestCase;

// This test makes sure the page isn't broken.
// Better tests are coming!
class RegisterTest extends TestCase
{
    public function test_it_works() : void
    {
        $this
            ->assertGuest()
            ->get(route('register'))
            ->assertOk()
        ;
    }
}
