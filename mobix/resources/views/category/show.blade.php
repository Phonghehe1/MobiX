@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-4">Sản phẩm của {{ $category->name }}</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
                        <p class="card-text text-muted">Còn {{ $product->stock }} sản phẩm</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary mt-auto">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .navbar-nav {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .nav-item {
            flex: 1; /* Mỗi mục chiếm đều không gian */
            text-align: center; /* Căn giữa chữ trong mỗi mục */
        }
    </style>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
