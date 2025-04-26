<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->realTextBetween(100, 256),
            'content' => fake()->unique()->realTextBetween(256, 3000),
            'image' => fake()->imageUrl,
            'category_id' => Category::inRandomOrder()->first()->id,
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'published_at' => fake()->dateTime(),
            'is_active' => fake()->boolean()
        ];
    }
}
