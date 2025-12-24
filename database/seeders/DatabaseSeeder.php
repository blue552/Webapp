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
        
        // Create demo products với giá và số lượng thực tế
        $demoProducts = [
            [
                'name' => 'Bánh Tiramisu',
                'category' => 'Bánh Tiramisu',
                'description' => 'Bánh Tiramisu thơm ngon, đậm đà vị cafe và kem ngọt ngào, được làm từ mascarpone và cà phê espresso',
                'price' => 100000,
                'stock' => 11,
                'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Mochi Nhật Bản',
                'category' => 'Bánh Mochi',
                'description' => 'Bánh Mochi dẻo dai, thơm ngon với nhiều loại nhân đậu đỏ, matcha, đậu xanh truyền thống',
                'price' => 35000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Gato Sinh Nhật',
                'category' => 'Bánh Gato',
                'description' => 'Bánh Gato kem tươi thơm béo, nhiều tầng với lớp kem bơ ngọt ngào, phù hợp cho sinh nhật',
                'price' => 250000,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Cupcake Vanilla',
                'category' => 'Bánh Cupcake',
                'description' => 'Bánh Cupcake nhỏ xinh với lớp kem phủ đẹp mắt, hương vani thơm ngát',
                'price' => 45000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1614707267537-b85aaf00c4b7?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Cookie Chocolate Chip',
                'category' => 'Bánh Cookie',
                'description' => 'Bánh Cookie giòn tan với socola chip đậm đà, thơm mùi bơ, đóng gói 10 cái/hộp',
                'price' => 80000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Donut Đường',
                'category' => 'Bánh Donut',
                'description' => 'Bánh Donut hình tròn với lớp phủ đường trắng, mềm mịn, thơm ngon',
                'price' => 30000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Tart Trái Cây',
                'category' => 'Bánh Tart',
                'description' => 'Bánh Tart với lớp vỏ giòn, nhân kem ngọt ngào và trái cây tươi đẹp mắt',
                'price' => 120000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?w=800&auto=format&fit=crop'
            ],
            [
                'name' => 'Bánh Cheesecake Dâu',
                'category' => 'Bánh Cheesecake',
                'description' => 'Bánh Cheesecake mềm mịn, béo ngậy với lớp sốt dâu tươi chua ngọt hài hòa',
                'price' => 150000,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1524351199678-941a58a3df50?w=800&auto=format&fit=crop'
            ],
        ];

        foreach ($demoProducts as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            
            if ($category) {
                $product = Product::firstOrCreate(
                    ['name' => $productData['name']],
                    [
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'stock' => $productData['stock'],
                        'image' => $productData['image']
                    ]
                );
                
                // Attach category to product
                $product->categories()->sync([$category->id]);
            }
        }
        
        $this->command->info('Đã tạo ' . count($demoProducts) . ' sản phẩm demo thành công!');
    }
}
