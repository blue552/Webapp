<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Lấy sản phẩm mới nhất (8 sản phẩm)
        $featuredProducts = Product::with('categories')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();
        
        // Lấy tất cả danh mục
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(6)
            ->get();
        
        // Thống kê
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_stock' => Product::sum('stock'),
            'total_value' => Product::selectRaw('SUM(price * stock) as total')->value('total') ?? 0,
        ];
        
        return view('home', compact('featuredProducts', 'categories', 'stats'));
    }
}
