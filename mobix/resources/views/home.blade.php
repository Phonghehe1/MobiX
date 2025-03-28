@extends('layouts.app')

@section('content')
    <!-- Banner Carousel -->
    <div id="bannerCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <!-- Chỉ báo (dots) -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Các slide -->
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="{{ asset('storage/images/banner1.jpg') }}" class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{ asset('storage/images/banner2.jpg') }}" class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{ asset('storage/images/banner3.jpg') }}" class="d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>

        <!-- Nút điều hướng -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Danh mục nổi bật -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center mb-3">Danh mục nổi bật</h2>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm">
                <img src="{{ asset('storage/images/dmip.jpg') }}" class="card-img-top" alt="iPhone" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">iPhone</h5>
                    <a href="{{ route('category.show', 1) }}" class="btn btn-outline-primary">Xem ngay</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm">
                <img src="{{ asset('storage/images/dmss.jpg') }}" class="card-img-top" alt="Samsung" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Samsung</h5>
                    <a href="{{ route('category.show', 2) }}" class="btn btn-outline-primary">Xem ngay</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm">
                <img src="{{ asset('storage/images/dmxiao.jpg') }}" class="card-img-top" alt="Xiaomi" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Xiaomi</h5>
                    <a href="{{ route('category.show', 3) }}" class="btn btn-outline-primary">Xem ngay</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm nổi bật -->
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
        </div>
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
            flex: 1;
            text-align: center;
        }
        /* Slideshow */
        .carousel {
            border-radius: 10px;
            overflow: hidden;
        }
        .carousel-item img {
            height: 500px; /* Chiều cao cố định */
            object-fit: cover; /* Cắt ảnh vừa khung */
        }
        /* Responsive */
        @media (max-width: 768px) {
            .carousel-item img {
                height: 250px; /* Giảm chiều cao trên mobile */
            }
            .carousel-caption h1 {
                font-size: 1.5rem;
            }
            .carousel-caption p {
                font-size: 1rem;
            }
        }
    </style>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
