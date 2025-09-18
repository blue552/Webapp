@extends('layouts.app') 

@section('content')

<div class= "container">
    <h1>{{$product->name}}</h1>
    <p>{{$product->description}}</p>
    <p>Giá : {{number_format($product->price,0,',','.') }} VND</p>
    <p>Tồn kho : {{ $product->stock}}</p>
    <a href="{{ route('products.index')}}" class="btn btn-secondary"> Trang chủ</a>
    <a href="{{ route('products.edit', $product->id)}}" class="btn btn-warning"> Sửa </a>
    <form action= "{{ route('products.destroy',$product->id)}}" method= "POST">
        @csrf 
        @method('DELETE')
        <button type="submit" class= "btn-danger"
            onclick="return confirm('Ban co chac muon xoa>')">Xoa</button>
    </form?>
</div>
@endsection
