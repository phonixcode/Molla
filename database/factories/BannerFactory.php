<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->words($nb=1,$asText=true);
        $slug = Str::slug($title);
        $imagePath = URL::full().':1000/frontend/img/bg-img/';
        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->text(10),
            'photo' => $imagePath.$this->faker->unique()->numberBetween(1,6).'.jpg',
            'condition' => $this->faker->randomElement(['banner', 'promo']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
