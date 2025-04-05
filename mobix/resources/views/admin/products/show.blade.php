@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">📱 Chi tiết sản phẩm</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Hình ảnh sản phẩm -->
                <div class="col-md-4 text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;" alt="Ảnh sản phẩm">
                    @else
                        <em>Không có ảnh</em>
                    @endif
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="col-md-8">
                    <h4 class="text-primary">{{ $product->name }}</h4>
                   
                    <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'Chưa phân loại' }}</p>
                    <p><strong>Giá:</strong> 
                        <span class="badge bg-success">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                    </p>
                    <p><strong>Số lượng còn:</strong> 
                        <span class="badge bg-warning">{{ $product->stock }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection
