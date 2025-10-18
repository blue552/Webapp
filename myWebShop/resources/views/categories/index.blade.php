<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-900 dark:text-gray-100">Danh mục</h2>
    </x-slot>
    <section class="categories-content bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse($categories as $category)
                    <div>
                        <div class="category-card bg-transparent border-0 p-0">
                            <div class="relative aspect-square max-w-[200px] overflow-hidden rounded-md ">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $category->name }}</h3>
                                <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-primary text-white hover:bg-blue-700 hover:text-white">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Không có danh mục nào
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>