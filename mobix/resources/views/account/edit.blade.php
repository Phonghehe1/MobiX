@extends('layouts.app')

@section('content')
<div class="container">
    <h3>👤 Thông tin tài khoản</h3>

    {{-- Cảnh báo nếu thiếu thông tin --}}
    @if (empty($user->phone) || empty($user->address))
        <div class="alert alert-warning">
            ⚠️ Bạn cần cập nhật <strong>số điện thoại</strong> và <strong>địa chỉ</strong> để có thể đặt hàng.
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name">Họ tên</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <div class="mb-3">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
        </div>

        <hr>

        <div class="mb-3">
            <label for="password">Mật khẩu mới (bỏ qua nếu không đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
    </form>
</div>
@endsection
