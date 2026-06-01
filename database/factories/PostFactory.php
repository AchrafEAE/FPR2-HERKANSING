<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $isPublished = $this->faker->boolean(40);

        return [
            'user_id' => null,
            'title' => $this->faker->sentence(6),
            'body' => $this->faker->paragraphs(3, true),
            'published_at' => $isPublished ? now() : null,
        ];
    }
}
