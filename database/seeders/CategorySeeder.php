<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ["beauty","fragrances","furniture","groceries","home-decoration","kitchen-accessories","laptops","mens-shirts","mens-shoes","mens-watches","mobile-accessories","motorcycle","skin-care","smartphones","sports-accessories","sunglasses","tablets","tops","vehicle","womens-bags","womens-dresses","womens-jewellery","womens-shoes","womens-watches"];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'icon' => 'fas fa-tshirt',
                'status' => 'Active'
            ]);
        }
    }
}
