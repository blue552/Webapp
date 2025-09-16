<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo user cố định (nếu chưa có)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        // Tạo sản phẩm cố định (nếu chưa có)
        Product::firstOrCreate(
            ['name' => 'San pham 1'],
            ['description' => 'San pham ra mat dau tien', 'price' => 100]
        );
        Product::firstOrCreate(
            ['name' => 'San pham 2'],
            ['description' => 'San pham ra mat dau tien', 'price' => 200]
        );
    }
}
