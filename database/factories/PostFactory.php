<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition() : array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'content' => fake()->paragraphs(5, true),
            'excerpt' => fake()->paragraph(),
            'certified_for_laravel' => 9,
        ];
    }

    public function withIllustration() : static
    {
        return $this
            ->afterMaking(fn (Post $post) => $this->addMedia($post))
            ->afterCreating(fn (Post $post) => $this->addMedia($post));
    }

    public function addMedia(Post $post) : void
    {
        $post
            ->addMediaFromUrl('https://source.unsplash.com/random')
            ->toMediaCollection('illustration');
    }
}
