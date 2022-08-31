<?php

namespace Tests\Feature;

use Tests\TestCase;

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
