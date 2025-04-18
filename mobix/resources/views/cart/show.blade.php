@extends('layouts.app')
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <h2>Giỏ hàng của bạn</h2>

    <!-- Toast container -->
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

    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price) }} VNĐ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Nút thanh toán -->
    <button id="checkoutButton" class="btn btn-success">Thanh toán</button>
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
            z-index: 1055;
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
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('successToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl, {
                        autohide: true,
                        delay: 3000
                    });
                    toast.show();
                }
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var checkoutButton = document.getElementById('checkoutButton');
            if (checkoutButton) {
                checkoutButton.addEventListener('click', function () {
                    Swal.fire({
                        title: "Xác nhận thanh toán?",
                        text: "Bạn có chắc chắn muốn thanh toán giỏ hàng này?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Có, thanh toán!",
                        cancelButtonText: "Hủy"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('checkout') }}";
                        }
                    });
                });
            }
        });
    </script>
@endsection

