<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement([
            PostStatus::Draft->value,
            PostStatus::InReview->value,
            PostStatus::Published->value,
        ]);

        return [
            'user_id' => null,
            'title' => $this->faker->sentence(6),
            'body' => $this->faker->paragraphs(3, true),
            'status' => $status,
            'published_at' => $status === PostStatus::Published->value ? now() : null,
        ];
    }
}
