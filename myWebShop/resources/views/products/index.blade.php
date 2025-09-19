@extends('layouts.app')

@section('title', 'Sản phẩm - LuxeAura')

@section('content')
<!-- Products Header -->
<section class="products-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="page-title">Sản phẩm</h1>
                <p class="page-subtitle">Khám phá bộ sưu tập thời trang cao cấp</p>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Thêm sản phẩm mới
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Products Content -->
<section class="products-content">
    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <!-- Products Grid -->
        <div class="row">
            @forelse($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                            @else
                                <div class="no-image">
                                    <i class="fa fa-image"></i>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                            <div class="product-overlay">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline">
                                    <i class="fa fa-eye"></i> Xem chi tiết
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-name">{{ $product->name }}</h5>
                            <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                            <div class="product-meta">
                                <span class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                <span class="product-stock">
                                    <i class="fa fa-box"></i> {{ $product->stock }} sản phẩm
                                </span>
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fa fa-box-open"></i>
                        <h3>Chưa có sản phẩm nào</h3>
                        <p>Hãy thêm sản phẩm đầu tiên để bắt đầu</p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Thêm sản phẩm mới
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.products-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px 0;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.products-content {
    padding: 60px 0;
}

.product-card {
    border: 1px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.product-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.no-image {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    background: #f8f9fa;
    color: #6c757d;
}

.no-image i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-info {
    padding: 1.5rem;
}

.product-name {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.product-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.product-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #e74c3c;
}

.product-stock {
    font-size: 0.9rem;
    color: #6c757d;
}

.product-stock i {
    margin-right: 0.25rem;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}

.product-actions .btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #dee2e6;
}

.empty-state h3 {
    margin-bottom: 1rem;
    color: #495057;
}

.alert {
    border-radius: 8px;
    border: none;
    margin-bottom: 2rem;
}

.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert i {
    margin-right: 0.5rem;
}
</style>
@endpush
