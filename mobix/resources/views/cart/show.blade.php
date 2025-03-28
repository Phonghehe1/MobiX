@extends('layouts.app')

@section('content')
    <h2>Giỏ hàng của bạn</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price) }} VNĐ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('checkout') }}" class="btn btn-success">Thanh toán</a>
@endsection
@section('styles')
    <style>
        .navbar-nav {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .nav-item {
            flex: 1;
            text-align: center;
        }
    </style>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
