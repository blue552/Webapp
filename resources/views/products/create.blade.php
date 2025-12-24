<x-app-layout>
<!-- Create Product Header -->
<section class="create-product-header">
    <div class="container">
        <div class="header-card">
            <div class="header-text">
                <h1 class="page-title">Thêm sản phẩm mới</h1>
                <p class="page-subtitle">Tạo sản phẩm mới cho bộ sưu tập</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('products.index') }}" class="btn btn-outline header-back-btn">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Create Product Form -->
<section class="create-product-form">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-card">
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fa fa-exclamation-triangle"></i> Vui lòng kiểm tra lại thông tin:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ old('name') }}" placeholder="Nhập tên sản phẩm" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Mô tả sản phẩm</label>
                            <textarea name="description" id="description" class="form-control" rows="4" 
                                      placeholder="Mô tả chi tiết về sản phẩm">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-label">Giá bán (VNĐ) <span class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" class="form-control" 
                                           value="{{ old('price') }}" placeholder="0" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock" class="form-label">Số lượng tồn kho <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" id="stock" class="form-control" 
                                           value="{{ old('stock') }}" placeholder="0" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Danh mục sản phẩm <span class="text-danger">*</span></label>
                            
                            @if($categories->count() > 0)
                                <div class="categories-radio-container" style="border: 2px solid #e0e7ff; border-radius: 12px; padding: 1.5rem; background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%); max-height: 300px; overflow-y: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                    @foreach($categories as $category)
                                        <div class="form-check-radio mb-3">
                                            <input 
                                                class="form-check-input-radio" 
                                                type="radio" 
                                                name="category_id" 
                                                id="category_{{ $category->id }}" 
                                                value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'checked' : '' }}
                                                required
                                            >
                                            <label class="form-check-label-radio" for="category_{{ $category->id }}" style="cursor: pointer; font-weight: 500; color: #1e293b; padding-left: 0.5rem;">
                                                <span style="font-size: 1.1rem; color: #667eea;">{{ $category->name }}</span>
                                                @if($category->description)
                                                    <small class="d-block text-muted" style="font-weight: normal; font-size: 0.875rem; margin-top: 0.25rem; color: #64748b;">{{ $category->description }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="form-text text-muted" style="color: #64748b; margin-top: 0.5rem; display: block;">Chọn một danh mục cho sản phẩm</small>
                            @else
                                <div class="alert alert-warning" style="background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; padding: 1rem; border-radius: 8px;">
                                    <i class="fa fa-exclamation-triangle"></i> 
                                    <strong>Chưa có danh mục nào!</strong> 
                                    Vui lòng <a href="{{ route('categories.index') }}" class="text-primary font-weight-bold">tạo danh mục</a> trước khi thêm sản phẩm.
                                </div>
                            @endif
                            
                            @error('category_id')
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">
                                    <i class="fa fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Chọn file ảnh (JPG, PNG, GIF) - Tối đa 2MB</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Lưu sản phẩm
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline">
                                <i class="fa fa-times"></i> Hủy bỏ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.create-product-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px 0 60px;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.45);
}

.header-card {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
}

.header-text {
    flex: 1 1 auto;
    min-width: 240px;
}

.header-actions {
    flex: 0 0 auto;
}

.header-back-btn {
    border-radius: 999px;
    padding: 0.6rem 1.5rem;
    border: 2px solid rgba(255, 255, 255, 0.9);
    color: #ffffff;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.3);
}

.header-back-btn:hover {
    background: rgba(255,255,255,0.12);
    color: #ffffff;
}

.page-title {
    font-size: 2.3rem;
    font-weight: 700;
    margin-bottom: 0.35rem;
}

.page-subtitle {
    font-size: 1rem;
    opacity: 0.9;
}

.create-product-form {
    padding: 40px 0 70px;
}

.form-wrapper {
    max-width: 960px;
    margin: 0 auto;
}

.form-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.15);
    border: 2px solid #e0e7ff;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #111827 !important; /* đảm bảo luôn là màu đậm, không bị trùng màu nền */
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 2px solid #e0e7ff;
    border-radius: 10px;
    padding: 0.875rem 1.25rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #ffffff;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.3rem rgba(102, 126, 234, 0.2);
    background: #ffffff;
    outline: none;
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: 1.25rem;
    margin-top: 2.5rem;
    padding-top: 2rem;
    border-top: 1px solid #e9ecef;
}

.alert {
    border-radius: 8px;
    border: none;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

.alert h6 {
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.text-danger {
    color: #dc3545 !important;
}

.form-text {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.categories-radio-container {
    scrollbar-width: thin;
    scrollbar-color: #667eea #f8f9ff;
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
    padding: 1rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.form-check-radio:hover {
    background-color: rgba(102, 126, 234, 0.08);
    border-color: #e0e7ff;
    transform: translateX(4px);
}

.form-check-input-radio {
    width: 1.5rem;
    height: 1.5rem;
    margin-top: 0.125rem;
    margin-right: 1rem;
    cursor: pointer;
    border: 3px solid #c7d2fe;
    border-radius: 50%;
    flex-shrink: 0;
    appearance: none;
    position: relative;
    transition: all 0.3s ease;
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
    width: 0.5rem;
    height: 0.5rem;
    border-radius: 50%;
    background: white;
}

.form-check-input-radio:focus {
    box-shadow: 0 0 0 0.3rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.form-check-label-radio {
    flex: 1;
    cursor: pointer;
    user-select: none;
}

.alert-warning a {
    text-decoration: underline;
}

.alert-warning a:hover {
    text-decoration: none;
}
</style>

</x-app-layout>
