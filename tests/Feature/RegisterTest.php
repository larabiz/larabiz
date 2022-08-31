<?php

namespace Tests\Feature;

use Tests\TestCase;

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
