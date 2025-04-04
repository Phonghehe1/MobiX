@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
            <p>Còn {{ $product->stock }} sản phẩm</p>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" class="form-control w-25 d-inline">
                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>

    <!-- Toast container ở góc trên bên phải -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        @if (session('success'))
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        /* Toast */
        .toast-container {
            z-index: 1055; /* Đảm bảo toast nằm trên các phần tử khác */
        }
        .toast {
            animation: slideInDown 0.5s ease-in-out;
        }
        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('successToast');
                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000 // Tự động ẩn sau 3 giây
                });
                toast.show();
            });
        </script>
    @endif
@endsection
