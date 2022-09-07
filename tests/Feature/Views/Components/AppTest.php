<?php

namespace Tests\Feature\Views\Components;

use Tests\TestCase;
use App\Models\User;

class AppTest extends TestCase
{
    public function test_it_includes_fathom_analytics_in_production() : void
    {
        app()['env'] = 'production';

        $this
            ->view('components.app', ['slot' => ''])
            ->assertSee('https://enlightenment.larabiz.fr/script.js')
        ;
    }

    public function test_it_does_not_include_fathom_analytics_when_authenticated_as_master_in_production() : void
    {
        app()['env'] = 'production';

        $this
            ->view('components.app', ['slot' => ''])
            ->assertSee('https://enlightenment.larabiz.fr/script.js')
        ;

        $this
            ->actingAs(User::master()->first())
            ->view('components.app', ['slot' => ''])
            ->assertDontSee('https://enlightenment.larabiz.fr/script.js')
        ;
    }
}
