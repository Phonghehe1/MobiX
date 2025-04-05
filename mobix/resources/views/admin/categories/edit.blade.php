@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>🛠️ Chỉnh sửa danh mục</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ $category->description }}</textarea>
        </div>


        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a class="btn btn-primary" href="{{ route('admin.categories.index') }}">Quay lại</a>
    </form>
</div>
@endsection
