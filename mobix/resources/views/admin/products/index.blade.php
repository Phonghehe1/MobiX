@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">📱 Danh sách Sản phẩm</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">➕ Thêm sản phẩm</a>

        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <!-- Bộ lọc sắp xếp -->
        <div class="mb-3 d-flex align-items-center">
            <label class="me-2">Sắp xếp theo:</label>
            <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                <select name="sort" class="form-select me-2">
                    <option value="id" {{ $sort == 'id' ? 'selected' : '' }}>ID</option>
                    <option value="name" {{ $sort == 'name' ? 'selected' : '' }}>Tên</option>
                    <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Giá</option>
                </select>
                <input type="hidden" name="order" value="{{ $order === 'desc' ? 'asc' : 'desc' }}">
                <button type="submit" class="btn btn-secondary">Sắp xếp</button>
            </form>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-success">{{ number_format($product->price, 0, ',', '.') }} VND</span></td>
                        <td><img src="{{ Storage::URL($product->image) }}" class="img-thumbnail" width="80"></td>
                        <td>{{ $product->category->name ?? 'Chưa phân loại' }}</td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">👁 Xem</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        {{ $products->appends(['sort' => $sort, 'order' => $order])->links() }}
    </div>
@endsection
