@extends('layouts.app')

@section('content')
    <h2>Xác nhận thanh toán</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price) }} VNĐ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                <td>{{ number_format($total) }} VNĐ</td>
            </tr>
        </tfoot>
    </table>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label><strong>Chọn phương thức thanh toán:</strong></label><br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                <label class="form-check-label" for="cod">Thanh toán khi nhận hàng (COD)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="bank" id="bank">
                <label class="form-check-label" for="bank">Chuyển khoản ngân hàng</label>
            </div>
        </div>

        <!-- Thông tin ngân hàng -->
        <div class="mb-3" id="bankDetails" style="display: none;">
            <label><strong>Thông tin chuyển khoản:</strong></label>
            <ul class="list-unstyled">
                <li><strong>Người nhận:</strong> Trần Văn Phong</li>
                <li><strong>Số tài khoản:</strong> 0325413923</li>
                <li><strong>Ngân hàng:</strong> MB-Bank</li>
            </ul>
            <p>Hoặc quét mã QR bên dưới để chuyển khoản nhanh:</p>
            <img src="{{ asset('storage/images/qr.jpg') }}" alt="Mã QR ngân hàng" width="200">
        </div>

        <!-- ✅ Đặt nút bên ngoài div #bankDetails -->
        <button type="submit" id="confirmOrderButton" class="btn btn-success">Xác nhận đặt hàng</button>
    </form>
@endsection

@section('styles')
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
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmOrderButton = document.getElementById('confirmOrderButton');
            const codOption = document.getElementById('cod');
            const bankOption = document.getElementById('bank');
            const bankDetails = document.getElementById('bankDetails');

            function toggleBankDetails() {
                if (bankOption.checked) {
                    bankDetails.style.display = 'block';
                } else {
                    bankDetails.style.display = 'none';
                }
            }

            // Gọi khi trang tải
            toggleBankDetails();

            // Gắn sự kiện thay đổi
            codOption.addEventListener('change', toggleBankDetails);
            bankOption.addEventListener('change', toggleBankDetails);

            if (confirmOrderButton) {
                confirmOrderButton.addEventListener('click', function (event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "Xác nhận đặt hàng?",
                        text: "Bạn có chắc chắn muốn đặt hàng không?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Có, đặt hàng!",
                        cancelButtonText: "Hủy"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            confirmOrderButton.closest('form').submit();
                        }
                    });
                });
            }
        });
    </script>
@endsection
