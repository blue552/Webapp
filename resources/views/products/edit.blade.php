@php
    $currentCategoryId = old('category_id', $product->categories->pluck('id')->first());
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            Chỉnh sửa sản phẩm: {{ $product->name }}
        </h2>
    </x-slot>

    <section class="edit-product-form py-8" style="background: linear-gradient(to bottom, #f5ebe0 0%, #e8dcc6 100%); min-height: 70vh;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <div class="edit-form-card rounded-2xl shadow-lg border p-8" style="background: #faf5f0; border-color: #d4c4a8;">
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                            <h3 class="font-semibold mb-2"><i class="fa fa-exclamation-triangle mr-1"></i> Vui lòng kiểm tra lại thông tin:</h3>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-semibold text-black mb-1">
                                Tên sản phẩm <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                   class="form-control w-full rounded-lg border-2 border-indigo-100 focus:border-indigo-400 focus:ring-indigo-300"
                                   value="{{ old('name',$product->name)}}"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-semibold text-black mb-1">
                                Mô tả
                            </label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control w-full rounded-lg border-2 border-indigo-100 focus:border-indigo-400 focus:ring-indigo-300"
                                      placeholder="Mô tả chi tiết về sản phẩm">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-sm font-semibold text-black mb-1">
                                    Giá (VNĐ) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="price" name="price"
                                       class="form-control w-full rounded-lg border-2 border-indigo-100 focus:border-indigo-400 focus:ring-indigo-300"
                                       step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                                @error('price')
                                    <small class="text-red-600 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-semibold text-black mb-1">
                                    Tồn kho <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="stock" name="stock"
                                       class="form-control w-full rounded-lg border-2 border-indigo-100 focus:border-indigo-400 focus:ring-indigo-300"
                                       min="0" value="{{ old('stock', $product->stock) }}" required>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-black mb-2">
                                Danh mục sản phẩm <span class="text-red-500">*</span>
                            </label>

                            @if($categories->count() > 0)
                                <div class="categories-radio-container">
                                    @foreach($categories as $category)
                                        <div class="form-check-radio mb-3">
                                            <input
                                                class="form-check-input-radio"
                                                type="radio"
                                                name="category_id"
                                                id="category_{{ $category->id }}"
                                                value="{{ $category->id }}"
                                                {{ $currentCategoryId == $category->id ? 'checked' : '' }}
                                                required
                                            >
                                            <label class="form-check-label-radio" for="category_{{ $category->id }}">
                                                <span class="text-indigo-600 dark:text-indigo-300 font-semibold">{{ $category->name }}</span>
                                                @if($category->description)
                                                    <small class="d-block text-muted text-sm">{{ $category->description }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-black text-sm mt-1 block">Chọn một danh mục cho sản phẩm</small>
                            @else
                                <div class="alert alert-warning bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                                    <i class="fa fa-exclamation-triangle mr-1"></i>
                                    <strong>Chưa có danh mục nào!</strong>
                                    Vui lòng <a href="{{ route('categories.index') }}" class="text-indigo-600 font-semibold underline">tạo danh mục</a> trước.
                                </div>
                            @endif

                            @error('category_id')
                                <div class="text-red-600 mt-1 text-sm">
                                    <i class="fa fa-exclamation-circle mr-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="image" class="block text-sm font-semibold text-black mb-1">
                                Ảnh (tùy chọn)
                            </label>
                            <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
                            @if($product->image)
                                <div class="mt-3">
                                    <small class="text-black">Ảnh hiện tại:</small>
                                    @if(Storage::exists('public/' . $product->image))
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="mt-2 rounded-lg shadow-md max-h-40">
                                    @elseif(file_exists(public_path('images/products/' . $product->image)))
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="mt-2 rounded-lg shadow-md max-h-40">
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="mt-8 flex justify-center gap-4">
                            <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-lg border text-black shadow-sm" style="border-color: #d4c4a8; background: #faf5f0; hover:background: #e8dcc6;">
                                <i class="fa fa-times mr-1"></i> Hủy
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md">
                                <i class="fa fa-save mr-1"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
    .categories-radio-container {
        border: 2px solid #e0e7ff;
        border-radius: 12px;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        max-height: 260px;
        overflow-y: auto;
        box-shadow: 0 4px 6px rgba(0,0,0,0.04);
    }

    .categories-radio-container::-webkit-scrollbar {
        width: 10px;
    }

    .categories-radio-container::-webkit-scrollbar-track {
        background: #f8f9ff;
        border-radius: 5px;
    }

    .categories-radio-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 5px;
    }

    .categories-radio-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5568d3 0%, #6b46c1 100%);
    }

    .form-check-radio {
        display: flex;
        align-items: flex-start;
        padding: 0.75rem;
        border-radius: 10px;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .form-check-radio:hover {
        background-color: rgba(102, 126, 234, 0.06);
        border-color: #e0e7ff;
        transform: translateX(4px);
    }

    .form-check-input-radio {
        width: 1.3rem;
        height: 1.3rem;
        margin-top: 0.15rem;
        margin-right: 0.9rem;
        cursor: pointer;
        border: 3px solid #c7d2fe;
        border-radius: 50%;
        flex-shrink: 0;
        appearance: none;
        position: relative;
        transition: all 0.2s ease;
    }

    .form-check-input-radio:checked {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .form-check-input-radio:checked::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 0.45rem;
        height: 0.45rem;
        border-radius: 50%;
        background: white;
    }

    .form-check-input-radio:focus {
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        outline: none;
    }

    .form-check-label-radio {
        flex: 1;
        cursor: pointer;
        user-select: none;
    }
    </style>
</x-app-layout>
