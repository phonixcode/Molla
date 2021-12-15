<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->words($nb=2,$asText=true);
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'photo' => $this->faker->imageUrl(60, 60),
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
