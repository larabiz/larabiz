<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class StrTest extends TestCase
{
    public function test_it_renders_external_links_with_appropriate_attributes() : void
    {
        $this->assertEquals(
            '<p><a rel="nofollow noopener noreferrer" target="_blank" href="https://www.apple.com">Apple</a></p>',
            trim(Str::marxdown('[Apple](https://www.apple.com)'))
        );
    }

    public function test_it_renders_internal_links_without_target_and_rel_attributes() : void
    {
        $this->assertEquals(
            '<p><a href="https://larabiz.fr">Larabiz</a></p>',
            trim(Str::marxdown('[Larabiz](https://larabiz.fr)'))
        );

        $this->assertEquals(
            '<p><a href="#foo">Foo</a></p>',
            trim(Str::marxdown('[Foo](#foo)'))
        );
    }
}
