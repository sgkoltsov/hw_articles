<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->lexify('???'),
            'title' => $this->faker->sentence(rand(1,3), true),
            'short' => $this->faker->sentence(rand(3,7), true),
            'body' => $this->faker->paragraph(rand(3, 9)),
        ];
    }
}
