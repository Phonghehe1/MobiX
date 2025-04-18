@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Đơn hàng của bạn</h2>

        @if($orders->isEmpty())
            <p>Bạn chưa có đơn hàng nào.</p>
        @else
            @foreach($orders as $order)
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Mã đơn hàng: #{{ $order->id }}</strong> |
                        Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }} |
                        Trạng thái: <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'Đã xóa' }}</td>
                                        <td>{{ number_format($item->price) }} VNĐ</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price * $item->quantity) }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end">
                            <strong>Tổng cộng: {{ number_format($order->total) }} VNĐ</strong>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
