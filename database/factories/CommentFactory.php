<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $commentableModels = [
            \App\Models\Post::class,
        ];

        $modelClass = fake()->randomElement($commentableModels);
        $model = $modelClass::inRandomOrder()->first();
        return [
            'profile_id' => Profile::inRandomOrder()->first(),
            'commentable_id' => $model->id,
            'commentable_type' => $modelClass,
            'content' => fake()->realTextBetween(100, 1000),
            'published_at' => fake()->dateTime(),
        ];
    }
}
