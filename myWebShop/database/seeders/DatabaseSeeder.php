<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        
        // Create categories first
        $this->call([
            CategorySeeder::class,
        ]);
        
        // Create products
        $product1 = Product::firstOrCreate(
            ['name' => 'San pham 1'],
            ['description' => 'San pham ra mat dau tien', 'price' => 100,'stock' => 1]
        );
        $product2 = Product::firstOrCreate(
            ['name' => 'San pham 2'],
            ['description' => 'San pham ra mat dau tien', 'price' => 200, 'stock' => 2]
        );
        
        // Get categories and attach to products
        $categories = Category::all();
        if ($categories->count() > 0) {
            // Attach first category to product1
            $product1->categories()->sync([$categories->first()->id]);
            
            // Attach all categories to product2
            $product2->categories()->sync($categories->pluck('id')->toArray());
        }
    }
}
