<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'summary' => $this->faker->text,
            'description' => $this->faker->paragraphs(9, true),
            'additional_info' => $this->faker->paragraphs(9, true),
            'return_cancellation' => $this->faker->paragraphs(9, true),
            'stock' => $this->faker->numberBetween(2,10),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'vendor_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent', 0)->pluck('id')->toArray()),
            'photo' => $this->faker->imageUrl('270', '270'),
            'size_guide' => $this->faker->imageUrl('80', '80'),
            'price' => $this->faker->numberBetween(100, 1000),
            'offer_price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->numberBetween(0, 100),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'condition' => $this->faker->randomElement(['new', 'popular', 'winter']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
