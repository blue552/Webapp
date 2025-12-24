@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard - Quản lý cửa hàng bánh
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Tổng sản phẩm</dt>
                                    <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_products']) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Danh mục</dt>
                                    <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_categories']) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Tổng tồn kho</dt>
                                    <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_stock']) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Tổng giá trị</dt>
                                    <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_value'], 0, ',', '.') }} VNĐ</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner Carousel -->
            <div class="mb-8 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-64 md:h-80">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">🍰 Cửa hàng bánh ngọt</h1>
                            <p class="text-xl md:text-2xl mb-6">Thưởng thức hương vị tuyệt vời mỗi ngày</p>
                            <div class="flex justify-center gap-4">
                                <a href="{{ route('products.index') }}" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                                    Xem sản phẩm
                                </a>
                                <a href="{{ route('products.create') }}" class="bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-800 transition">
                                    Thêm sản phẩm
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute top-0 left-0 w-full h-full opacity-20">
                        <div class="absolute top-10 left-10 text-6xl">🍰</div>
                        <div class="absolute top-20 right-20 text-5xl">🧁</div>
                        <div class="absolute bottom-10 left-1/4 text-4xl">🎂</div>
                        <div class="absolute bottom-20 right-1/3 text-5xl">🍪</div>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            @if($categories->count() > 0)
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Danh mục nổi bật</h3>
                    <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 font-semibold">
                        Xem tất cả →
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="group">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-shadow p-4 text-center">
                            <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center text-3xl">
                                🍰
                            </div>
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition">
                                {{ $category->name }}
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $category->products_count }} sản phẩm
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Featured Products Section -->
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Sản phẩm mới nhất</h3>
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 font-semibold">
                        Xem tất cả →
                    </a>
                </div>
                
                @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden">
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                            @if($product->image)
                                @if(filter_var($product->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @elseif(Storage::exists('public/' . $product->image))
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @elseif(file_exists(public_path('images/products/' . $product->image)))
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <!-- Stock Badge -->
                            @if($product->stock > 0)
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Còn hàng
                                </span>
                            @else
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Hết hàng
                                </span>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                            
                            <!-- Categories -->
                            @if($product->categories->count() > 0)
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach($product->categories->take(2) as $category)
                                <span class="text-xs bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-2 py-1 rounded">
                                    {{ $category->name }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                            
                            <!-- Price and Stock -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-red-600 dark:text-red-400">
                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Kho: {{ $product->stock }}
                                </span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition">
                                    Xem
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition">
                                    Sửa
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Chưa có sản phẩm nào</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Hãy thêm sản phẩm đầu tiên để bắt đầu</p>
                    <a href="{{ route('products.create') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fa fa-plus mr-2"></i>Thêm sản phẩm mới
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
