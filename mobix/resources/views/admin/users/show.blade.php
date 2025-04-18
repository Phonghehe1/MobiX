@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>👤 Thông tin người dùng #{{ $user->id }}</h2>

    <p><strong>Họ tên:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $user->phone ?? '-' }}</p>
    <p><strong>Địa chỉ:</strong> {{ $user->address ?? '-' }}</p>
    <p><strong>Ngày đăng ký:</strong> {{ $user->created_at->format('d/m/Y') }}</p>

    <h4 class="mt-4">🧾 Đơn hàng đã đặt</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
</div>
@endsection
