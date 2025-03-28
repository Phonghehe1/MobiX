@extends('layouts.app')

@section('content')
    <h2>Xác nhận thanh toán</h2>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price) }} VNĐ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                <td>{{ number_format($total) }} VNĐ</td>
            </tr>
        </tfoot>
    </table>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Xác nhận đặt hàng</button>
    </form>
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
