<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .logout-form {
            padding: 10px 15px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-white text-center">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.products.index') }}">Quản lý sản phẩm</a>
        <a href="{{ route('admin.categories.index') }}">Danh mục</a>
        <a href="{{ route('admin.orders.index') }}">Đơn hàng</a>
        <a href="{{ route('admin.users.index') }}">Người dùng</a>
        <a href="#">Cài đặt</a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form mt-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">
                🚪 Đăng xuất
            </button>
        </form>
    </div>

    <!-- Nội dung chính -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
