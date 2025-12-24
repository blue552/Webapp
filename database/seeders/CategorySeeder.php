<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Tạo các loại sản phẩm (danh mục) mặc định cho cửa hàng bánh
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bánh Gato',
                'description' => 'Bánh Gato là bánh đặc biệt cho người yêu thích vị béo ngậy, thơm ngon',
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Tiramisu',
                'description' => 'Bánh Tiramisu là bánh đặc biệt cho người yêu thích vị ngọt và vị cafe đậm đà',
                'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Mochi',
                'description' => 'Bánh Mochi là bánh đặc biệt cho người yêu thích vị ngon và dẻo dai',
                'image' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Cupcake',
                'description' => 'Bánh Cupcake nhỏ xinh, đa dạng hương vị, phù hợp cho mọi dịp',
                'image' => 'https://images.unsplash.com/photo-1614707267537-b85aaf00c4b7?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Cookie',
                'description' => 'Bánh Cookie giòn tan, thơm bơ, nhiều loại nhân hấp dẫn',
                'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Donut',
                'description' => 'Bánh Donut hình tròn với lớp phủ đầy màu sắc và hương vị đặc biệt',
                'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Tart',
                'description' => 'Bánh Tart với lớp vỏ giòn và nhân ngọt ngào, đẹp mắt',
                'image' => 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Cheesecake',
                'description' => 'Bánh Cheesecake mềm mịn, béo ngậy, nhiều hương vị trái cây',
                'image' => 'https://images.unsplash.com/photo-1524351199678-941a58a3df50?w=800&auto=format&fit=crop'
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'image' => $category['image']
                ]
            );
        }

        $this->command->info('Đã tạo ' . count($categories) . ' loại sản phẩm thành công!');
    }
}
