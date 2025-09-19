@extends('layouts.app')

@section('title', $product->name . ' - LuxeAura')

@section('content')
<!-- Product Detail Header -->
<section class="product-detail-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
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
<section class="product-detail-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-image-section">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-main-image">
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
@endsection

@push('styles')
<style>
.product-detail-header {
    background: #f8f9fa;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #667eea;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.product-detail-content {
    padding: 60px 0;
}

.product-image-section {
    margin-bottom: 2rem;
}

.product-main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.no-image-large {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 400px;
    background: #f8f9fa;
    color: #6c757d;
    border-radius: 12px;
    border: 2px dashed #dee2e6;
}

.no-image-large i {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.product-info-section {
    padding-left: 2rem;
}

.product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.product-price-section {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.product-price {
    font-size: 2rem;
    font-weight: 700;
    color: #e74c3c;
}

.product-stock {
    font-size: 1.1rem;
    color: #6c757d;
}

.product-stock i {
    margin-right: 0.5rem;
    color: #28a745;
}

.product-description {
    margin-bottom: 2rem;
}

.product-description h5 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-weight: 600;
}

.product-description p {
    color: #6c757d;
    line-height: 1.6;
    font-size: 1.1rem;
}

.product-actions {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.product-actions .btn {
    flex: 1;
    min-width: 150px;
}

.product-meta {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
}

.meta-item {
    margin-bottom: 0.5rem;
    color: #6c757d;
}

.meta-item:last-child {
    margin-bottom: 0;
}

.meta-item strong {
    color: #2c3e50;
    margin-right: 0.5rem;
}

@media (max-width: 768px) {
    .product-info-section {
        padding-left: 0;
        margin-top: 2rem;
    }
    
    .product-title {
        font-size: 2rem;
    }
    
    .product-price-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .product-actions {
        flex-direction: column;
    }
    
    .product-actions .btn {
        flex: none;
    }
}
</style>
@endpush
