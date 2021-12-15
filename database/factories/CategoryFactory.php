<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
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
            'summary' => $this->faker->sentences(3, true),
            'photo' => $this->faker->imageUrl('350', '350'),
            'is_parent' => $this->faker->randomElement([true, false]),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'parent_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
        ];
    }
}
