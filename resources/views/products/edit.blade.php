<form action="{{ route('products.update',$product->id)}}" method="POST" >
    @csrf
    @method('PUT')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class ="form-group">
        <label for="name"> Tên sản phẩm </label>
        <input type ="text" id="name" name="name" class="form-control" value= "{{ old('name',$product->name)}} "required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $product->description) }}</textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="price">Giá (VNĐ)</label>
            <input type="number" id="price" name="price" class="form-control"
                   step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="stock">Tồn kho</label>
            <input type="number" id="stock" name="stock" class="form-control"
                   min="0" value="{{ old('stock', $product->stock) }}" required>
        </div>
</div>
    <div class="form-group">
        <label class="form-label">Danh mục sản phẩm</label>
        
        @if($categories->count() > 0)
            <div class="categories-checkbox-container" style="border: 2px solid #e9ecef; border-radius: 8px; padding: 1rem; background: #f8f9fa; max-height: 200px; overflow-y: auto;">
                @foreach($categories as $category)
                    <div class="form-check mb-2">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="categories[]" 
                            id="category_{{ $category->id }}" 
                            value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="category_{{ $category->id }}" style="cursor: pointer; font-weight: 500; color: #2c3e50;">
                            {{ $category->name }}
                            @if($category->description)
                                <small class="d-block text-muted" style="font-weight: normal; font-size: 0.875rem;">{{ $category->description }}</small>
                            @endif
                        </label>
                    </div>
                @endforeach
            </div>
            <small class="form-text text-muted">Chọn một hoặc nhiều danh mục cho sản phẩm</small>
        @else
            <div class="alert alert-warning" style="background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; padding: 1rem; border-radius: 8px;">
                <i class="fa fa-exclamation-triangle"></i> 
                <strong>Chưa có danh mục nào!</strong> 
                Vui lòng <a href="{{ route('categories.index') }}" class="text-primary font-weight-bold">tạo danh mục</a> trước.
            </div>
        @endif
        
        @error('categories')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
                <i class="fa fa-exclamation-circle"></i> {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Ảnh (tùy chọn)</label>
        <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
        @if($product->image)
            <div class="mt-2">
                <small class="text-muted">Ảnh hiện tại:</small>
                @if(file_exists(public_path('images/products/' . $product->image)))
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px; border-radius: 8px; margin-top: 0.5rem;">
                @endif
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<style>
.categories-checkbox-container {
    scrollbar-width: thin;
    scrollbar-color: #667eea #f8f9fa;
}

.categories-checkbox-container::-webkit-scrollbar {
    width: 8px;
}

.categories-checkbox-container::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 4px;
}

.categories-checkbox-container::-webkit-scrollbar-thumb {
    background: #667eea;
    border-radius: 4px;
}

.categories-checkbox-container::-webkit-scrollbar-thumb:hover {
    background: #5568d3;
}

.form-check {
    display: flex;
    align-items: flex-start;
    padding: 0.5rem;
    border-radius: 6px;
    transition: background-color 0.2s ease;
}

.form-check:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    margin-top: 0.125rem;
    margin-right: 0.75rem;
    cursor: pointer;
    border: 2px solid #667eea;
    border-radius: 4px;
    flex-shrink: 0;
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-check-label {
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
