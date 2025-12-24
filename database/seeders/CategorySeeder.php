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
                'description' => 'Bánh Gato là bánh đặc biệt cho người yêu thích vị béo ngậy, thơm ngon'
            ],
            [
                'name' => 'Bánh Tiramisu',
                'description' => 'Bánh Tiramisu là bánh đặc biệt cho người yêu thích vị ngọt và vị cafe đậm đà'
            ],
            [
                'name' => 'Bánh Mochi',
                'description' => 'Bánh Mochi là bánh đặc biệt cho người yêu thích vị ngon và dẻo dai'
            ],
            [
                'name' => 'Bánh Cupcake',
                'description' => 'Bánh Cupcake nhỏ xinh, đa dạng hương vị, phù hợp cho mọi dịp'
            ],
            [
                'name' => 'Bánh Cookie',
                'description' => 'Bánh Cookie giòn tan, thơm bơ, nhiều loại nhân hấp dẫn'
            ],
            [
                'name' => 'Bánh Donut',
                'description' => 'Bánh Donut hình tròn với lớp phủ đầy màu sắc và hương vị đặc biệt'
            ],
            [
                'name' => 'Bánh Tart',
                'description' => 'Bánh Tart với lớp vỏ giòn và nhân ngọt ngào, đẹp mắt'
            ],
            [
                'name' => 'Bánh Cheesecake',
                'description' => 'Bánh Cheesecake mềm mịn, béo ngậy, nhiều hương vị trái cây'
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }

        $this->command->info('Đã tạo ' . count($categories) . ' loại sản phẩm thành công!');
    }
}
