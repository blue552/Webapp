@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
<!-- Categories Content -->
<section class="categories-content bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="categories-title">Danh sách danh mục</h2>
        </div>
        
        <!-- Categories Grid -->
        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse($categories as $category)
                <div class="category-card-wrapper">
                    <div class="category-card bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-2 border-transparent hover:border-purple-300 transform hover:-translate-y-2">
                        <!-- Category Image or Icon -->
                        <div class="relative aspect-square w-full overflow-hidden bg-gradient-to-br from-purple-100 via-indigo-100 to-pink-100">
                            @if($category->image)
                                @if(Storage::exists('public/' . $category->image))
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @elseif(file_exists(public_path('images/categories/' . $category->image)))
                                    <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-gray-400 bg-gradient-to-br from-purple-100 to-indigo-100">
                                        <div class="text-center">
                                            <i class="fa fa-tag text-4xl mb-2"></i>
                                            <p class="text-sm">Ảnh không tồn tại</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-purple-600 bg-gradient-to-br from-purple-100 via-indigo-100 to-pink-100">
                                    <div class="text-center">
                                        <i class="fa fa-tag text-6xl mb-2 opacity-50"></i>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Product Count Badge -->
                            <span class="absolute top-3 right-3 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                {{ $category->products->count() }} sản phẩm
                            </span>
                        </div>

                        <!-- Category Info -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $category->name }}</h3>
                            
                            @if($category->description)
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-2 min-h-[2.5rem]">{{ Str::limit($category->description, 80) }}</p>
                            @endif
                            
                            <!-- Products Preview -->
                            @if($category->products->count() > 0)
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 font-semibold">Sản phẩm trong danh mục:</p>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($category->products->take(3) as $product)
                                            <span class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs font-semibold px-2 py-1 rounded-full">
                                                {{ Str::limit($product->name, 15) }}
                                            </span>
                                        @endforeach
                                        @if($category->products->count() > 3)
                                            <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-semibold px-2 py-1 rounded-full">
                                                +{{ $category->products->count() - 3 }} khác
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs px-2 py-1 rounded">
                                        Chưa có sản phẩm
                                    </span>
                                </div>
                            @endif

                            <!-- Action Button -->
                            <a href="{{ route('categories.show', $category->slug) }}" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg block">
                                <i class="fa fa-eye mr-1"></i> Xem sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <i class="fa fa-tags text-6xl text-gray-400 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-2">Chưa có danh mục nào</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Hãy chạy seeder để tạo danh mục mẫu</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.categories-title {
    font-size: 1.875rem;
    line-height: 2.25rem;
    font-weight: 700;
    color: #111827 !important;
}

.dark .categories-title {
    color: #e5e7eb !important;
}

.category-card-wrapper {
    perspective: 1000px;
}

.category-card {
    transition: all 0.3s ease;
}

.category-card:hover {
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