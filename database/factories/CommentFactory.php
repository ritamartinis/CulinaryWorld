<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
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
        return [
                'user_id' => User::factory(),
                'recipe_id' => Recipe::factory(),
                'body' => $this->faker->paragraph,
                'rating' => $this->faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    }
}
