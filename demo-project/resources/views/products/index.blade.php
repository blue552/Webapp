<!-- resources/views/products/index.blade.php -->

@extends('layouts.app') <!-- nếu bạn có layout chung, còn không thì bỏ dòng này -->

@section('content')
<div class="container">
    <h1>Danh sách sản phẩm</h1>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Nút thêm sản phẩm -->
    <a href="{{ route('products.create') }}">+ Thêm sản phẩm mới</a>

    <!-- Bảng danh sách -->
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Ảnh" width="80">
                        @else
                            Không có
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}">Xem</a> |
                        <a href="{{ route('products.edit', $product->id) }}">Sửa</a> |
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Chưa có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
