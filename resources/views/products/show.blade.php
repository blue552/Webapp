@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
<!-- Product Detail Header -->
<section class="product-detail-header">
    <div class="container">
        <div class="header-card">
            <div class="header-text">
                <h1 class="page-title">{{ $product->name }}</h1>
                <p class="page-subtitle">Chi tiết sản phẩm</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('products.index') }}" class="btn btn-outline header-back-btn">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Product Detail Content -->
<section class="product-detail-content">
    <div class="container">
        <div class="product-detail-wrapper">
            <!-- Product Image Section -->
            <div class="product-image-card">
                        @if($product->image)
                            @if(filter_var($product->image, FILTER_VALIDATE_URL))
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-main-image">
                            @elseif(Storage::exists('public/' . $product->image))
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-main-image">
                            @elseif(file_exists(public_path('images/products/' . $product->image)))
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-main-image">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fa fa-image"></i>
                                    <span>Ảnh không tồn tại</span>
                                </div>
                            @endif
                        @else
                            <div class="no-image-placeholder">
                                <i class="fa fa-image"></i>
                                <span>Chưa có hình ảnh</span>
                            </div>
                        @endif
            </div>

            <!-- Product Info Section -->
            <div class="product-info-card">
                <div class="product-header-info">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <!-- Stock Badge -->
                    @if($product->stock > 0)
                        <span class="stock-badge stock-available">
                            <i class="fa fa-check-circle"></i> Còn hàng ({{ $product->stock }})
                        </span>
                    @else
                        <span class="stock-badge stock-unavailable">
                            <i class="fa fa-times-circle"></i> Hết hàng
                        </span>
                    @endif
                </div>

                <!-- Price Section -->
                <div class="product-price-section">
                    <span class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                </div>

                <!-- Category Section -->
                @if($product->categories->count() > 0)
                    <div class="product-category-section">
                        <h6 class="section-label">
                            <i class="fa fa-tags"></i> Danh mục:
                        </h6>
                        <div class="category-tags">
                            @foreach($product->categories as $category)
                                <a href="{{ route('categories.show', $category->slug) }}" class="category-tag">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Description Section -->
                <div class="product-description-section">
                    <h6 class="section-label">
                        <i class="fa fa-info-circle"></i> Mô tả sản phẩm:
                    </h6>
                    <p class="product-description">{{ $product->description ?: 'Chưa có mô tả chi tiết.' }}</p>
                </div>

                <!-- Actions Section -->
                <div class="product-actions">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-action">
                        <i class="fa fa-edit"></i> Chỉnh sửa sản phẩm
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="btn-action-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action" 
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác!')">
                            <i class="fa fa-trash"></i> Xóa sản phẩm
                        </button>
                    </form>
                </div>

                <!-- Meta Information -->
                <div class="product-meta-section">
                    <div class="meta-item">
                        <i class="fa fa-hashtag"></i>
                        <span><strong>ID:</strong> #{{ $product->id }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-calendar-plus"></i>
                        <span><strong>Ngày tạo:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-calendar-check"></i>
                        <span><strong>Cập nhật:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.product-detail-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px 0;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.header-card {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.header-text {
    flex: 1;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: white;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    color: white;
}

.header-back-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.header-back-btn:hover {
    background: white;
    color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.product-detail-content {
    padding: 60px 0;
    background: linear-gradient(to bottom, #f8f9ff 0%, #ffffff 100%);
    min-height: 70vh;
}

.product-detail-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.product-image-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.15);
    border: 2px solid #e0e7ff;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 500px;
}

.product-main-image {
    max-width: 100%;
    max-height: 500px;
    border-radius: 12px;
    object-fit: contain;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.no-image-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.2rem;
    gap: 1rem;
    min-height: 400px;
}

.no-image-placeholder i {
    font-size: 4rem;
    opacity: 0.5;
}

.product-info-card {
    background: white;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.15);
    border: 2px solid #e0e7ff;
}

.product-header-info {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.product-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    flex: 1;
}

.stock-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.stock-available {
    background: #d1fae5;
    color: #065f46;
}

.stock-unavailable {
    background: #fee2e2;
    color: #991b1b;
}

.product-price-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #e0e7ff;
}

.product-price {
    font-size: 2.5rem;
    font-weight: 700;
    color: #dc2626;
}

.product-category-section,
.product-description-section {
    margin-bottom: 2rem;
}

.section-label {
    font-size: 1rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.category-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.category-tag {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(102, 126, 234, 0.2);
}

.category-tag:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    color: white;
}

.product-description {
    color: #64748b;
    line-height: 1.8;
    font-size: 1rem;
    margin: 0;
}

.product-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #e0e7ff;
    flex-wrap: wrap;
}

.btn-action {
    flex: 1;
    min-width: 150px;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-action-form {
    flex: 1;
    min-width: 150px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
}

.product-meta-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #e0e7ff;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #64748b;
    font-size: 0.9rem;
}

.meta-item i {
    color: #667eea;
    width: 20px;
}

@media (max-width: 968px) {
    .product-detail-wrapper {
        grid-template-columns: 1fr;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .product-title {
        font-size: 1.75rem;
    }
    
    .product-price {
        font-size: 2rem;
    }
}
</style>

</x-app-layout>
