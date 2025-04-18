@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>🧾 Chi tiết đơn hàng #{{ $order->id }}</h2>
    <p><strong>Khách hàng:</strong> {{ $order->user->name }}</p>
    <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
    <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
    <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <h4 class="mt-4">🛒 Danh sách sản phẩm</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
</div>
@endsection
