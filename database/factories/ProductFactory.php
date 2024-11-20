<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['new', 'featured', 'top'];
        $rand = array_rand($type, 1);

        return [
            'vendor_id' => rand(2,7),
            'name' => $name = fake()->name(),
            'slug' => Str::slug($name, '-'),
            'category_id' => 1,
            'sub_category_id' => 1,
            'child_category_id' => 1,
            'brand_id' => 4,
            'thumb_image' => fake()->imageUrl(),
            "quantity" => rand(15, 200),
            "short_description" =>  fake()->realText(),
            "long_description" =>   fake()->realText(),
            "SKU" =>    fake()->text(50),
            "video_link" => fake()->url(),
            "price" =>  $price = rand(555, 500000),
            "offer_price" => $price / 2,
            'offer_start_date' => fake()->dateTimeThisMonth(),
            'offer_end_date' => fake()->dateTimeThisMonth('+14 days'),
            "product_type" => $type[$rand],
            "seo_title" =>  fake()->text(100),
            "seo_description" => fake()->text(),
            "status"  => 'active',
        ];
    }
}
