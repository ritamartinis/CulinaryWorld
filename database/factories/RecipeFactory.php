<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
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
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(),
            'description' => implode("\n\n", $this->faker->paragraphs(2)),
            'image' => $this->faker->imageUrl(800, 400, 'food'),
            'ingredients' => implode(', ', $this->faker->words(10)),
            'instructions' => implode("\n\n", $this->faker->paragraphs(5)),
            'prep_time' => $this->faker->numberBetween(10, 120), 
            'is_approved' => false,
        ];
    }
}
