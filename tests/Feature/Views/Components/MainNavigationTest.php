<?php

namespace Tests\Feature\Views\Components;

use Tests\TestCase;

class MainNavigationTest extends TestCase
{
    public function test_it_does_not_include_forum_link_in_production() : void
    {
        app()['env'] = 'production';

        $this
            ->view('components.main-navigation', ['attributes' => collect()])
            ->assertDontSee(config('app.url') . '/forum', false)
        ;
    }

    public function test_it_includes_forum_link_outside_production() : void
    {
        $this
            ->view('components.main-navigation', ['attributes' => collect()])
            ->assertSee(config('app.url') . '/forum', false)
        ;
    }
}
