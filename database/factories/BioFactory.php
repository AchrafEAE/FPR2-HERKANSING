<?php

namespace Database\Factories;

use App\Models\Bio;
use Illuminate\Database\Eloquent\Factories\Factory;

final class BioFactory extends Factory
{
    protected $model = Bio::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'headline' => $this->faker->sentence(6),
            'summary' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'availability' => 'Open',
            'website_url' => $this->faker->url(),
            'linkedin_url' => 'https://linkedin.example',
            'github_url' => 'https://github.example',
            'years_experience' => $this->faker->numberBetween(0, 30),
        ];
    }
}
