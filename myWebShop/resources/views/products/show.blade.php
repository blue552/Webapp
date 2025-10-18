<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h2>
    </x-slot>
<!-- Product Detail Header -->
<section class="font-semibold text-gray-900 dark:text-gray-100">
    <div class="container ">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item "><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active ">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-outline">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Product Detail Content -->
<section class="product-detail-content font-semibold text-gray-900 dark:text-gray-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-image-section">
                    @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-main-image">
                    @else
                        <div class="no-image-large">
                            <i class="fa fa-image"></i>
                            <span>Chưa có hình ảnh</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-info-section">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <div class="product-price-section">
                        <span class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                        <span class="product-stock">
                            <i class="fa fa-box"></i> Còn {{ $product->stock }} sản phẩm
                        </span>
                    </div>

                    <div class="product-description">
                        <h5>Mô tả sản phẩm</h5>
                        <p>{{ $product->description ?: 'Chưa có mô tả chi tiết.' }}</p>
                    </div>

                    <div class="product-actions">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Chỉnh sửa sản phẩm
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!')">
                                <i class="fa fa-trash"></i> Xóa sản phẩm
                            </button>
                        </form>
                    </div>

                    <div class="product-meta">
                        <div class="meta-item">
                            <strong>ID sản phẩm:</strong> #{{ $product->id }}
                        </div>
                        <div class="meta-item">
                            <strong>Ngày tạo:</strong> {{ $product->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="meta-item">
                            <strong>Cập nhật lần cuối:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</x-app-layout>
