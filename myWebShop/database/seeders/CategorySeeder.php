<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(
            ['name' => 'Bánh Gato'],
            ['description' => 'Bánh Gato là bánh đặc biệt cho người yêu thích vị béo']
        );
        Category::firstOrCreate(
            ['name' => 'Bánh Tiramisu'],
            ['description' => 'Bánh Tiramisu là bánh đặc biệt cho người yêu thích vị ngọt và vị cafe']
        );
        Category::firstOrCreate(
            ['name' => 'Bánh Mochi'],
            ['description' => 'Bánh Mochi là bánh đặc biệt cho người yêu thích vị ngon và dẻo']
        );
    }
}
