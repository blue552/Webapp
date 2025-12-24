@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class = "font-semibold text-gray-900 dark:text-gray-100">Sản phẩm</h2>
    </x-slot>


<!-- Products Content -->
<section class="products-content bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fa fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
        <h2 class="products-title">Danh sách sản phẩm</h2>
            <a href="{{ route('products.create') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fa fa-plus mr-2"></i> Thêm sản phẩm
            </a>
        </div>
        
        <!-- Products Grid -->
        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse($products as $product)
                <div class="product-card-wrapper">
                    <div class="product-card bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-2 border-transparent hover:border-purple-300 transform hover:-translate-y-2">
                        <!-- Product Image -->
                        <div class="relative aspect-square w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                            @if($product->image)
                                @if(Storage::exists('public/' . $product->image))
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @elseif(file_exists(public_path('images/products/' . $product->image)))
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-gray-400 bg-gray-100">
                                        <div class="text-center">
                                            <i class="fa fa-image text-4xl mb-2"></i>
                                            <p class="text-sm">Ảnh không tồn tại</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-gray-400 bg-gradient-to-br from-purple-100 to-indigo-100">
                                    <div class="text-center">
                                        <i class="fa fa-image text-4xl mb-2"></i>
                                        <p class="text-sm">Chưa có ảnh</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            @if($product->stock > 0)
                                <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                    Còn hàng
                                </span>
                            @else
                                <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                    Hết hàng
                                </span>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-2 min-h-[2.5rem]">{{ Str::limit($product->description, 80) }}</p>
                            
                            <!-- Categories -->
                            @if($product->categories->count() > 0)
                                <div class="mb-3">
                                    @foreach($product->categories->take(2) as $category)
                                        <span class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs font-semibold px-2 py-1 rounded-full mr-1">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <!-- Price and Stock -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-xl font-bold text-red-600 dark:text-red-400">
                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                    Kho: {{ $product->stock }}
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                                    <i class="fa fa-eye mr-1"></i> Xem
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                                    <i class="fa fa-edit mr-1"></i> Sửa
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                                        <i class="fa fa-trash mr-1"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <i class="fa fa-box-open text-6xl text-gray-400 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-2">Chưa có sản phẩm nào</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Hãy thêm sản phẩm đầu tiên để bắt đầu</p>
                        <a href="{{ route('products.create') }}" class="inline-block bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                            <i class="fa fa-plus mr-2"></i> Thêm sản phẩm mới
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.product-card-wrapper {
    perspective: 1000px;
}

.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    border-color: #a78bfa !important;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>



</x-app-layout>
