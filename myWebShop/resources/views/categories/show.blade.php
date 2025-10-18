<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-900 dark:text-gray-100">{{ $category->name }}</h2>
    </x-slot>

<!-- Category Products Content -->
<section class="products-content bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">Sản phẩm</a></li>
                <li class="text-gray-500">/</li>
                <li class="text-gray-700 dark:text-gray-300">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Category Description -->
        @if($category->description)
            <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                <p class="text-gray-700 dark:text-gray-300">{{ $category->description }}</p>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                <i class="fa fa-arrow-left mr-2"></i> Quay lại danh sách sản phẩm
            </a>
        </div>

        <!-- Products Count -->
        <div class="mb-4">
            <p class="text-gray-600 dark:text-gray-400">
                Tìm thấy {{ $products->count() }} sản phẩm trong danh mục "{{ $category->name }}"
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse($products as $product)
                <div>
                    <div class="product-card bg-transparent border-0 p-0">
                        <div class="relative aspect-square max-w-[200px] overflow-hidden rounded-md">
                            @if($product->image)
                                <img src="{{ route('image', $product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover">
                            @endif
                        </div>

                        <h3 class="mt-3 font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($product->description, 80) }}</p>
                        <div class="mt-1 flex items-center text-sm">
                            <span class="font-semibold text-red-600">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                            <span class="text-gray-500">Kho: {{ $product->stock }}</span>
                        </div>

                        <div class="product-actions mt-3 flex gap-3">
                            <a href="{{ route('products.show', $product->id) }}" class="font-semibold text-blue-600 hover:underline">Xem</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="font-semibold text-gray-900 dark:text-gray-100 hover:underline">Sửa</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-semibold text-red-600 hover:underline" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-500 dark:text-gray-400">
                        <i class="fa fa-box-open text-4xl mb-4"></i>
                        <h3>Chưa có sản phẩm nào trong danh mục này</h3>
                        <p>Hãy thêm sản phẩm vào danh mục "{{ $category->name }}"</p>
                        <a href="{{ route('products.create') }}" class="font-semibold text-green-600 dark:text-green-400 hover:underline">
                            <i class="fa fa-plus"></i> Thêm sản phẩm mới
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

</x-app-layout>