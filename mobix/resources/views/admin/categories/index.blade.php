@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">📂 Danh sách Danh mục</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">➕ Thêm danh mục</a>

        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm">👁 Xem</a>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        {{ $categories->links() }}
    </div>
@endsection
