@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
<!-- Categories Content -->
<section class="categories-content py-12" style="background: linear-gradient(to bottom right, #f5ebe0, #e8dcc6, #d4c4a8);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="categories-title">Danh sách danh mục</h2>
        </div>
        
        <!-- Categories Grid -->
        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse($categories as $category)
                <div class="category-card-wrapper">
                    <div class="category-card rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-2 border-transparent hover:border-amber-600 transform hover:-translate-y-2" style="background: #faf5f0;">
                        <!-- Category Image or Icon -->
                        <div class="relative aspect-square w-full overflow-hidden" style="background: #e8dcc6;">
                            @if($category->image)
                                @if(filter_var($category->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @elseif(Storage::exists('public/' . $category->image))
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @elseif(file_exists(public_path('images/categories/' . $category->image)))
                                    <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-amber-600 bg-gradient-to-br from-amber-100 to-orange-100">
                                        <div class="text-center">
                                            <i class="fa fa-tag text-4xl mb-2"></i>
                                            <p class="text-sm">Ảnh không tồn tại</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-amber-700 bg-gradient-to-br from-amber-100 via-orange-100 to-amber-200">
                                    <div class="text-center">
                                        <i class="fa fa-tag text-6xl mb-2 opacity-50"></i>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Product Count Badge -->
                            <span class="absolute top-3 right-3 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md" style="background: #8b6f47;">
                                {{ $category->products->count() }} sản phẩm
                            </span>
                        </div>

                        <!-- Category Info -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-black mb-2">{{ $category->name }}</h3>
                            
                            @if($category->description)
                                <p class="text-sm text-black mb-3 line-clamp-2 min-h-[2.5rem]">{{ Str::limit($category->description, 80) }}</p>
                            @endif
                            
                            <!-- Products Preview -->
                            @if($category->products->count() > 0)
                                <div class="mb-3">
                                    <p class="text-xs text-black mb-2 font-semibold">Sản phẩm trong danh mục:</p>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($category->products->take(3) as $product)
                                            <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full" style="background: #d4c4a8; color: #5c4033;">
                                                {{ Str::limit($product->name, 15) }}
                                            </span>
                                        @endforeach
                                        @if($category->products->count() > 3)
                                            <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full" style="background: #d4c4a8; color: #1a1a1a;">
                                                +{{ $category->products->count() - 3 }} khác
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <span class="inline-block text-xs px-2 py-1 rounded" style="background: #d4c4a8; color: #1a1a1a;">
                                        Chưa có sản phẩm
                                    </span>
                                </div>
                            @endif

                            <!-- Action Button -->
                            <a href="{{ route('categories.show', $category->slug) }}" class="w-full text-white text-center py-2 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg block" style="background: linear-gradient(to right, #8b6f47, #a0826d);">
                                <i class="fa fa-eye mr-1"></i> Xem sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <i class="fa fa-tags text-6xl text-black mb-4"></i>
                        <h3 class="text-2xl font-bold text-black mb-2">Chưa có danh mục nào</h3>
                        <p class="text-black mb-6">Hãy chạy seeder để tạo danh mục mẫu</p>
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
    border-color: #fbbf24 !important;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

</x-app-layout>