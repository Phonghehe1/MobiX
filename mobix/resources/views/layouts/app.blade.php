<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobiX</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @yield('styles')
    @yield('scripts')
</head>
<body>
    <!-- Header -->
<header class="bg-light py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <a href="{{ route('home') }}">
                    <h2>MobiX</h2>
                </a>
            </div>
            <div class="col-6">
                <form action="{{ route('home') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request('query') }}">
                        <button class="btn btn-danger" type="submit">Tìm</button>
                    </div>
                </form>
            </div>
            <div class="col-3 text-end">
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <a href="{{ route('cart.show') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-cart"></i> Giỏ hàng
                    </a>
                    @if (Auth::check())
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Thoát
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-person-plus"></i> Đăng ký
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>


    <!-- Menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @foreach(\App\Models\Category::all() as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

    <!-- Nội dung chính -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Địa chỉ: 123 Đường ABC, TP.HCM</p>
                    <p>Hotline: 0123 456 789</p>
                </div>
                <div class="col-md-4">
                    <h5>Chính sách</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Bảo hành</a></li>
                        <li><a href="#" class="text-white">Đổi trả</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kết nối</h5>
                    <a href="#" class="text-white">Facebook</a> | <a href="#" class="text-white">Instagram</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
