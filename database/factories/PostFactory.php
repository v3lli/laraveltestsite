<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => \App\Models\Website::factory(), // associates a website
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sent' => false,
            'created_at' => now(),
        ];
    }
}
