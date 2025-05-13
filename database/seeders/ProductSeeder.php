<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class ProductCategoriesSeeder extends Seeder
{
    public function run()
    {
        Categories::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Electronics products like phones, laptops, etc.',
        ]);

        Categories::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
            'description' => 'Clothing, shoes, and accessories.',
        ]);
        
        // Add more categories as needed
    }
}
