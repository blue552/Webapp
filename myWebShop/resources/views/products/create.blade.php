@extends('layouts.app')

@section('title', 'Thêm sản phẩm mới - LuxeAura')

@section('content')
<!-- Create Product Header -->
<section class="create-product-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-title">Thêm sản phẩm mới</h1>
                <p class="page-subtitle">Tạo sản phẩm mới cho bộ sưu tập</p>
            </div>
            <div class="col-lg-4 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-outline">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Create Product Form -->
<section class="create-product-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
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
@endsection

@push('styles')
<style>
.create-product-header {
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

.create-product-form {
    padding: 60px 0;
}

.form-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
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
</style>
@endpush
