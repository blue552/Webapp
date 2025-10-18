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
        <label for="image">Ảnh (tùy chọn)</label>
        <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
