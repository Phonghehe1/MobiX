@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>✏️ Cập nhật đơn hàng #{{ $order->id }}</h2>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
