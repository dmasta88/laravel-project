<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->text(),
            'profile_id' => Profile::inRandomOrder()->first(),
            'chat_id' => Chat::inRandomOrder()->first(),
            'published_at' => fake()->dateTime()
        ];
    }
}
